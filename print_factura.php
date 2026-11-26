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
    <title>Imprimir Factura</title>
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
        .factura {
            border: 1px solid #000;
            padding: 20px;
            margin: 20px;
            max-width: 600px;
            background: #fff;
        }
        .factura h1 {
            text-align: center;
        }
        .factura .info {
            margin-bottom: 20px;
        }
        .factura .info div {
            margin-bottom: 5px;
        }
        .factura .acciones {
            text-align: center;
        }
        .no-print {
            display: inline-block;
            margin: 10px;
            padding: 10px;
            background: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .no-print:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="factura">
        <h1>Factura</h1>
        <div class="info">
            <div><strong>ID:</strong> <?php echo $factura['id']; ?></div>
            <div><strong>Cliente:</strong> <?php echo $factura['cliente']; ?></div>
            <div><strong>Fecha:</strong> <?php echo $factura['fecha']; ?></div>
            <div><strong>Total:</strong> $<?php echo number_format($factura['total'], 2); ?></div>
        </div>
        <div class="acciones">
            <button class="no-print" onclick="window.print()">Imprimir Factura</button>
            <br>
            <a class="no-print" href="ver_facturas.php">Volver a la lista de Facturas</a>
        </div>
    </div>
</body>
</html>
