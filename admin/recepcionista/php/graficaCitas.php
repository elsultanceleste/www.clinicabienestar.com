<?php
require_once('../../config/conexion.php');

$query = "SELECT 
    m.mes,
    COALESCE(c.tipo, 'Sin citas') as tipo,
    COALESCE(COUNT(c.id), 0) as total
FROM (
    SELECT 1 as mes UNION SELECT 2 UNION SELECT 3 UNION SELECT 4
    UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8
    UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12
) m
LEFT JOIN citas c ON MONTH(c.fecha_cita) = m.mes 
    AND YEAR(c.fecha_cita) = YEAR(CURRENT_DATE())
GROUP BY m.mes, c.tipo
ORDER BY m.mes, c.tipo";

$resultado = mysqli_query($conexion, $query);

$datos = array_fill(0, 12, [
    'consultas' => 0,
    'revisiones' => 0,
    'analisis' => 0
]);

while($row = mysqli_fetch_assoc($resultado)) {
    $mes = intval($row['mes']) - 1;
    $tipo = strtolower($row['tipo']);
    
    switch($tipo) {
        case 'consulta':
            $datos[$mes]['consultas'] = intval($row['total']);
            break;
        case 'analisis':
            $datos[$mes]['analisis'] = intval($row['total']);
            break;
        case 'revision':
            $datos[$mes]['revisiones'] = intval($row['total']);
            break;
    }
}

echo json_encode(array_values($datos));
?>