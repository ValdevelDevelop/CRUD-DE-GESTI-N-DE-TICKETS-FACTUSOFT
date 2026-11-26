<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['correo'])) {
    header("Location: login.php"); // Redirigir al inicio de sesión si no está autenticado
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a FactuSoft</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Bienvenido a FactuSoft</h1>
        <nav>
            <a href="crear_factura.php">Crear Factura</a>
            <a href="ver_facturas.php">Listar Facturas</a>
            <a href="logout.php">Cerrar Sesión</a> <!-- Opcional: Para cerrar sesión -->
        </nav>
    </header>
    <main>
        <p>Utiliza las opciones de arriba para crear una nueva factura o ver la lista de facturas generadas.</p>
    </main>
    <footer>
        <p>&copy; 2024 FactuSoft. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
