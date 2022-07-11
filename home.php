<?php
require("includes/config.php");
session_start();
//if (!isset($_SESSION["username"])) {
//  header("Location: index.php");
//}

//$check = $_SESSION["username"];

//$sql = "SELECT user, email FROM admin WHERE email='$check'";
//$resultado = $db->query($sql);
//$user = $resultado->fetch_assoc();

//printf("<strong>ÉXITO!!</strong> Inicio de sesion realizado correctamente");
echo("Bienvenido");
//echo utf8_decode($user['email']);
echo("<hr>");
echo("<a href='includes/logout.php'>Salir</a>");



?>