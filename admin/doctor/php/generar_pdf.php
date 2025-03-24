<?php
require('../../fpdf/fpdf.php');
require('../config/conexion.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 16);
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

    function DetallesConsulta($detalles)
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, utf8_decode('Detalles de la Consulta'), 0, 1, 'C');
        $this->SetFont('Arial', '', 12);
        $this->SetFillColor(200, 255, 200);
        
        foreach ($detalles as $clave => $valor) {
            $this->Cell(50, 10, utf8_decode($clave), 1, 0, 'L', true);
            $this->Cell(140, 10, utf8_decode($valor), 1, 1, 'L');
        }
        $this->Ln(5);
    }

    function DiagnosticoTratamiento($diagnostico, $tratamiento, $receta)
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, utf8_decode('Diagnóstico y Tratamiento'), 0, 1, 'C');
        $this->SetFont('Arial', '', 12);
        
        $this->SetFillColor(200, 255, 200);
        $this->Cell(0, 10, utf8_decode('Diagnóstico'), 1, 1, 'L', true);
        $this->MultiCell(0, 10, utf8_decode($diagnostico), 1, 'L');
        
        $this->Cell(0, 10, utf8_decode('Tratamiento'), 1, 1, 'L', true);
        $this->MultiCell(0, 10, utf8_decode($tratamiento), 1, 'L');
        
        $this->Cell(0, 10, utf8_decode('Receta'), 1, 1, 'L', true);
        $this->MultiCell(0, 10, utf8_decode($receta), 1, 'L');
    }
}

$id_historial = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_historial <= 0) {
    die('ID de historial no válido');
}

$query = "SELECT h.*, p.nombre as nombre_paciente, p.apellido as apellido_paciente,
          p.fecha_nacimiento, p.genero, p.telefono, p.direccion,
          CONCAT(e.nombre, ' ', e.apellido) as nombre_medico,
          m.especialidad, c.fecha_cita, c.hora_cita
          FROM historial_medico h
          JOIN pacientes p ON h.paciente_id = p.id
          JOIN medicos m ON h.id_medico = m.id
          JOIN empleados e ON m.id_empleado = e.id
          JOIN citas c ON h.id_cita = c.id
          WHERE h.id = " . $id_historial;

$result = mysqli_query($conexion, $query);

if (!$result) {
    die('Error en la consulta: ' . mysqli_error($conexion));
}

$historial = mysqli_fetch_assoc($result);

// Create PDF
$pdf = new PDF();
$pdf->AddPage();

// Format patient data
$datos_paciente = [
    'Nombre' => $historial['nombre_paciente'] . ' ' . $historial['apellido_paciente'],
    'Fecha de Nacimiento' => date('d/m/Y', strtotime($historial['fecha_nacimiento'])),
    'Género' => $historial['genero'],
    'Dirección' => $historial['direccion'],
    'Teléfono' => $historial['telefono']
];

// Format consultation details
$detalles_consulta = [
    'Fecha' => date('d/m/Y', strtotime($historial['fecha_cita'])),
    'Hora' => $historial['hora_cita'],
    'Médico' => $historial['nombre_medico'],
    'Especialidad' => $historial['especialidad']
];

$pdf->DatosPaciente($datos_paciente);
$pdf->DetallesConsulta($detalles_consulta);
$pdf->DiagnosticoTratamiento(
    $historial['diagnostico'],
    $historial['tratamiento'],
    $historial['Receta']
);

$pdf->Output('I', 'Historial_' . $historial['nombre_paciente'] . '_' . $historial['apellido_paciente'] . '.pdf');
?>