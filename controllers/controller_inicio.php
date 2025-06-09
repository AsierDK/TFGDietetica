<?php
    require_once ("controller_session.php");
    iniciarSession();

    if(!verificarSessionExistente())
    {
        eliminarSessionSinRedireccion();
        header("Location: ../index.php");
    }

    $admin = devolverAdmin();
    $nombre = devolverNombre();
    $idUsuario = devolverId();

    if($admin == 0){
        require_once ("controller_inicio_datos.php");
        require_once ("../views/index-alumno.php");
    } else {
        require_once ("../models/model_Clientes.php");
        require_once ("../models/model_RecetasSemana.php");
        $clientes = Clientes();
        foreach ($id as $clientes){
            $numRecetas[$id] = obtenerRecetasPorCliente($idUsuario, $id);
        }
        require_once ("../models/model_admin.php"); 
        if(isset($_POST["submit"]))
        {
            if(isset($_POST["nueva_pass"]))
            {
                cambiarContrasenaAlumno($_POST["id_alumno"],$_POST["nueva_pass"]);
                print "Contraseña cambiada correctamente";
                print "<script type='text/javascript'>history.replaceState(null,null)</script>";
            }
            else
            {
                crearAlumno($_POST);
                print "Alumno creado correctamente";
                print "<script type='text/javascript'>history.replaceState(null,null)</script>";
            }
        }
        
        $alumnos = recuperarUsuarios();

        require_once ("../views/alumnos-admin.php");
    }

?>