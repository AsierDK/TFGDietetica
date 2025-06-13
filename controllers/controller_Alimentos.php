<?php
    require_once "controller_session.php";
    require_once "controller_Alergias.php";

    iniciarSession();

    if(!verificarSessionExistente())
    {
        eliminarSessionSinRedireccion();
        header("Location: ../index.php");
    }

    require_once '../models/model_Alimentos.php';
    $alergias = getAlergias();
    $idUsu = devolverId();
    $alimentos = AlimentosPorUsuario($idUsu);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["annadiralimento"])) {
            annadirAlimento($idUsu,$_POST);
            print "Alimento Añadido";
        }
        else if (isset($_POST["editaralimento"])) {
            editarAlimento($idUsu,$_POST);
            print "Alimento modificado";
        }
        else {
            print "Error";
        }
        header("Location: " . $_SERVER['REQUEST_URI']);
        print "<script type='text/javascript'>history.replaceState(null,null)</script>";
    }

    require_once '../views/alimentos.php';
?>