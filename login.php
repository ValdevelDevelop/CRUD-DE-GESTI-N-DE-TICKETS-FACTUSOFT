<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "if0_37252963_factusoft_db");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID de la factura a imprimir
$id = $_GET['id'];

// Consultar la factura
$sql = "SELECT * FROM facturas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $factura = $result->fetch_assoc();
} else {
    echo "Factura no encontrada.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        header {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        .login-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
            margin-top: 80px; /* Espacio para el encabezado */
        }
        .login-container h1 {
            margin-top: 0;
            color: #333;
            text-align: center;
        }
        .login-container label {
            display: block;
            margin-bottom: 8px;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .login-container input[type="submit"] {
            background-color: #333;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        .login-container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>FactuSoft</h1>
    </header>
    <div class="login-container">
        <h1>Inicio de Sesión</h1>
        <form action="validar_login.php" method="POST">
            <label for="correo">Correo:</label>
            <input type="text" name="correo" required><br>

            <label for="contraseña">Contraseña:</label>
            <input type="password" name="contraseña" required><br>

            <input type="submit" value="Iniciar Sesión">
        </form>
    </div>
</body>
</html>
