<?php
require_once '../bbdd/bbdd.php';
function allAlergias()
{
    try
    {
        $conn=conexionbbdd();
        $stmt = $conn->prepare("SELECT * FROM Alergias");
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
function annadirAlergias($id_alergia,$idUsuario,$params){
    $conn=conexionbbdd();
    try
    {
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();
        $stmt = $conn->prepare("INSERT INTO `Alergias`(id_alergia, nombre_alergia, id_usuario, fechaCreacion, fechaModificacion) VALUES (:id_alergia,:nombre_alergia,:id_usuario,now(),now())");
        $stmt->bindParam(':id_alergia', $id_alergia);
        $stmt->bindParam(':nombre_alergia', $params["nombre_alergia"]);
        $stmt->bindParam(':id_usuario', $idUsuario);
        $stmt -> execute();
        $conn -> commit();
    }
    catch(PDOException $e)
    {
        $conn -> rollBack();
        echo "Error: " . $e->getMessage();
    } finally {
        $conn=null;
    }
}
?>