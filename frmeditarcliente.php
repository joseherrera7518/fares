<?php
require_once("manipularcli.php");

if (!isset($_GET["id"])) {
    header("Location: frmcliente.php");
    exit;
}

$id = $_GET["id"];

$cliente = modificarcliente::buscar($id);

if (!$cliente) {
    header("Location: frmcliente.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Cliente</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container mt-5">

<div class="card">

<div class="card-header bg-primary text-white">
<h4>Modificar Cliente</h4>
</div>

<div class="card-body">

<form action="actualizarcli.php" method="post">

<div class="form-group">
<label>Código</label>

<input
type="text"
name="ccodigo"
class="form-control"
value="<?php echo $cliente['idcli']; ?>"
readonly>

</div>

<div class="form-group">
<label>Nombre</label>

<input
type="text"
name="cnombre"
class="form-control"
value="<?php echo $cliente['nomcli']; ?>"
required>

</div>

<div class="form-group">
<label>Dirección</label>

<textarea
name="cdireccion"
class="form-control"><?php echo $cliente['direccion']; ?></textarea>

</div>

<div class="form-group">
<label>Teléfono residencial</label>

<input
type="text"
name="ctelresi"
class="form-control"
value="<?php echo $cliente['telres_cli']; ?>">

</div>

<div class="form-group">
<label>Celular</label>

<input
type="text"
name="ctelcel"
class="form-control"
value="<?php echo $cliente['telcel_cli']; ?>">

</div>

<div class="form-group">
<label>Email</label>

<input
type="email"
name="cemail"
class="form-control"
value="<?php echo $cliente['email_cli']; ?>">

</div>

<button class="btn btn-success">
Actualizar
</button>

<a href="frmcliente.php" class="btn btn-secondary">
Cancelar
</a>

</form>

</div>

</div>

</div>

</body>
</html>