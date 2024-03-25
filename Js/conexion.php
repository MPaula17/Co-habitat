<?php
// Conexión a la base de datos
$servername = "localhost"; // Cambia esto por tu servidor de base de datos
$username = "usuario"; // Cambia esto por tu nombre de usuario de la base de datos
$password = ""; // Cambia esto por tu contraseña de la base de datos
$dbname = "clientespotenciales"; // Cambia esto por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $telefono = mysqli_real_escape_string($conn, $_POST["telefono"]);
    $mensaje = mysqli_real_escape_string($conn, $_POST["mensaje"]);

    // Preparar la consulta SQL para insertar datos en la tabla
    $sql = "INSERT INTO clientes (nombre, email, telefono, mensaje) VALUES (?, ?, ?, ?)";
    
    // Preparar la declaración
    $stmt = $conn->prepare($sql);

    // Vincular parámetros
    $stmt->bind_param("ssss", $nombre, $email, $telefono, $mensaje);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Información insertada correctamente";
    } else {
        echo "Error al insertar información: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
}

// Cerrar conexión
$conn->close();
?>
