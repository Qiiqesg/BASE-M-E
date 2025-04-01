<?php
require_once _DIR_ . "/../lib/php/ejecutaServicio.php";
require_once _DIR_ . "/../lib/php/recuperaIdEntero.php";
require_once _DIR_ . "/../lib/php/recuperaTexto.php";
require_once _DIR_ . "/../lib/php/validaNombre.php";
require_once _DIR_ . "/../lib/php/update.php";
require_once _DIR_ . "/../lib/php/devuelveJson.php";
require_once _DIR_ . "/Bd.php";

ejecutaServicio(function () {
  $id = recuperaIdEntero("id");
  $nombre = validaNombre(recuperaTexto("nombre"));
  $telefono = recuperaTexto("telefono");
  $correo = recuperaTexto("correo");

  $conexion = Bd::conexion();
  $stmt = $conexion->prepare("UPDATE Eregistros SET nombre = ?, telefono = ?, correo = ? WHERE id_registro = ?");
  $stmt->bind_param("sssi", $nombre, $telefono, $correo, $id);
  $stmt->execute();

  devuelveJson([
    "id" => ["value" => $id],
    "nombre" => ["value" => $nombre],
    "telefono" => ["value" => $telefono],
    "correo" => ["value" => $correo],
  ]);
});
?>