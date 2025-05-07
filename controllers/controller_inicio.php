<?php

    require_once ("controller_session.php");
    iniciarSession();
    
    if(!verificarSessionExistente())
    {
        eliminarSessionSinRedireccion();
        header("Location: ../index.php");
    }

    $admin = devolverAdmin();

    if($admin == 0)
        require_once ("../views/index-alumno.php");
    else
        require_once ("../views/index-admin.php");

?>