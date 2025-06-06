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
function RecetaPorCliente($idReceta)
{
    try
    {
        $conn=conexionbbdd();
        $stmt = $conn->prepare("SELECT * FROM Recetas WHERE id_receta = :id_receta");
        $stmt->bindParam(':id_receta', $idReceta);
        $stmt -> execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado=$stmt->fetchAll();
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
    $conn=null;
    return $resultado[0];
}
function mostrarRecetasPorUsuario($idUsuario)
{
    try
    {
        $conn=conexionbbdd();
        $stmt = $conn->prepare("SELECT * FROM Recetas WHERE id_usuario = :id_usuario order by fechaModificacion LIMIT 4");
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
        $stmt = $conn->prepare("SELECT A.*,AR.pesoBruto FROM Alimentos_Recetas AR LEFT JOIN Alimentos A ON AR.id_alimentos = A.id_alimentos WHERE AR.id_usuario = :id_usuario AND AR.id_receta = :id_receta");
        $stmt->bindParam(':id_usuario', $idUsuario);
        $stmt->bindParam(':id_receta', $id_receta);
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
function obtenerReceta($id_receta)
{
    try
    {
        $conn=conexionbbdd();
        $stmt = $conn->prepare("SELECT * FROM Recetas WHERE id_receta = :id_receta");
        $stmt->bindParam(':id_receta', $id_receta);
        $stmt -> execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultado=$stmt->fetchAll();
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
    $conn=null;
    return $resultado[0];
}
function annadirReceta($idUsuario,$params,$cesta){
    $conn=conexionbbdd();
    try
    {
        $id_recetas = obtenerUltimoIdReceta();
        var_dump($id_recetas);
        $id_receta = $id_recetas == null ? "A0001" : substr($id_recetas, 0, 1) . str_pad(intval(substr($id_recetas, 1)) + 1, 4, "0", STR_PAD_LEFT);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();
        $stmt = $conn->prepare("INSERT INTO Recetas(id_receta, nombre_receta, desc_receta, id_usuario, fechaCreacion, fechaModificacion) 
            VALUES (:id_receta,:nombre_receta,:desc_receta,:id_usuario,now(),now())");
        $stmt->bindParam(':id_receta', $id_receta);
        $stmt->bindParam(':nombre_receta', $params['nombre_receta']);
        $stmt->bindParam(':desc_receta', $params['desc_receta']);
        $stmt->bindParam(':id_usuario', $idUsuario);
        $stmt -> execute();
        var_dump($cesta);
        foreach ($cesta as $key => $value){
            $stmt = $conn-> prepare('INSERT INTO Alimentos_Recetas(id_alimentos, id_usuario, id_receta, fechaCreacion, fechaModificacion,pesoBruto)
            VALUES (:id_alimento,:id_usuario,:id_receta,now(),now(),:pesoBruto)');
            $stmt->bindParam(':id_receta', $id_receta);
            $stmt->bindParam(':id_alimento', $key);
            $stmt->bindParam(':id_usuario', $idUsuario);
            $stmt->bindParam(':pesoBruto', $value['peso']);
            $stmt -> execute();
        }
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

    function editarReceta($idUsu,$params)
    {
        try
        {
            $conn=conexionbbdd();
            $stmt = $conn->prepare("UPDATE Recetas SET nombre_receta = :nombre_receta, desc_receta = :desc_receta, fechaModificacion = now() WHERE id_receta = :id_receta and id_usuario = :id_usuario");
            $stmt->bindParam(':id_receta', $params['id_receta']);
            $stmt->bindParam(':nombre_receta', $params['nombre_receta']);
            $stmt->bindParam(':desc_receta', $params['desc_receta']);
            $stmt->bindParam(':id_usuario', $idUsu);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn=null;
    }

    function borrarReceta($idReceta)
    {   
        try
        {
            $conn=conexionbbdd();
            $stmt = $conn->prepare("DELETE FROM Recetas_Semana WHERE id_receta = :id_receta");
            $stmt->bindParam(':id_receta', $idReceta);
            $stmt -> execute();
            $stmt = $conn->prepare("DELETE FROM Recetas WHERE id_receta = :id_receta");
            $stmt->bindParam(':id_receta', $idReceta);
            $stmt -> execute();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn=null;
    }
?>