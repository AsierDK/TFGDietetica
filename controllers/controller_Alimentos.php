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
        if(isset($_POST["submit"])){
            
            
            annadirAlimento($idUsu,$_POST);
            print "Alimento Añadido";
        }
        print "<script type='text/javascript'>history.replaceState(null,null)</script>";
    }

    require_once '../views/alimentos.php';
?>