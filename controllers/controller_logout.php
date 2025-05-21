<?php
    require_once ("controller_session.php");
    iniciarSession();
    eliminarSessionSinRedireccion();
    header("Location: controller_inicio.php");
?>