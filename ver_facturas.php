<?php
// Conexión a la base de datos
$conn = new mysqli("sql104.infinityfree.com", "if0_37252963", "1107974585", "if0_37252963_factusoft_db");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar facturas
$sql = "SELECT * FROM facturas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturas Generadas</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }
        main {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #333;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        a {
            color: ;
            text-decoration: none;
            margin-right: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
        footer {
            background-color: ;
            color: white;
            padding: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <h1>Facturas Generadas</h1>
    </header>
    <main>
        <table>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["cliente"] . "</td>";
                    echo "<td>" . $row["fecha"] . "</td>";
                    echo "<td>$" . number_format($row["total"], 2) . "</td>";
                    echo "<td>";
                    echo "<a href='ver_detalle.php?id=" . $row["id"] . "'>Ver</a>";
                    echo "<a href='editar_factura.php?id=" . $row["id"] . "'>Editar</a>";
                    echo "<a href='eliminar_factura.php?id=" . $row["id"] . "' onclick=\"return confirm('¿Estás seguro de que deseas eliminar esta factura?');\">Eliminar</a>";
                    echo "<a href='print_factura.php?id=" . $row["id"] . "'>Imprimir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay facturas</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </main>
    <footer>
        <a href="index.php">Volver al inicio</a>
        <p>&copy; 2024 FactuSoft. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
