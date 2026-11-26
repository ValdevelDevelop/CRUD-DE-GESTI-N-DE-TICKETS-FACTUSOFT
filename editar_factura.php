<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "if0_37252963_factusoft_db");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID de la factura a editar
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
    <title>Editar Factura</title>
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
        .form-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .form-container h1 {
            text-align: center;
            color: #333;
        }
        .form-container label {
            display: block;
            margin: 10px 0 5px;
        }
        .form-container input[type="text"],
        .form-container input[type="date"],
        .form-container input[type="number"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #45a049;
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
    </style>
</head>
<body>
    <header>
        <h1>Editar Factura</h1>
        <nav>
            <a href="index.php">Inicio</a>
           
        </nav>
    </header>
    <main>
        <div class="form-container">
            <form action="actualizar_factura.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $factura['id']; ?>">

                <label for="cliente">Cliente:</label>
                <input type="text" name="cliente" value="<?php echo $factura['cliente']; ?>" required>

                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" value="<?php echo $factura['fecha']; ?>" required>

                <label for="total">Total:</label>
                <input type="number" step="0.01" name="total" value="<?php echo $factura['total']; ?>" required>

                <input type="submit" value="Actualizar Factura">
            </form>

            <a href="ver_facturas.php" class="btn">Volver a Facturas Generadas</a>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 FactuSoft. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
