<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root";
$pass = "";
$bd = "registro";

$connection = mysqli_connect($host, $user, $pass, $bd);

// Verificación de la conexión
if (!$connection) {
    die("La conexión falló: " . mysqli_connect_error());
}

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipoCuenta = $_POST["tipoCuenta"];

    if ($tipoCuenta == "estudiante") {
        $username = $_POST["usernameEst"];
        $password = $_POST["passwordEst"];
    } elseif ($tipoCuenta == "profesor") {
        $username = $_POST["usernamePro"];
        $password = $_POST["passwordPro"];
    } else {
        die("Tipo de cuenta desconocido");
    }

    // Buscar al usuario en la base de datos
    if ($tipoCuenta == "estudiante") {
        $sql = "SELECT * FROM usuarios WHERE ncontrol = '$username'";
    } elseif ($tipoCuenta == "profesor") {
        $sql = "SELECT * FROM usuarios WHERE clavEmpleado = '$username'";
    }

    $resultado = mysqli_query($connection, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        // El usuario fue encontrado, verificar la contraseña
        $usuario = mysqli_fetch_assoc($resultado);

        if ($password == $usuario["contrasena"]) {
            // Iniciar sesión
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["tipoCuenta"] = $tipoCuenta;

            // Redirigir a la página correspondiente según el tipo de cuenta
            if ($tipoCuenta == "estudiante") {
                header("Location: estudiantes.html"); // redirigir a la página principal para estudiantes
            } elseif ($tipoCuenta == "profesor") {
                header("Location: profesores.html"); // redirigir a la página principal para profesores
            }

        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta";
        }
    } else {
        // Usuario no encontrado
        echo "Usuario no encontrado";
    }
}

mysqli_close($connection);
?>
