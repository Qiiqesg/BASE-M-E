<?php
require_once _DIR_ . "/../lib/php/ejecutaServicio.php";
require_once _DIR_ . "/../lib/php/recuperaIdEntero.php";
require_once _DIR_ . "/../lib/php/delete.php";
require_once _DIR_ . "/../lib/php/devuelveNoContent.php";
require_once _DIR_ . "/Bd.php";

ejecutaServicio(function () {
  $id = recuperaIdEntero("id");
  $conexion = Bd::conexion();
  $stmt = $conexion->prepare("DELETE FROM Eregistros WHERE id_registro = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();

  devuelveNoContent();
});
?>