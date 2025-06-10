<?php
    require_once "controller_session.php";
    iniciarSession();
    $idUsu = devolverId();
    header("Content-Type: application/json");

    if ($_SERVER['REQUEST_METHOD'] === 'GET'){
        $tipo = $_GET['tipo'] ?? '';
        $id = $_GET['id'];

        if ($tipo === 'alimentos') {
            require_once "../models/model_Alimentos.php";
            $items = obtenerAlimento($id);
        } else if ($tipo === 'recetas') {
            require_once "../models/model_Recetas.php";
            $items = obtenerReceta($id);
        } else {
            echo json_encode([]);
        }
        $envio=json_encode($items);
        echo $envio;
    }
    else if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    }
?>