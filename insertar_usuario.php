<?php
// Configuración de conexión Clever Cloud
$host = "bsckrubjjzqorbtjjw1z-mysql.services.clever-cloud.com";
$user = "uio8t7laqxrnqqyq";
$pass = "1QobuL1ux5XHcT6MyM1c";
$db   = "bsckrubjjzqorbtjjw1z";

$conexion = new mysqli($host, $user, $pass, $db);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Recibir datos por POST
$usuario   = $_POST['usuario'];
$password  = $_POST['password']; // Se asume que ya viene encriptado desde Android
$nombre    = $_POST['nombre'];
$email     = $_POST['email'];
$telefono  = $_POST['telefono'];
$estado    = $_POST['estado'];
$fecha     = $_POST['fecha_registro'];

// Preparar consulta
$stmt = $conexion->prepare("INSERT INTO usuarios (usuario, password, nombre, email, telefono, estado, fecha_registro) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssis", $usuario, $password, $nombre, $email, $telefono, $estado, $fecha);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>