<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Factura</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Crear Factura</h1>
        <a href="index.php">Volver </a>
    </header>
    <main>
        <form action="procesar_factura.php" method="POST">
            <label for="cliente">Cliente:</label>
            <input type="text" name="cliente" required><br>

            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" required><br>

            <label for="total">Total:</label>
            <input type="number" step="0.01" name="total" required><br>

            <input type="submit" value="Crear Factura">
        </form>
    </main>
    <footer>
        <p>&copy; 2024 FactuSoft. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
