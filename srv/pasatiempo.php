<?php
require_once _DIR_ . "/../lib/php/NOT_FOUND.php";
require_once _DIR_ . "/../lib/php/ejecutaServicio.php";
require_once _DIR_ . "/../lib/php/recuperaIdEntero.php";
require_once _DIR_ . "/../lib/php/selectFirst.php";
require_once _DIR_ . "/../lib/php/ProblemDetails.php";
require_once _DIR_ . "/../lib/php/devuelveJson.php";
require_once _DIR_ . "/Bd.php";

ejecutaServicio(function () {
  $id = recuperaIdEntero("id");
  $conexion = Bd::conexion();
  $stmt = $conexion->prepare("SELECT nombre, telefono, correo FROM Eregistros WHERE id_registro = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $resultado = $stmt->get_result();
  $modelo = $resultado->fetch_assoc();

  if (!$modelo) {
    $idHtml = htmlentities($id);
    throw new ProblemDetails(
      status: NOT_FOUND,
      title: "Registro no encontrado",
      type: "/error/registro-no-encontrado.html",
      detail: "No se encontró ningún registro con el id $idHtml."
    );
  }

  devuelveJson([
    "id" => ["value" => $id],
    "nombre" => ["value" => $modelo["nombre"]],
    "telefono" => ["value" => $modelo["telefono"]],
    "correo" => ["value" => $modelo["correo"]],
  ]);
});
?>