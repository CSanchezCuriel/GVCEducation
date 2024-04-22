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
// Recopilación de datos del formulario
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$correo = $_POST["correo"];
$contrasena = $_POST["contrasena"];
$tipoCuenta = $_POST["tipoCuenta"];
$clavEmpleado = "";
$turno = "";
$ncontrol = "";
$edad = "";
$carrera = "";
$semestre = "";
$grupo = "";
if ($tipoCuenta == "profesor") {
    $clavEmpleado = $_POST["clavEmpleado"];
    $turno = $_POST["turno"];
} elseif ($tipoCuenta == "estudiante") {
    $ncontrol = $_POST["ncontrol"];
    $edad = $_POST["edad"];
    $carrera = $_POST["carrera"];
    $semestre = $_POST["semestre"];
    $grupo = $_POST["grupo"];
}
// Insertar los datos del usuario en la tabla "usuarios"
$sql = "INSERT INTO usuarios (nombre, apellido, correo, contrasena, tipoCuenta, 
clavEmpleado, turno, ncontrol, edad, carrera, semestre, grupo) 
VALUES ('$nombre', '$apellido', '$correo', '$contrasena', '$tipoCuenta',
'$clavEmpleado', '$turno', '$ncontrol', '$edad', '$carrera', '$semestre', '$grupo')";
if (mysqli_query($connection, $sql)) {
    echo "Registro exitoso";
} else {
    echo "Error al registrar al usuario: " . mysqli_error($connection);
}
mysqli_close($connection);
?>
