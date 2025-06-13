<?php
    require_once "controller_session.php";
    iniciarSession();
    $idUsu = devolverId();
    header("Content-Type: application/json");

    $tipo = $_GET['tipo'] ?? '';

    if ($tipo === 'alimentos') {
        require_once "../models/model_Alimentos.php";
        $items = AlimentosPorUsuario($idUsu);
        foreach ($items as &$alimento) {
            $id_alimento = $alimento['id_alimentos'];
            $alimento['alergia'] = AlergiaDeAlimento($id_alimento, $idUsu);
        }
    } else if ($tipo === 'recetas') {
        require_once "../models/model_Recetas.php";
        $items = RecetasPorUsuario($idUsu);
        foreach ($items as &$receta) {
            $idReceta = $receta['id_receta'];
            $receta['alimentos'] = alimentosporReceta($idUsu, $idReceta);
            $receta['alergia'] = AlergiaDeReceta($idReceta, $idUsu);
        }
    }
    $envio=json_encode($items);
	echo $envio;
?>