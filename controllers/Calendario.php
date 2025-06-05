<?php
    require_once "controller_session.php";
    iniciarSession();
    $idUsu = devolverId();
    header("Content-Type: application/json");

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        require_once "../models/model_Recetas.php";
        $envio=json_encode(RecetasPorUsuario($idUsu));
        echo $envio;
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $accion = $_POST['accion'];
        require_once "../models/model_Recetas.php";
        switch ($accion) {
            case 'annadir': 
                require_once "../models/model_RecetasSemanas.php";
                $fecha = $_POST['fecha'];
                $tipoComida = $_POST['tipoComida'];
                $idReceta = $_POST['idReceta'];
                $idCliente = $_POST['idCliente'];
                if ($fecha && $tipoComida && $idReceta && $idCliente) {
                    annadirRecetaSemana($fecha, $tipoComida, $idReceta, $idCliente, $idUsu);
                }
                break;
            case 'visualizar':
                $items = RecetasPorUsuario($idCliente, $idUsu);
                $eventos = [];
                foreach ($items as &$receta) {
                    $idReceta = $receta['id_receta'];
                    $nombre = $receta['nombre_receta'];
                    $receta['extendedProps']['alimentos'] = alimentosporReceta($idUsu, $idReceta);
                    $datos = RecetasSemana($idUsu, $idCliente, $idReceta);
                    $momento = $datos['momentoDia'];
                    $horasPorMomento = [
                        'DESAYUNO'   => '08:00:00',
                        'ALMUERZO'   => '11:00:00',
                        'COMIDA'     => '14:00:00',
                        'MERIENDA'   => '17:00:00',
                        'CENA'       => '21:00:00',
                        'SUPLEMENTO' => '22:00:00'
                    ];
                    $fecha = $datos['dia'];
                    $hora = $horasPorMomento[$momento];
                    $start = "{$fecha}T{$hora}";
                    $startDateTime = new DateTime($start);
                    $endDateTime = clone $startDateTime;
                    $endDateTime->modify('+1 hour');
                    $end = $endDateTime->format('Y-m-d\TH:i:s');
                    $evento = [
                        'id' => $idReceta,
                        'title' => $nombre,
                        'start' => $start,
                        'end' => $end,
                        'extendedProps' => [
                            'desc' => $receta['desc_receta'],
                            'alimentos' => $receta['extendedProps']['alimentos'],
                            'tipoComida' => $momento
                        ]
                    ];

                    $eventos[] = $evento;
                }
                echo json_encode($eventos);
                break;
        }
    }
?>