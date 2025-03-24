<?php
// Create HTML content for the dossier
$html = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dossier Clínica Bienestar</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1 { text-align: center; color: #0B292E; }
        h2 { color: #0B292E; margin-top: 30px; }
        h3 { color: #0B292E; }
        .cover { text-align: center; margin-bottom: 50px; }
        .cover img { width: 150px; height: auto; }
        .section { margin-top: 40px; }
        ul { margin-left: 20px; }
        .page-break { page-break-before: always; }
    </style>
</head>
<body>
    <div class="cover">
        <img src="img/logoClinica2.png" alt="Logo Clínica">
        <h1>CLÍNICA BIENESTAR - SISTEMA DE GESTIÓN MÉDICA</h1>
        <p><strong>Ciclo Académico:</strong> Desarrollo de Aplicaciones Web</p>
        <p><strong>Título:</strong> Sistema de Gestión Médica para Clínica Oftalmológica Bienestar</p>
        <p><strong>Autor:</strong> [Your Name]</p>
        <p><strong>Profesor:</strong> [Professor\'s Name]</p>
        <p><strong>Lugar y Fecha:</strong> [Location], ' . date('Y') . '</p>
    </div>

    <div class="page-break"></div>

    <div class="section">
        <h1>PARTE GENERAL O TEÓRICA</h1>
        
        <h2>Introducción</h2>
        <p>El proyecto consiste en un sistema web para la gestión de una clínica oftalmológica, facilitando la administración de citas médicas, información de especialistas y la interacción con pacientes.</p>
        
        <h2>Capítulo I: Planteamiento del Problema</h2>
        
        <h3>1.1 Breve definición del tema</h3>
        <p>Desarrollo de una plataforma web para la gestión integral de servicios médicos oftalmológicos, incluyendo gestión de citas, perfiles médicos y servicios especializados.</p>
        
        <h3>1.2 Justificación del problema</h3>
        <ul>
            <li>Necesidad de digitalizar procesos médicos</li>
            <li>Mejora en la gestión de citas</li>
            <li>Acceso fácil a información de especialistas</li>
            <li>Optimización de procesos administrativos</li>
        </ul>
        
        <h3>1.3 Objetivo general</h3>
        <p>Implementar un sistema web que optimice la gestión de servicios médicos y mejore la experiencia de pacientes en la Clínica Bienestar.</p>
        
        <h3>1.4 Objetivos específicos</h3>
        <ul>
            <li>Desarrollar un sistema de gestión de citas médicas</li>
            <li>Implementar perfiles detallados de especialistas</li>
            <li>Crear una interfaz intuitiva para pacientes</li>
            <li>Facilitar la administración de servicios médicos</li>
        </ul>
        
        <h3>1.5 Metodología de investigación</h3>
        <ul>
            <li>Metodología ágil</li>
            <li>Desarrollo iterativo</li>
            <li>Enfoque centrado en el usuario</li>
        </ul>
    </div>

    <div class="page-break"></div>

    <div class="section">
        <h1>PARTE ESPECÍFICA O ANALÍTICA</h1>
        
        <h2>Capítulo II: Solución del Problema</h2>
        
        <h3>2.1 Breve historial de la empresa</h3>
        <p>Clínica Bienestar es un centro oftalmológico especializado en servicios de salud visual.</p>
        
        <h3>2.2 Organigrama de la empresa</h3>
        <ul>
            <li>Dirección Médica</li>
            <li>Especialistas</li>
            <li>Administración</li>
            <li>Atención al Paciente</li>
        </ul>
        
        <h3>2.3 Diagrama de vida útil</h3>
        <ul>
            <li>Registro de pacientes</li>
            <li>Gestión de citas</li>
            <li>Atención médica</li>
            <li>Seguimiento</li>
            <li>Historial médico</li>
        </ul>
        
        <h3>2.6 Técnicas y tecnologías</h3>
        
        <h4>2.6.1 Tecnologías utilizadas</h4>
        <ul>
            <li>Frontend: HTML5, CSS3, JavaScript</li>
            <li>Backend: PHP</li>
            <li>Base de datos: MySQL</li>
            <li>Frameworks: Bootstrap</li>
            <li>Bibliotecas: Font Awesome</li>
        </ul>
    </div>
</body>
</html>';

// Save HTML to file
$file = 'Dossier_ClinicaBienestar.html';
file_put_contents($file, $html);

// Provide download link
echo '<html><body>';
echo '<h2>Dossier generado correctamente</h2>';
echo '<p>Haga clic en el siguiente enlace para descargar el dossier:</p>';
echo '<a href="' . $file . '" download>Descargar Dossier</a>';
echo '<p>Instrucciones:</p>';
echo '<ol>';
echo '<li>Descargue el archivo HTML</li>';
echo '<li>Abra Microsoft Word</li>';
echo '<li>Vaya a Archivo > Abrir y seleccione el archivo descargado</li>';
echo '<li>Word convertirá automáticamente el HTML a formato Word</li>';
echo '<li>Guarde el documento como .docx</li>';
echo '</ol>';
echo '</body></html>';
?>