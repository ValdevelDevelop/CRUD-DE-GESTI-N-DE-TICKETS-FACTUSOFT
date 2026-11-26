<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "if0_37252963_factusoft_db");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Recoger datos del formulario
    $cliente = $_POST['cliente'];
    $fecha = $_POST['fecha'];
    $total = $_POST['total'];

    // Insertar factura en la base de datos
    $sql = "INSERT INTO facturas (cliente, fecha, total) VALUES ('$cliente', '$fecha', $total)";

    if ($conn->query($sql) === TRUE) {
        echo "Factura creada exitosamente.<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<a href="ver_facturas.php">Volver a la lista de Facturas</a>
