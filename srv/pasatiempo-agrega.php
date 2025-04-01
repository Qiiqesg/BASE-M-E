<?php
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";

ejecutaServicio(function () {
  $nombre = validaNombre(recuperaTexto("nombre"));
  $telefono = recuperaTexto("telefono");
  $correo = recuperaTexto("correo");

  $conexion = Bd::conexion();
  $stmt = $conexion->prepare("INSERT INTO Eregistros (nombre, telefono, correo) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $nombre, $telefono, $correo);
  $stmt->execute();

  $id = $stmt->insert_id;

  $encodeId = urlencode($id);
  devuelveCreated("/srv/pasatiempo.php?id=$encodeId", [
    "id" => ["value" => $id],
    "nombre" => ["value" => $nombre],
    "telefono" => ["value" => $telefono],
    "correo" => ["value" => $correo],
  ]);
});
?>