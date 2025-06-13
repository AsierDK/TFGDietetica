<?php

    require_once ("controller_session.php");

    iniciarSession();

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //Comprobar que el login es correcto con la informacion introducida
        $usuario = limpiar($_POST["usr"]);
        $contrasena = limpiar($_POST["psw"]);
        require_once "../models/model_login.php";
        $datosCli = verificarLogin($usuario,$contrasena);
        if($datosCli == null)
            echo "<h1><strong>Login Incorrecto</strong></h1>";
        else
        {
            //Crar Sesion con los Datos Personales del Cliente
            $id = $datosCli[0]["id_usuario"];
            $nombre =  $datosCli[0]["nombre"]. ' ' .$datosCli[0]["apellidos"];
            $admin =  $datosCli[0]["administrador"];
            crearSession($id,$admin,$nombre);
            header("Location: controller_inicio.php");
        }
    }

    function limpiar($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>