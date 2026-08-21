<?php

require_once "datosProductos.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom_producto = $_POST["nom_producto"] ?? "";
    $costo = $_POST["costo"] ?? 0;
    $porc_venta = $_POST["porc_venta"] ?? 0;
    $precio_venta = $_POST["precio_venta"] ?? 0;
    $imagen = $_POST["Imagen"] ?? "";
    $fecha = $_POST["Fecha"] ?? null;


    // Crear objeto usando la clase del maestro
    $producto = new datosProductos(
        null,
        $nom_producto,
        $costo,
        $porc_venta,
        $precio_venta,
        $imagen,
        0,
        $fecha
    );


    // Guardar producto
    $producto->guardarProducto();


    // Regresar al inventario
    header("Location: inventario.php?msg=guardado");
    exit;

}

?>