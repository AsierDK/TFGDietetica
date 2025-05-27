<?php
require_once '../bbdd/bbdd.php';
function RecetasPorUsuario($idUsuario)
{
    try
    {
        $conn=conexionbbdd();
        $stmt = $conn->prepare("SELECT * FROM Recetas WHERE id_usuario = :id_usuario");
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
function alimentosporReceta($idUsuario,$id_receta){
    try
    {
        $conn=conexionbbdd();
        $stmt = $conn->prepare("SELECT A.id_alimentos,A.nombreAlimento FROM Alimentos_Recetas AR LEFT JOIN Alimentos A ON AR.id_alimentos = A.id_alimentos WHERE AR.id_usuario = :id_usuario AND AR.id_alimento = :id_alimento");
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
function annadirReceta($idUsuario,$params){
    $conn=conexionbbdd();
    try
    {
        $id_recetas = obtenerUltimoIdReceta();
        $id_receta = substr($id_recetas, 0, 1) . str_pad(intval(substr($id_recetas, 1)) + 1, 4, "0", STR_PAD_LEFT);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();
        $stmt = $conn->prepare("INSERT INTO Recetas(id_receta, nombre_receta, desc_receta, id_usuario, fechaCreacion, fechaModificacion) 
            VALUES (:id_receta,:nombre_receta,:desc_receta,:id_usuario,now(),now())");
        $stmt->bindParam(':id_receta', $id_receta);
        $stmt->bindParam(':nombre_receta', $params['nombre_receta']);
        $stmt->bindParam(':desc_receta', $params['desc_receta']);
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
function obtenerUltimoIdReceta()
{
    try
    {
        $conn=conexionbbdd();
        $stmt = $conn->prepare("SELECT max(id_receta) as idReceta FROM Recetas");
        $stmt -> execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado=$stmt->fetchAll();
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
    $conn=null;
    return $resultado[0]["idReceta"];
}
?>