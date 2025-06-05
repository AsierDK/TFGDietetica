<?php

    require_once ("../bbdd/bbdd.php");


    function AlimentosUsadosPorUsuario($idUsuario)
    {
        try
        {
            $conn = conexionbbdd();
            $stmt = $conn->prepare("SELECT ar.id_alimentos as id, (SELECT nombreAlimento FROM Alimentos a WHERE a.id_alimentos = ar.id_alimentos) as nombre, COUNT(*) as veces_usado FROM Alimentos_Recetas ar WHERE ar.id_usuario = :idUsu GROUP BY ar.id_alimentos LIMIT 4" );
            $stmt->bindParam(':idUsu', $idUsuario);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado = $stmt->fetchAll();
        }
        catch (PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $resultado;
    }

?>