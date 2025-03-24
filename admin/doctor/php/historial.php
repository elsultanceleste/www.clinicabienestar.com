<?php
require('../../fpdf/fpdf.php');
require('../config/conexion.php');

class PDF extends FPDF
{
    function Header()
    {
        // Remove the AddFont line and just use SetFont
        $this->SetFont('Arial', 'B', 16);
        
        // Fix the image path to use absolute path
        $this->Image('C:/xampp/htdocs/ClinicaBienestar/admin/doctor/img/logoClinica2.png', 5, 2, 30);
        $this->Cell(0, 10, utf8_decode('Clínica Bienestar - Historial del Paciente'), 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }

    function DatosPaciente($datos)
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, utf8_decode('Datos del Paciente'), 0, 1, 'C');
        $this->SetFont('Arial', '', 12);
        $this->SetFillColor(200, 255, 200);
        
        foreach ($datos as $clave => $valor) {
            $this->Cell(50, 10, utf8_decode($clave), 1, 0, 'L', true);
            $this->Cell(140, 10, utf8_decode($valor), 1, 1, 'L');
        }
        $this->Ln(5);
    }

    function AntecedentesMedicos($antecedentes)
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, utf8_decode('Alergias'), 0, 1, 'C');
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(0, 10, utf8_decode($antecedentes), 1, 'L');
        $this->Ln(5);
    }

    function ConsultasPrevias($consultas)
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, utf8_decode('Consultas Previas'), 0, 1, 'C');
        $this->SetFont('Arial', '', 12);
        $this->SetFillColor(200, 255, 200);
        
        $this->Cell(50, 10, 'Fecha', 1, 0, 'C', true);
        $this->Cell(70, 10, 'Motivo', 1, 0, 'C', true);
        $this->Cell(70, 10, utf8_decode('Diagnóstico'), 1, 1, 'C', true);

        foreach ($consultas as $consulta) {
            $this->Cell(50, 10, utf8_decode($consulta['fecha']), 1, 0, 'C');
            $this->Cell(70, 10, utf8_decode($consulta['motivo']), 1, 0, 'C');
            $this->Cell(70, 10, utf8_decode($consulta['diagnostico']), 1, 1, 'C');
        }
    }
}

// Get patient ID and validate it
$id_paciente = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_paciente <= 0) {
    die('ID de paciente no válido');
}

// Get patient data with proper SQL syntax
$query_paciente = "SELECT 
    p.*,
    CONCAT(p.nombre, ' ', p.apellido) as nombre_completo
    FROM pacientes p 
    WHERE p.id = " . $id_paciente;

$result_paciente = mysqli_query($conexion, $query_paciente);

if (!$result_paciente) {
    die('Error en la consulta: ' . mysqli_error($conexion));
}

$paciente = mysqli_fetch_assoc($result_paciente);

// Get medical history with proper SQL syntax
$query_historial = "SELECT 
    h.*,
    c.fecha_cita,
    c.motivo,
    CONCAT(e.nombre, ' ', e.apellido) as medico
    FROM historial_medico h
    JOIN citas c ON h.id_cita = c.id
    JOIN medicos m ON c.medico_id = m.id
    JOIN empleados e ON m.id_empleado = e.id
    WHERE h.paciente_id = " . $id_paciente . "
    ORDER BY c.fecha_cita DESC";

$result_historial = mysqli_query($conexion, $query_historial);

if (!$result_historial) {
    die('Error en la consulta del historial: ' . mysqli_error($conexion));
}

$consultas = [];
while($row = mysqli_fetch_assoc($result_historial)) {
    $consultas[] = [
        'fecha' => date('d/m/Y', strtotime($row['fecha_cita'])),
        'motivo' => $row['motivo'],
        'diagnostico' => $row['diagnostico']
    ];
}

// Create PDF
$pdf = new PDF();
$pdf->AddPage();

// Format patient data
$datos_paciente = [
    'Nombre' => $paciente['nombre_completo'],
    'Edad' => $paciente['edad'] . ' años',
    'Género' => $paciente['genero'],
    'Dirección' => $paciente['direccion'],
    'Teléfono' => $paciente['telefono']
];

$pdf->DatosPaciente($datos_paciente);
$pdf->AntecedentesMedicos($paciente['alergias'] ?? 'Sin antecedentes registrados');
$pdf->ConsultasPrevias($consultas);

$pdf->Output('I', 'Historial_' . $paciente['nombre_completo'] . '.pdf');
?>
