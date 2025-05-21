<?php
//require_once "funciones_session.php";

require_once "controller_session.php";

    iniciarSession();
    
    if(!verificarSessionExistente())
    {
        eliminarSessionSinRedireccion();
        header("Location: ../index.php");
    }

require_once '../models/model_Recetas.php';
require_once '../models/model_Alimentos.php';
require_once '../views/recetas.php';

?>