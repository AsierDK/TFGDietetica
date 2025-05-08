<?php
    require_once "controller_session.php";

    iniciarSession();

    if(!verificarSessionExistente())
    {
        eliminarSessionSinRedireccion();
        header("Location: ../index.php");
    }

    require_once '../models/model_Alimentos.php';
    $idUsu = devolverId();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["submit"])){
            
            
            annadirAlimento($idUsu,$_POST);
            print "Alimento Añadido";
        }
        print "<script type='text/javascript'>history.replaceState(null,null)</script>";
    }

    $alimentos = AlimentosPorUsuario($idUsu);

    require_once '../views/alimentos.php';
?>