

<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "if0_37252963_factusoft_db");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$id = $_POST['id'];
$cliente = $_POST['cliente'];
$fecha = $_POST['fecha'];
$total = $_POST['total'];

// Actualizar la factura en la base de datos
$sql = "UPDATE facturas SET cliente='$cliente', fecha='$fecha', total=$total WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    $mensaje = "Factura actualizada exitosamente.";
} else {
    $mensaje = "Error al actualizar la factura: " . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Factura</title>
    <script>
        // Redirigir a la página de lista de facturas después de unos segundos
        setTimeout(function() {
            window.location.href = "ver_facturas.php";
        }, 2000); // 2000 milisegundos = 2 segundos
    </script>
</head>
<body>
    <h1><?php echo $mensaje; ?></h1>
    <p>Serás redirigido a la lista de facturas en breve...</p>
</body>
</html>
