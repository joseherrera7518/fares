<?php

require_once("manipularcli.php");

$cliente = new modificarcliente(

$_POST["ccodigo"],
$_POST["cnombre"],
$_POST["cdireccion"],
$_POST["ctelresi"],
$_POST["ctelcel"],
$_POST["cemail"]

);

$cliente->actualizar();

header("Location: frmcliente.php?msg=actualizado");

?>