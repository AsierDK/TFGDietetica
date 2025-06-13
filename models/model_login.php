<?php
require_once '../bbdd/bbdd.php';

    function verificarLogin($usuario,$contrasena)
    {
        $conn = conexionbbdd();
        try
        {
            $stmt = $conn->prepare("SELECT * from Usuarios where email = :usu and contrasena = :contra");
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