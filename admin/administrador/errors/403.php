<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>403 - Acceso Denegado</title>
    <style>
        body { 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }
        .error-container {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 { color: #d9534f; }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #5cb85c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>403</h1>
        <h2>Acceso Denegado</h2>
        <p>No tienes permisos para acceder a esta página.</p>
        <a href="/ClinicaBienestar/admin/administrador/dashboard.php" class="btn">Volver al inicio</a>
    </div>
</body>
</html>