
<?php
require_once '../bbdd/bbdd.php';
function RecetasSemanaPorCliente($idUsuario, $idCliente)
{
    try
    {
        $conn=conexionbbdd();
        $stmt = $conn->prepare("SELECT * FROM Recetas_Semana WHERE id_usuario = :id_usuario AND dni_cliente = :id_cliente");
        $stmt->bindParam(':id_usuario', $idUsuario);
        $stmt->bindParam(':id_cliente', $idCliente);
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
//He añadido recetasSemana($idUsuario, $idCliente, $idReceta)
function recetasSemana($idUsuario, $idCliente, $idReceta)
{
    try
    {
        $conn=conexionbbdd();
        $stmt = $conn->prepare("SELECT * FROM Recetas_Semana WHERE id_usuario = :id_usuario AND dni_cliente = :id_cliente AND id_receta = :id_receta");
        $stmt->bindParam(':id_usuario', $idUsuario);
        $stmt->bindParam(':id_cliente', $idCliente);
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
    return $resultado;
}
