<?php

    require "../php/conexion.php";

    $email = $_POST['email'];
    $password = $_POST['pwd'];

    $sql = "SELECT * FROM usuario WHERE correo = '$email'";
    $result = mysqli_query($conexion, $sql);

    // verificamos que exista la cuenta 
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $pwd = $row["passwd"];
        // verificamos si la contraseñas coninciden
        if(password_verify($password,$pwd)){
            // si los pass son iguales verificamos si el estado de la cuenta esta activa
            // if($row['estado']==1){
            //     session_start();
            //     $_SESSION['id_paciente'] = $row['id_paciente'];
            //     echo 1;
            // }else{
            //     echo "Su cuenta esta desactivada,porfavor no moleste";
            // }
            session_start();
            $_SESSION['id_paciente'] = $row['id_paciente'];
            echo 1;
            
        }else{
            echo 2;
        }
    }else{
        echo "La cuenta no existe";
    }


?>