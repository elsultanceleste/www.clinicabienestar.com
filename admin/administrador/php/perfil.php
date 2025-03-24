<?php
session_start();
require_once('../../config/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    $response = array();
    
    if ($_POST['accion'] === 'actualizarPerfil') {
        $experiencia = mysqli_real_escape_string($conexion, $_POST['experiencia']);
        $educacion = mysqli_real_escape_string($conexion, $_POST['idiomas']);
        $id_medico = $_SESSION['id_medico'];
        
        $query = "UPDATE medicos SET 
                  experiencia = ?, 
                  idiomas = ? 
                  WHERE id = ?";
                  
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "ssi", $experiencia, $educacion, $id_medico);
        
        if (mysqli_stmt_execute($stmt)) {
            $response['status'] = 'success';
            $response['message'] = 'Perfil actualizado correctamente';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error al actualizar el perfil';
        }
    }
    
    echo json_encode($response);
} else {
    header('Location: ../dashboard.php');
}
?>