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
    {
        require_once ("../models/model_admin.php");
        if(isset($_POST["submit"]))
        {
            crearAlumno($_POST);
            print "Alumno creado correctamente";
            print "<script type='text/javascript'>history.replaceState(null,null)</script>";
        }
        
        $alumnos = recuperarUsuarios();

        require_once ("../views/alumnos-admin.php");
    }

?>