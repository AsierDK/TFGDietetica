<?php
    require_once "controller_session.php";
    iniciarSession();
    header("Content-Type: application/json");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $accion = $_POST['accion'];

        switch ($accion) {
            case 'annadir':
                $id = $_POST['id'];
                $nombre = $_POST['nombre'];
                $peso = $_POST['peso'];
                $unidad = $_POST['unidad'];
                if ($id && $nombre && $peso && $unidad) {
                    annadirAlimentoCesta($id, $nombre, $peso, $unidad);
                }
                break;

            case 'eliminarAlimento':
                $id = $_POST['id'];
                if ($id) {
                    eliminarAlimentoCesta($id);
                }
                break;

            case 'vaciar':
                eliminarCesta();
                break;
            case 'obtener':
                break;
        }
    }
    $envio=json_encode(devolverCesta());
	echo $envio;
?>