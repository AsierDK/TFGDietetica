<?php
    require_once("controllers/controller_session.php");

    iniciarSession();

    if(verificarSessionExistente())
        header("Location: controller_inicio.php");
    else
        header("Location: views/login.php");
?>