<?php

require_once "datosProductos.php";

$conexion = new Conexion();

$consulta = $conexion->prepare(
    "SELECT * FROM inventario ORDER BY codigo DESC"
);

$consulta->execute();

$productos = $consulta->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Inventario - Ediciones Fares</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<link rel="stylesheet" href="css/style.css">

</head>


<body>


<div class="contenedor-principal">


<!-- ENCABEZADO -->

<header class="encabezado">

<h1>
Ediciones Fares
</h1>

</header>



<!-- MENÚ -->

<nav class="menu">

<a href="frmcliente.php">
Principal
</a>

<a href="#">
Libros
</a>

<a href="inventario.php">
Inventario
</a>

<a href="#">
Contacto
</a>

</nav>



<!-- CONTENIDO -->

<main class="contenido">


<?php

if(isset($_GET["msg"]) && $_GET["msg"] == "guardado"){

?>

<div class="alert alert-success">

Producto guardado correctamente.

</div>

<?php

}

?>



<!-- ================= FORMULARIO ================= -->

<div class="clientes-contenedor">


<div class="clientes-registrados">


<div class="titulo-clientes">

Registrar producto

</div>



<div class="formulario-contenido">


<form action="guardarproducto.php" method="POST">



<div class="form-row">


<div class="form-group col-md-6">

<label>
Nombre del producto
</label>

<input
type="text"
name="nom_producto"
class="form-control"
placeholder="Ejemplo: Shampoo para mascotas"
required>

</div>



<div class="form-group col-md-3">

<label>
Costo
</label>

<input
type="number"
step="0.01"
name="costo"
class="form-control"
placeholder="0.00"
required>

</div>



<div class="form-group col-md-3">

<label>
Porcentaje de venta
</label>

<input
type="number"
step="0.01"
name="porc_venta"
class="form-control"
placeholder="0">

</div>


</div>



<div class="form-row">


<div class="form-group col-md-4">

<label>
Precio de venta
</label>

<input
type="number"
step="0.01"
name="precio_venta"
class="form-control"
placeholder="0.00"
required>

</div>



<div class="form-group col-md-4">

<label>
Imagen
</label>

<input
type="text"
name="Imagen"
class="form-control"
placeholder="Nombre de imagen">

</div>



<div class="form-group col-md-4">

<label>
Fecha
</label>

<input
type="date"
name="Fecha"
class="form-control">

</div>


</div>



<button
type="submit"
class="btn btn-fares">

<i class="fa-solid fa-floppy-disk"></i>

Guardar producto

</button>


</form>


</div>

</div>


</div>



<!-- ================= LISTA ================= -->


<div class="clientes-registrados mt-4">


<div class="titulo-clientes">

Productos registrados

</div>



<div class="table-responsive">


<table class="table tabla-clientes">


<thead>


<tr>

<th>
Código
</th>

<th>
Producto
</th>

<th>
Costo
</th>

<th>
% Venta
</th>

<th>
Precio Venta
</th>

<th>
Stock
</th>

<th>
Imagen
</th>

<th>
Fecha
</th>

</tr>


</thead>



<tbody>


<?php

if(count($productos) > 0){

foreach($productos as $producto){

?>


<tr>


<td>

<?php echo $producto["codigo"]; ?>

</td>


<td>

<?php echo $producto["nom_producto"]; ?>

</td>


<td>

L. <?php echo $producto["costo"]; ?>

</td>


<td>

<?php echo $producto["porc_venta"]; ?>%

</td>


<td>

L. <?php echo $producto["precio_venta"]; ?>

</td>


<td>

<strong>

<?php echo $producto["stock"]; ?>

</strong>

</td>


<td>

<?php echo $producto["Imagen"]; ?>

</td>


<td>

<?php echo $producto["Fecha"]; ?>

</td>


</tr>


<?php

}

}else{

?>


<tr>

<td colspan="8" class="text-center">

No hay productos registrados.

</td>

</tr>


<?php

}

?>


</tbody>


</table>


</div>


</div>



</main>



<!-- PIE -->

<footer class="pie">

Ediciones Fares

</footer>


</div>


</body>

</html>