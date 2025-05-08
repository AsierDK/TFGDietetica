<?php
    require_once "controller_session.php";

    iniciarSession();
    
    if(!verificarSessionExistente())
    {
        eliminarSessionSinRedireccion();
        header("Location: ../index.php");
    }

   
   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["submit"])){
            require_once '../models/model_Alimentos.php';
            $idUsu = devolverId();
            annadirAlimento($idUsu,$_POST);
            print "Alimento Añadido";
        }
        print "<script type='text/javascript'>history.replaceState(null,null)</script>";
    }


    require_once '../views/alimentos.php';
?>