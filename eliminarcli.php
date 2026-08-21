<?php

require_once("manipularcli.php");

if(isset($_GET["id"])){

    modificarcliente::eliminar($_GET["id"]);

}

header("Location: frmcliente.php?msg=eliminado");
?>