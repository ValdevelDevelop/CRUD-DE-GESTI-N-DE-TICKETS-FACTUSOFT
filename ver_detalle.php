<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "factusoft_db");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID de la factura
$id = $_GET['id'];

// Consultar los datos de la factura
$sql = "SELECT * FROM facturas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$factura = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Factura</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        header h1 {
            margin: 0;
        }
        nav {
            margin: 10px 0;
            text-align: center;
        }
        nav a {
            margin: 0 10px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .factura-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .factura-container h1 {
            text-align: center;
            color: #333;
        }
        .factura-container p {
            margin: 10px 0;
            font-size: 18px;
        }
        .factura-container p strong {
            display: inline-block;
            width: 150px;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            color: #fff;
            background-color: #333;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #555;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Detalle de Factura</h1>
        <nav>
            <a href="index.php">Inicio</a>
           
        </nav>
    </header>
    <main>
        <div class="factura-container">
            <?php if ($factura): ?>
                <p><strong>ID:</strong> <?php echo $factura['id']; ?></p>
                <p><strong>Cliente:</strong> <?php echo $factura['cliente']; ?></p>
                <p><strong>Fecha:</strong> <?php echo $factura['fecha']; ?></p>
                <p><strong>Total:</strong> $<?php echo number_format($factura['total'], 2); ?></p>
            <?php else: ?>
                <p>No se encontraron detalles para esta factura.</p>
            <?php endif; ?>

            <a href="ver_facturas.php" class="btn">Volver a Facturas Generadas</a>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 FactuSoft. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
