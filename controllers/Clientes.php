<?php
    require_once "controller_session.php";
    iniciarSession();
    header("Content-Type: application/json");

    $idAlumno = $_GET['alumno'];

    require_once ("../models/model_Clientes.php");
    require_once ("../models/model_RecetasSemana.php");
    $clientes = Clientes();
    $numRecetas = [];
    foreach ($clientes as &$cliente){
        $cliente['num'] = obtenerRecetasPorCliente($idAlumno, $cliente['dni_cliente']);
    }

    $envio=json_encode($clientes);
	echo $envio;
?>