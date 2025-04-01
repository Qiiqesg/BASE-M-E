<?php
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";

ejecutaServicio(function () {
  $conexion = Bd::conexion();
  $query = "SELECT id_registro, nombre, correo FROM Eregistros ORDER BY nombre";
  $resultado = $conexion->query($query);

  $render = "";
  while ($fila = $resultado->fetch_assoc()) {
    $id = urlencode($fila["id_registro"]);
    $nombre = htmlentities($fila["nombre"]);
    $correo = htmlentities($fila["correo"]);

    $render .= "<li><p><a href='modifica.html?id=$id'>$nombre</a><br>Correo: $correo</p></li>";
  }

  devuelveJson(["lista" => ["innerHTML" => $render]]);
});
?>