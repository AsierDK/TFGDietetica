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
        $idCliente = $_POST['idCliente'];
        require_once "../models/model_Recetas.php";
        require_once "../models/model_RecetasSemana.php";
        switch ($accion) {
            case 'annadir': 
                $fecha = $_POST['fecha'];
                $tipoComida = $_POST['tipoComida'];
                $idReceta = $_POST['idReceta'];
                if ($fecha && $tipoComida && $idReceta && $idCliente) {
                    annadirRecetaSemana($fecha, $tipoComida, $idReceta, $idCliente, $idUsu);
                }
                break;
            case 'visualizar':
                $start = $_POST['start'];
                $end = $_POST['end'];
                $items = RecetasSemanaPorCliente($idUsu, $idCliente, $start, $end);
                $eventos = [];
                foreach ($items as $recetaSenama) {
                    $idReceta = $recetaSenama['id_receta'];
                    $fechaCompleta = $recetaSenama['dia'];
                    $fecha = (new DateTime($fechaCompleta))->format('Y-m-d');
                    $momento = $recetaSenama['momentoDia'];
                    $horasPorMomento = [
                        'DESAYUNO'   => '08:00:00',
                        'ALMUERZO'   => '11:00:00',
                        'COMIDA'     => '14:00:00',
                        'MERIENDA'   => '17:00:00',
                        'CENA'       => '21:00:00',
                        'SUPLEMENTO' => '22:00:00'
                    ];
                    $hora = $horasPorMomento[$momento];
                    $start = "{$fecha}T{$hora}";
                    $startDateTime = new DateTime($start);
                    $endDateTime = clone $startDateTime;
                    $endDateTime->modify('+1 hour');
                    $end = $endDateTime->format('Y-m-d\TH:i:s');
                    $receta = RecetaPorCliente($idReceta);
                    $nombre = $receta['nombre_receta'];
                    $receta['extendedProps']['alimentos'] = alimentosporReceta($idUsu, $idReceta);
                    $evento = [
                        'id' => $idReceta,
                        'title' => $nombre,
                        'start' => $start,
                        'end' => $end,
                        "allDay" => false,
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