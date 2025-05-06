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
function AlergiaDeAlimento($id_alimentos,$idUsuario){
    try
    {
        $conn=conexionbbdd();
        $stmt = $conn->prepare("SELECT A.id_alergia,A.nombre_alergia FROM Alergias_Alimentos AL LEFT JOIN Alergias A ON AL.id_alergia = A.id_alergia WHERE AL.id_usuario = :id_usuario AND AL.id_alimento = :id_alimento");
        $stmt->bindParam(':id_usuario', $idUsuario);
        $stmt->bindParam(':id_alimentos', $id_alimentos);
        $stmt -> execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado=$stmt->fetchAll();
    }
    catch (PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
    $conn=null;
    return $resultado;
}
?>