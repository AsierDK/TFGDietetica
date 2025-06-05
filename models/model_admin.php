<?php
require_once '../bbdd/bbdd.php';
function recuperarUsuarios()
{
    try
    {
        $conn=conexionbbdd();
        $stmt = $conn->prepare("SELECT * FROM Usuarios where administrador = 0");
        $stmt -> execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado=$stmt->fetchAll();
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
    $conn=null;
    return $resultado;
}

function crearAlumno($params)
{
    try
    {
        $conn=conexionbbdd();
        $stmt = $conn->prepare("INSERT INTO Usuarios (nombre, apellidos, email, contrasena) VALUES (:nombre, :apellidos, :email, :pass)");
        $stmt->bindParam(':nombre', $params['name']);
        $stmt->bindParam(':apellidos', $params['ape']);
        $stmt->bindParam(':email', $params['email']);
        $stmt->bindParam(':pass', $params['pass']);
        $stmt -> execute();
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
    $conn=null;
}

function cambiarContrasenaAlumno($idAlumno,$contrasena)
{
    try
    {
        $conn=conexionbbdd();
        $stmt = $conn->prepare("UPDATE Usuarios SET contrasena = :pass WHERE id_usuario = :id");
        $stmt->bindParam(':id', $idAlumno);
        $stmt->bindParam(':pass', $contrasena);
        $stmt -> execute();
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
    $conn=null;
}
?>