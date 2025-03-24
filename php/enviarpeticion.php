<?php

    require "./conexion.php";

    if(isset($_POST['id_paciente'])){
        $id_paciente =$_POST['id_paciente'];
        $motivo = $_POST['motivo'];
        $tipocita = $_POST['tipocita'];
        $id_medico = $_POST['id_doctor'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        //Validar que la hora no sea después de las 15:30
        $hora_limite = strtotime('15:30');
        $hora_seleccionada = strtotime($hora);

        if ($hora_seleccionada > $hora_limite) {
            echo json_encode(['status' => 'error', 'message' => 'No se pueden solicitar citas después de las 15:30']);
            exit;
        }
            //Verificar si el medcio ya tiene una cita en esa fecha y hora
            $sql = "SELECT * FROM citas WHERE medico_id = '$id_medico' AND fecha_cita = '$fecha' AND hora_cita = '$hora'";
            $result = mysqli_query($conexion, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo json_encode(['status' => 'error','message' => 'El médico ya tiene una cita en esa fecha y hora']);
                exit;
            }
        $sql = "INSERT INTO citas (paciente_id, medico_id, fecha_cita, hora_cita, motivo, tipo) 
        VALUES ('$id_paciente','$id_medico','$fecha','$hora','$motivo','$tipocita')";
        $result = mysqli_query($conexion,$sql);

        if($result){
                   echo json_encode(['status' => 'success', 'message' => 'Cita registrada correctamente']);

        }else{
            echo json_encode(['status' => 'error', 'message' => 'Error al registrar la cita']);
        }
        
    }


?>