<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root";
$pass = "";
$bd ="registro";

$usuario =$_POST['usuario'];
$clave=$_POST['clave'];

$connection = mysqli_connect($host, $user, $pass, $bd);
$consulta="SELECT* FROM usuarios WHERE usuario='$usuario' and clave='$clave'";
$resultado=mysqli_query($connection,$consulta);
$filas=mysqli_num_rows($resultado);

if($filas>0)
{
    header ("location:comunidad.html");
}
else
{
    echo "Error en la validación";
}
?>                    