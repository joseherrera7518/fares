<?php
require_once 'manipularcli.php';

$porPagina = 5;

$pagina = isset($_GET["pagina"]) ? (int)$_GET["pagina"] : 1;

if ($pagina < 1) {
    $pagina = 1;
}

$inicio = ($pagina - 1) * $porPagina;

$clientes = modificarcliente::listarPaginado($inicio, $porPagina);

$total = modificarcliente::totalRegistros();

$totalPaginas = ceil($total / $porPagina);
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Ediciones Fares</title>

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

        <h1>Ediciones Fares</h1>

    </header>


    <!-- MENÚ -->
    <nav class="menu">

        <a href="frmcliente.php">Principal</a>

        <a href="#">Libros</a>

        <a href="#">Inventario</a>

        <a href="#">Contacto</a>

    </nav>


    <!-- CONTENIDO -->
    <main class="contenido">


        <!-- MENSAJE ACTUALIZADO -->
        <?php if (isset($_GET["msg"]) && $_GET["msg"] == "actualizado") { ?>

            <div class="alert alert-primary mensaje">

                Cliente actualizado correctamente.

            </div>

        <?php } ?>


        <!-- MENSAJE ELIMINADO -->
        <?php if (isset($_GET["msg"]) && $_GET["msg"] == "eliminado") { ?>

            <div class="alert alert-danger mensaje">

                Cliente eliminado correctamente.

            </div>

        <?php } ?>


        <!-- ==========================================
             FORMULARIO + TABLA
        =========================================== -->

        <div class="clientes-contenedor">


            <!-- FORMULARIO -->
            <form class="formulario-cliente"
                  action="guardarcli.php"
                  method="post">

                <div class="titulo-formulario">

                    Ingresar datos del cliente

                </div>


                <div class="formulario-contenido">


                    <div class="form-row">

                        <div class="form-group col-md-4">

                            <label>Código</label>

                            <input type="text"
                                   name="ccodigo"
                                   class="form-control"
                                   placeholder="1000">

                        </div>


                        <div class="form-group col-md-8">

                            <label>Nombre</label>

                            <input type="text"
                                   name="cnomcliente"
                                   class="form-control"
                                   placeholder="Nombre del cliente"
                                   required>

                        </div>

                    </div>


                    <div class="form-group">

                        <label>Dirección</label>

                        <textarea name="cdireccion"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Dirección"></textarea>

                    </div>


                    <div class="form-row">

                        <div class="form-group col-md-6">

                            <label>Teléfono residencial</label>

                            <input type="text"
                                   name="ctelcasa"
                                   class="form-control"
                                   placeholder="Teléfono residencial">

                        </div>


                        <div class="form-group col-md-6">

                            <label>Celular</label>

                            <input type="text"
                                   name="ccelular"
                                   class="form-control"
                                   placeholder="Celular">

                        </div>

                    </div>


                    <div class="form-group">

                        <label>Email</label>

                        <input type="email"
                               name="cemail"
                               class="form-control"
                               placeholder="Correo electrónico">

                    </div>


                    <button type="submit"
                            name="guardar"
                            class="btn btn-fares">

                        Guardar

                    </button>

                </div>

            </form>



            <!-- TABLA DE CLIENTES -->
            <div class="clientes-registrados">


                <div class="titulo-clientes">

                    Clientes registrados

                </div>


                <div class="table-responsive">

                    <table class="table tabla-clientes">

                        <thead>

                            <tr>

                                <th>Código</th>

                                <th>Nombre</th>

                                <th>Dirección</th>

                                <th>Tel. residencial</th>

                                <th>Celular</th>

                                <th>Email</th>

                                <th>Acción</th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php if (count($clientes) > 0) { ?>


                                <?php foreach ($clientes as $cliente) { ?>

                                    <tr>

                                        <td>
                                            <?php echo $cliente["idcli"]; ?>
                                        </td>


                                        <td>
                                            <?php echo $cliente["nomcli"]; ?>
                                        </td>


                                        <td>
                                            <?php echo $cliente["direccion"]; ?>
                                        </td>


                                        <td>
                                            <?php echo $cliente["telres_cli"]; ?>
                                        </td>


                                        <td>
                                            <?php echo $cliente["telcel_cli"]; ?>
                                        </td>


                                        <td>
                                            <?php echo $cliente["email_cli"]; ?>
                                        </td>


                                        <td class="acciones">


                                            <a href="frmeditarcliente.php?id=<?php echo $cliente['idcli']; ?>"
                                               class="btn btn-warning btn-sm">

                                                <i class="fa-solid fa-pen"></i>

                                                Modificar

                                            </a>


                                            <a href="eliminarcli.php?id=<?php echo $cliente['idcli']; ?>"
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('¿Desea eliminar este cliente?');">

                                                <i class="fa-solid fa-trash"></i>

                                                Eliminar

                                            </a>


                                        </td>

                                    </tr>

                                <?php } ?>


                            <?php } else { ?>

                                <tr>

                                    <td colspan="7"
                                        class="text-center">

                                        No hay clientes registrados.

                                    </td>

                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>


                <!-- PAGINACIÓN DEBAJO DE LA TABLA -->

                <div class="paginacion">

                    <ul class="pagination justify-content-center">


                        <?php if ($pagina > 1) { ?>

                            <li class="page-item">

                                <a class="page-link"
                                   href="?pagina=<?php echo $pagina - 1; ?>">

                                    Anterior

                                </a>

                            </li>

                        <?php } ?>


                        <?php for ($i = 1; $i <= $totalPaginas; $i++) { ?>

                            <li class="page-item <?php echo ($i == $pagina) ? 'active' : ''; ?>">

                                <a class="page-link"
                                   href="?pagina=<?php echo $i; ?>">

                                    <?php echo $i; ?>

                                </a>

                            </li>

                        <?php } ?>


                        <?php if ($pagina < $totalPaginas) { ?>

                            <li class="page-item">

                                <a class="page-link"
                                   href="?pagina=<?php echo $pagina + 1; ?>">

                                    Siguiente

                                </a>

                            </li>

                        <?php } ?>


                    </ul>

                </div>

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