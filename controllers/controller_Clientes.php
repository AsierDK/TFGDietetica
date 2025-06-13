<?php
    require_once "controller_session.php";
    iniciarSession();

    if(!verificarSessionExistente())
    {
        eliminarSessionSinRedireccion();
        header("Location: ../index.php");
    }

    $admin = devolverAdmin();
    require_once '../models/model_Clientes.php';
    $clientes = Clientes();

    if($admin == 0){
        require_once '../views/clientes.php';
    }
    else
    {
        if(isset($_POST["submit"]))
        {
            crearCliente($_POST);
            print "Cliente creado correctamente";
            header("Location: " . $_SERVER['REQUEST_URI']);
            print "<script type='text/javascript'>history.replaceState(null,null)</script>";
        }

        require_once '../views/clientes-admin.php';
    }
?>