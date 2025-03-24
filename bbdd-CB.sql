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
    email VARCHAR(100) UNIQUE,
    alergias TEXT,
    id_rol INT,
    FOREIGN KEY (id_rol) REFERENCES rol(id)
);
SELECT * FROM pacientes;


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
    horario TEXT,  -- Se puede almacenar en JSON o en tablas separadas para mayor complejidad.
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_rol) REFERENCES rol(id)
);

SELECT 

    empleados.nombre AS nombre_medico,
    empleados.apellido AS apellido_medico,
    empleados.nacionalidad As nacionalidad_medico,
    medicos.especialidad,
    medicos.titulo_profesional,
    medicos.experiencia,
    medicos.idiomas,
    medicos.id AS id_medico
FROM 
    medicos
INNER JOIN 
    empleados 
ON 
    medicos.id_empleado = empleados.id;

INSERT INTO empleados (perfil, nombre, apellido, telefono, nacionalidad, email, direccion, id_rol, horario) VALUES
('Recepcionista', 'Santader', 'Morgades', '555-6789', 'Turco', 'Santandermorgades@gmail.com', 'Calle muerte segura', 2, '{"lunes": "9:00-17:00", "martes": "9:00-17:00", "miércoles": "9:00-17:00", "jueves": "9:00-17:00", "viernes": "9:00-17:00"}');

SELECT * FROM empleados;

CREATE TABLE medicos(
    id INT AUTO_INCREMENT PRIMARY KEY,
    especialidad VARCHAR(100) NOT NULL,
    titulo_profesional VARCHAR(100) NOT NULL,
    experiencia INT NOT NULL,
    idiomas VARCHAR(100) NOT NULL,
    id_empleado INT,
    FOREIGN KEY (id_empleado) REFERENCES empleados(id)
);
SELECT 
    medicos.id AS medico_id, 
    empleados.nombre AS nombre_medico, 
    medicos.especialidad 
FROM 
    medicos 
INNER JOIN 
    empleados 
ON 
    medicos.id_empleado = empleados.id;

INSERT INTO medicos (especialidad, titulo_profesional, experiencia, idiomas, id_empleado) VALUES
('Cirujano Ocular', 'Doctor en Medicina', 25, 'Español, Inglés,Frances', 2);


CREATE TABLE citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id INT NOT NULL,
    medico_id INT NOT NULL,
    fecha_cita DATE NOT NULL,
    hora_cita TIME NOT NULL,
    motivo TEXT,
    tipo ENUM('Consulta', 'Analisis', 'Revision') DEFAULT 'Consulta',
    estado ENUM('Programada', 'Realizada', 'Cancelada') DEFAULT 'Programada',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id),
    FOREIGN KEY (medico_id) REFERENCES medicos(id)
);

SELECT 
    empleados.nombre AS nombre_medico,
    citas.fecha_cita,
    citas.hora_cita,
    citas.motivo,
    citas.estado
FROM 
    citas
INNER JOIN 
    medicos 
ON 
    citas.medico_id = medicos.id
INNER JOIN 
    empleados 
ON 
    medicos.id_empleado = empleados.id
WHERE 
    citas.paciente_id = 6; -- Cambia el '1' por el ID del paciente específico

INSERT INTO citas (paciente_id, medico_id, fecha_cita, hora_cita, motivo, tipo, estado) VALUES
(1, 1, '2025-04-01', '10:00:00', 'Consulta general', 'Consulta', 'Programada');

CREATE TABLE historial_medico (
    id INT PRIMARY KEY AUTO_INCREMENT,
    paciente_id INT NOT NULL,
    id_medico INT NOT NULL,
    fecha DATE NOT NULL,
    diagnostico TEXT NOT NULL,
    tratamiento TEXT NOT NULL,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id),
    FOREIGN KEY (id_medico) REFERENCES medicos(id)
);

INSERT INTO usuario (correo, passwd, estado, id_paciente, id_empleado) VALUES
('admin@clinicabienestar.com', 'securepassword123', TRUE, NULL, 1),
('medico1@clinicabienestar.com', 'password456', TRUE, NULL, 2),
('paciente1@clinicabienestar.com', 'mypassword789', TRUE, 1, NULL),
('recepcionista@clinicabienestar.com', 'recepcionista123', TRUE, NULL, 3);

create table usuario(
	cod_usuario int primary key auto_increment,
    correo varchar(45) not null UNIQUE,
    passwd varchar(100) not null,
    estado BOOLEAN,
    id_paciente int default null, foreign key(id_paciente) references pacientes(id),
    id_empleado int default null, foreign key(id_empleado) references empleados(id)
);

