<?php
require_once '../bbdd/bbdd.php';
function Clientes()
{
    try
    {
        $conn=conexionbbdd();
        $stmt = $conn->prepare("SELECT * FROM Clientes");
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
function AlergiaDeCliente($dni_cliente,$idUsuario){
    try
    {
        $conn=conexionbbdd();
        $stmt = $conn->prepare("SELECT A.id_alergia,A.nombre_alergia FROM Clientes_Alergias CA, Alergias A WHERE CA.id_usuario = :id_usuario and CA.dni_cliente = :dni_cliente AND CA.id_alergia = A.id_alergia");
        $stmt->bindParam(':id_usuario', $idUsuario);
        $stmt->bindParam(':dni_cliente', $dni_cliente);
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

function crearCliente($params)
{
    try
    {
        $conn=conexionbbdd();
        $stmt = $conn->prepare("INSERT INTO Clientes (dni_cliente, nombre, apellido, edad, descripcionCaso, caracteristicasMenu) VALUES (:dni_cliente, :nombre, :apellidos,:edad, :desc,:carac)");
        $stmt->bindParam(':dni_cliente', $params['dni']);
        $stmt->bindParam(':nombre', $params['name']);
        $stmt->bindParam(':apellidos', $params['ape']);
        $stmt->bindParam(':edad', $params['edad']);
        $stmt->bindParam(':desc', $params['desc']);
        $stmt->bindParam(':carac', $params['carac']);
        $stmt -> execute();
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
    $conn=null;
}
?>