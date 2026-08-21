<?php
/*
    Archivo: manipularcli.php

    Clase modificarcliente.
    Hereda de datospersona y manipula la tabla clientes.
*/

require_once 'conexionf2.php';
require_once 'fclases.php';

class modificarcliente extends datospersona
{
    const TABLA = 'clientes';

    // Guardar un cliente
    public function guardar()
    {
        $conexion = new Conexion();

        $consulta = $conexion->prepare(
            'INSERT INTO ' . self::TABLA . '
            (nomcli, direccion, telres_cli, telcel_cli, email_cli)
            VALUES (:nombre, :direccion, :telresidencial, :telcelular, :email)'
        );

        $consulta->bindParam(':nombre', $this->dnombre);
        $consulta->bindParam(':direccion', $this->ddireccion);
        $consulta->bindParam(':telresidencial', $this->dtelresi);
        $consulta->bindParam(':telcelular', $this->dtelcel);
        $consulta->bindParam(':email', $this->demail);

        $consulta->execute();

        $conexion = null;
    }

    // Listar todos los clientes
    public static function listar()
    {
        $conexion = new Conexion();

        $consulta = $conexion->prepare(
            'SELECT * FROM ' . self::TABLA . ' ORDER BY idcli DESC'
        );

        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Consultar clientes (ID y nombre)
    public static function ConsultarClientes()
    {
        $conexion = new Conexion();

        $consulta = $conexion->prepare(
            'SELECT idcli, nomcli FROM ' . self::TABLA
        );

        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    // Buscar un cliente por código
public static function buscar($codigo)
{
    $conexion = new Conexion();

    $consulta = $conexion->prepare(
        'SELECT * FROM ' . self::TABLA . ' WHERE idcli = :codigo'
    );

    $consulta->bindParam(':codigo', $codigo);
    $consulta->execute();

    return $consulta->fetch(PDO::FETCH_ASSOC);
}

// Actualizar un cliente
public function actualizar()
{
    $conexion = new Conexion();

    $consulta = $conexion->prepare(
        'UPDATE ' . self::TABLA . '
        SET
            nomcli = :nombre,
            direccion = :direccion,
            telres_cli = :telresidencial,
            telcel_cli = :telcelular,
            email_cli = :email
        WHERE idcli = :codigo'
    );

    $consulta->bindParam(':codigo', $this->dcodigo);
    $consulta->bindParam(':nombre', $this->dnombre);
    $consulta->bindParam(':direccion', $this->ddireccion);
    $consulta->bindParam(':telresidencial', $this->dtelresi);
    $consulta->bindParam(':telcelular', $this->dtelcel);
    $consulta->bindParam(':email', $this->demail);

    $consulta->execute();

    $conexion = null;
}

// Eliminar un cliente
public static function eliminar($codigo)
{
    $conexion = new Conexion();

    $consulta = $conexion->prepare(
        'DELETE FROM ' . self::TABLA . ' WHERE idcli = :codigo'
    );

    $consulta->bindParam(':codigo', $codigo);
    $consulta->execute();

    $conexion = null;
}

// Total de registros
public static function totalRegistros()
{
    $conexion = new Conexion();

    $consulta = $conexion->prepare(
        'SELECT COUNT(*) total FROM ' . self::TABLA
    );

    $consulta->execute();

    $fila = $consulta->fetch(PDO::FETCH_ASSOC);

    return $fila["total"];
}

// Listar con paginación
public static function listarPaginado($inicio, $cantidad)
{
    $conexion = new Conexion();

    $consulta = $conexion->prepare(
        'SELECT * FROM ' . self::TABLA . '
        ORDER BY idcli DESC
        LIMIT :inicio, :cantidad'
    );

    $consulta->bindValue(':inicio', (int)$inicio, PDO::PARAM_INT);
    $consulta->bindValue(':cantidad', (int)$cantidad, PDO::PARAM_INT);

    $consulta->execute();

    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}
}
?>