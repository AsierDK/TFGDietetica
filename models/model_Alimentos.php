<?php
require_once '../bbdd/bbdd.php';
function AlimentosPorUsuario($idUsuario)
{
    try
    {
        $conn=conexionbbdd();
        $stmt = $conn->prepare("SELECT * FROM Alimentos WHERE id_usuario = :id_usuario");
        $stmt->bindParam(':id_usuario', $idUsuario);
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
?>