<?php
require_once('../config/conexion.php');

if(isset($_POST['accion']) && $_POST['accion'] == "antendidos") {
    $id_medico = $_POST['id_medico'];
    
    // Create base array with all months initialized to 0
    $meses = array_fill(1, 12, [
        'mes' => 0,
        'total' => 0
    ]);

    // Get data for current year
    $query = "SELECT MONTH(c.fecha_cita) as mes, COUNT(*) as total 
              FROM citas c 
              WHERE c.medico_id = ? 
              AND YEAR(c.fecha_cita) = YEAR(CURRENT_DATE())
              AND c.estado = 'Realizada'
              GROUP BY MONTH(c.fecha_cita)
              ORDER BY mes";

    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_medico);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    // Fill in actual data
    while($row = mysqli_fetch_assoc($resultado)) {
        $mes = (int)$row['mes'];
        $meses[$mes] = [
            'mes' => $mes,
            'total' => (int)$row['total']
        ];
    }

    // Convert to indexed array
    echo json_encode(array_values($meses));
} elseif (isset($_POST['id_medico']) && $_POST['accion'] == 'citas') {

    $id_medico = $_POST['id_medico'];

    $sql = "SELECT tipo, COUNT(*) AS cantidad FROM citas WHERE medico_id = '$id_medico' GROUP BY tipo;";
    $result = mysqli_query($conexion, $sql);
    $citas = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $citas[] = $row;
    }
    echo json_encode($citas);
}elseif (isset($_POST['id_medico']) && $_POST['accion'] == 'citas_hoy') {
    $id_medico = $_POST['id_medico'];

    $sql="SELECT c.id, c.hora_cita AS hora, c.tipo, c.motivo, p.nombre
            FROM citas c
            INNER JOIN pacientes p ON c.paciente_id = p.id
            INNER JOIN medicos m ON c.medico_id = m.id
            WHERE 
            DATE(c.fecha_cita) = CURDATE() 
            AND m.id = '$id_medico' AND c.estado= 'Programada'";
            $result = mysqli_query($conexion, $sql);
            $citas = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $citas[] = $row;
            }
            echo json_encode($citas);
}elseif (isset($_POST['id_medico']) && $_POST['accion'] == 'resumen') {
    $id_medico = $_POST['id_medico'];

    $sql="SELECT 
            (SELECT COUNT(*) FROM pacientes) AS total_pacientes,
            (SELECT COUNT(*) FROM citas WHERE fecha_cita = CURDATE() AND medico_id='$id_medico') AS citas_hoy,
            (SELECT COUNT(*) FROM citas WHERE medico_id = '$id_medico' AND estado = 'Realizada') AS consultas_medico;";
            $result = mysqli_query($conexion, $sql);
            $citas = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $citas[] = $row;
            }
            echo json_encode($citas);
}
