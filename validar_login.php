<?php
session_start();

// Conexión a la base de datos
conn = new mysqli("sql104.infinityfree.com", "if0_37252963", "1107974585", "if0_37252963_factusoft_db");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recoger datos del formulario
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];

// Consulta para verificar usuario
$sql = "SELECT id FROM usuarios WHERE correo = ? AND contraseña = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $correo, $contraseña);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Usuario válido, iniciar sesión
    $_SESSION['correo'] = $correo; // Guardar información del usuario en sesión
    header("Location: index.php"); // Redirigir a la página principal
    exit();
} else {
    // Usuario no válido
    echo "Correo o contraseña incorrectos.<br>";
    echo "<a href='login.php'>Volver a intentar</a>";
}

$stmt->close();
$conn->close();
?>
