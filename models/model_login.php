<?php
require_once '../bbdd/bbdd.php';

    function verificarLogin($usuario,$contrasena)
    {
        $conn = conexionbbdd();
        try
        {
            $stmt = $conn->prepare("SELECT id_usuario,nombre,email,contrasena,administrador from usuarios where email like :usu and contrasena like :contra");
            $stmt->bindParam(':usu', $usuario);
            $stmt->bindParam(':contra', $contrasena);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        return $resultado;
    }
?>