SELECT 
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
ORDER BY m.mes, c.tipo

    INSERT INTO rol (nombre) VALUES ('Administrador'), ('Medico'), ('Paciente'), ('Recepcionista');

    SELECT * FROM citas;
    SELECT COUNT(*) FROM citas WHERE fecha_cita = CURDATE() AND medico_id =2;

    /* INSERT INTO pacientes (nombre, apellido, fecha_nacimiento, genero, direccion, telefono, email, id_rol) VALUES
('Carlos', 'Pérez', '1985-06-15', 'Masculino', 'Av. Siempre Viva 123, Ciudad', '555-1234', 'carlos.perez@example.com', 3),
('María', 'Gómez', '1992-09-23', 'Femenino', 'Calle Principal 456, Pueblo', '555-5678', 'maria.gomez@example.com', 3),
('Luis', 'Rodríguez', '1978-12-05', 'Masculino', 'Carrera 7 #89-45, Municipio', '555-9876', 'luis.rodriguez@example.com', 3),
('Ana', 'Martínez', '2001-04-30', 'Femenino', 'Urbanización Los Olivos, Edif. 3', '555-3456', 'ana.martinez@example.com', 3),
('Pedro', 'Sánchez', '1990-07-12', 'Masculino', 'Barrio San José, Casa 23', '555-6543', 'pedro.sanchez@example.com', 3),
('Elena', 'Fernández', '1987-03-18', 'Femenino', 'Residencias El Sol, Torre A', '555-1111', 'elena.fernandez@example.com', 3),
('Juan', 'López', '2000-11-08', 'Masculino', 'Condominio La Esperanza', '555-2222', 'juan.lopez@example.com', 3),
('Laura', 'Torres', '1995-05-25', 'Femenino', 'Vía Central, Localidad Norte', '555-3333', 'laura.torres@example.com', 3),
('Diego', 'Ramírez', '1982-08-14', 'Masculino', 'Villa del Parque, Bloque C', '555-4444', 'diego.ramirez@example.com', 3),
('Isabel', 'Ruiz', '1998-02-19', 'Femenino', 'Centro Histórico, Calle 10', '555-5555', 'isabel.ruiz@example.com', 3);


    INSERT INTO historial_medico (paciente_id, id_medico, fecha, diagnostico, tratamiento) VALUES
(1, 1, '2025-03-01', 'Miopía', 'Uso de lentes con graduación adecuada'),
(2, 1, '2025-03-05', 'Cataratas', 'Programar cirugía de cataratas en ojo derecho'),
(3, 1, '2025-03-10', 'Conjuntivitis alérgica', 'Aplicar gotas antihistamínicas y evitar alérgenos'),
(4, 1, '2025-03-12', 'Astigmatismo', 'Uso de lentes de contacto especializados'),
(5, 1, '2025-03-15', 'Glaucoma', 'Tratamiento con gotas para reducir la presión intraocular'),
(6, 1, '2025-03-18', 'Ojo seco', 'Aplicar lágrimas artificiales 3 veces al día'),
(7, 1, '2025-03-20', 'Hipermetropía', 'Uso de lentes correctivos para visión cercana'),
(8, 1, '2025-03-22', 'Degeneración macular', 'Suplementos vitamínicos y seguimiento médico'),
(9, 1, '2025-03-25', 'Estrabismo', 'Ejercicios visuales y posible cirugía correctiva'),
(10, 1, '2025-03-28', 'Queratocono', 'Uso de lentes rígidos permeables al gas');


INSERT INTO citas (paciente_id, medico_id, fecha_cita, motivo, estado) VALUES
(1, 1, '2025-01-10 10:00:00', 'Consulta de seguimiento por miopía', 'Realizada'),
(2, 1, '2025-01-15 14:30:00', 'Evaluación para cirugía de cataratas', 'Realizada'),
(3, 1, '2025-01-18 09:00:00', 'Irritación ocular y enrojecimiento', 'Cancelada'),
(4, 1, '2025-02-05 11:15:00', 'Revisión de astigmatismo', 'Realizada'),
(5, 1, '2025-02-12 16:00:00', 'Dolor ocular y visión borrosa', 'Realizada'),
(6, 1, '2025-02-20 08:45:00', 'Sequedad ocular persistente', 'Cancelada'),
(1, 1, '2025-03-20 10:00:00', 'Consulta de seguimiento por miopía', 'Programada'),
(2, 1, '2025-03-21 14:30:00', 'Evaluación para cirugía de cataratas', 'Programada'),
(3, 1, '2025-03-22 09:00:00', 'Irritación ocular y enrojecimiento', 'Realizada'),
(4, 1, '2025-03-23 11:15:00', 'Revisión de astigmatismo', 'Cancelada'),
(5, 1, '2025-03-24 16:00:00', 'Dolor ocular y visión borrosa', 'Programada'),
(6, 1, '2025-03-25 08:45:00', 'Sequedad ocular persistente', 'Realizada'),
(7, 1, '2025-03-26 13:00:00', 'Control de hipermetropía', 'Programada'),
(8, 1, '2025-03-27 15:30:00', 'Evaluación de degeneración macular', 'Realizada'),
(9, 1, '2025-03-28 10:30:00', 'Corrección de estrabismo', 'Programada'),
(10, 1, '2025-03-29 12:00:00', 'Posible queratocono', 'Cancelada'); */



SELECT * FROM citas