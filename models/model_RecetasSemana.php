<?php
require_once '../bbdd/bbdd.php';
function RecetasSemanaPorCliente($idUsuario, $idCliente, $start, $end)
{
    try
    {
        $conn=conexionbbdd();
        $stmt = $conn->prepare("SELECT * FROM Recetas_Semana WHERE id_usuario = :id_usuario AND dni_cliente = :id_cliente AND dia >= CONVERT_TZ(:start, '+02:00', '+00:00') AND dia <= CONVERT_TZ(:end, '+02:00', '+00:00')");
        $stmt->bindParam(':id_usuario', $idUsuario);
        $stmt->bindParam(':id_cliente', $idCliente);
        $stmt->bindParam(':start', $start);
        $stmt->bindParam(':end', $end);
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
function annadirRecetaSemana($fecha, $tipoComida, $idReceta, $idCliente, $idUsu){
    $conn=conexionbbdd();
    try
    {
        $diaSemana = obtenerDiaSemana($fecha);
        $id_registro = obtenerUltimoIdRegistro();
        $id_registro = substr($id_registro, 0, 1) . str_pad(intval(substr($id_registro, 1)) + 1, 4, "0", STR_PAD_LEFT);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();
        $stmt = $conn->prepare("INSERT INTO recetas_semana(id_registro, dia, diaSemana, momentoDia, id_receta, dni_cliente, id_usuario) 
            VALUES (:id_registro,:dia,:diaSemana,:momentoDia,:id_receta,:dni_cliente,:id_usuario)");
        $stmt->bindParam(':id_registro', $id_registro);
        $stmt->bindParam(':dia', $fecha);
        $stmt->bindParam(':diaSemana', $diaSemana);
        $stmt->bindParam(':momentoDia', $tipoComida);
        $stmt->bindParam(':id_receta', $idReceta);
        $stmt->bindParam(':dni_cliente', $idCliente);
        $stmt->bindParam(':id_usuario', $idUsu);
        $stmt -> execute();
        $conn -> commit();
    }
    catch(PDOException $e)
    {
        $conn -> rollBack();
        echo "Error: " . $e->getMessage();
        return false;
    } finally {
        $conn=null;
    }
}
function obtenerUltimoIdRegistro(){
        try
        {
            $conn=conexionbbdd();
            $stmt = $conn->prepare("SELECT max(id_registro) as idRegistro FROM Recetas_Semana");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            $ultimoId = $resultado[0]["idRegistro"];
            if($ultimoId === null){
                $ultimoId = 'R0000';
            }
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn=null;
        return $ultimoId;
}

function obtenerDiaSemana($fecha) {
    $timestamp = strtotime($fecha);
    $nombreDiaEn = date('l', $timestamp);
    $dias = [
        'Monday'    => 'LUNES',
        'Tuesday'   => 'MARTES',
        'Wednesday' => 'MIÉRCOLES',
        'Thursday'  => 'JUEVES',
        'Friday'    => 'VIERNES',
        'Saturday'  => 'SÁBADO',
        'Sunday'    => 'DOMINGO',
    ];

    return $dias[$nombreDiaEn];
}

?>