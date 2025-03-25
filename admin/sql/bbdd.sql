-- Active: 1742639801766@@127.0.0.1@3306@clinicabienestar
DROP DATABASE clinicaBienestar;
CREATE DATABASE ClinicaBienestar
    DEFAULT CHARACTER SET = 'utf8mb4';


USE ClinicaBienestar;

CREATE TABLE rol(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

    CREATE TABLE pacientes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        apellido VARCHAR(100) NOT NULL,
        fecha_nacimiento DATE,
        genero ENUM('Masculino', 'Femenino', 'Otro'),
        direccion TEXT,
        telefono VARCHAR(20),
        edad INT,
        email VARCHAR(100) UNIQUE,
        alergias TEXT,
        id_rol INT,
        FOREIGN KEY (id_rol) REFERENCES rol(id)
    );



CREATE TABLE empleados(
    id INT AUTO_INCREMENT PRIMARY KEY,
    perfil VARCHAR(100) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    nacionalidad VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    direccion TEXT,
    id_rol INT ,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_rol) REFERENCES rol(id)
);




CREATE TABLE medicos(
    id INT AUTO_INCREMENT PRIMARY KEY,
    especialidad VARCHAR(100) NOT NULL,
    titulo_profesional VARCHAR(100) NOT NULL,
    experiencia INT NOT NULL,
    idiomas VARCHAR(100) NOT NULL,
    id_empleado INT,
    FOREIGN KEY (id_empleado) REFERENCES empleados(id)
);

CREATE TABLE citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id INT NOT NULL,
    medico_id INT NOT NULL,
    fecha_cita DATE NOT NULL,
    hora_cita TIME NOT NULL,
    motivo TEXT,
    tipo ENUM('Consulta', 'Analisis', 'Revision') DEFAULT 'Consulta',
    estado ENUM('Programada', 'Realizada', 'Cancelada', 'Reprogramada') DEFAULT 'Programada',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id),
    FOREIGN KEY (medico_id) REFERENCES medicos(id)
);




CREATE TABLE historial_medico (
    id INT PRIMARY KEY AUTO_INCREMENT,
    paciente_id INT NOT NULL,
    id_medico INT NOT NULL,
    id_cita INT NOT NULL,
    fecha DATE NOT NULL,
    diagnostico TEXT NOT NULL,
    tratamiento TEXT NOT NULL,
    Receta TEXT NOT NULL,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id),
    FOREIGN KEY (id_medico) REFERENCES medicos(id),
    FOREIGN KEY(id_cita) REFERENCES citas (id)
);
 



create table usuario(
	cod_usuario int primary key auto_increment,
    correo varchar(45) not null UNIQUE,
    passwd varchar(100) not null,
    estado BOOLEAN,
    id_paciente int default null, foreign key(id_paciente) references pacientes(id),
    id_empleado int default null, foreign key(id_empleado) references empleados(id)
);

