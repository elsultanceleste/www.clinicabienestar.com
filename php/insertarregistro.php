<?php
    require "./conexion.php";

    $sql = "SELECT id FROM rol WHERE nombre = 'Paciente'";
    $result = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_assoc($result);
    $rol = $row['id'];

    if(isset($_POST['nombre'])){
        $nombre = $_POST['nombre'];
        $apellidos =$_POST['apellidos'];
        $edad = $_POST['edad'];
        $genero = $_POST['genero'];
        $direc= $_POST['direccion'];
        $tel = $_POST['telefono'];
        $correo = $_POST['correo'];
        $contra = $_POST['contra'];

        $insert = "INSERT INTO pacientes (nombre, apellido, edad, genero, direccion, telefono, email, id_rol) 
        VALUES ('$nombre', '$apellidos', '$edad', '$genero', '$direc', '$tel', '$correo','$rol')";

        $resul = mysqli_query($conexion, $insert);

        if($resul){
            $cotraEncripted = password_hash($contra, PASSWORD_DEFAULT );

            $id_paciente = mysqli_insert_id($conexion);
            $usuario = "INSERT INTO usuario (correo, passwd, id_paciente) 
            VALUES('$correo','$cotraEncripted',$id_paciente)";

            $respu = mysqli_query($conexion, $usuario);
            if($respu){
                echo 1; 
            }
        }else{
            echo "No se a podido realizar la operacion";
        }
     }
?>