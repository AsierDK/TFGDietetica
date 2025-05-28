<?php

    function iniciarSession()
    {
        session_start();
    }

    function crearSession($id,$admin,$nombre)
    {
        if(!isset($_SESSION["cliente"][$id]))
        {
            $_SESSION["cliente"]["id"] = $id;
            $_SESSION["cliente"]["admin"] = $admin;
            $_SESSION["cliente"]["nombre"] = $nombre;
        }
    }

    function devolverId()
    {
        $id = $_SESSION["cliente"]["id"];
        return $id;
    }

    function devolverAdmin()
    {
        $admin = $_SESSION["cliente"]["admin"];
        return $admin;
    }

    function devolverNombre()
    {
        $nombre = $_SESSION["cliente"]["nombre"];
        return $nombre;
    }

    function verificarSessionExistente()
    {
        $sessionCreada = false;
        if(isset($_SESSION["cliente"]))
            $sessionCreada = true;
        return $sessionCreada;
    }

    function eliminarSessionSinRedireccion()
    {
        session_destroy();
        session_unset();
        setcookie("PHPSESSID", "" , time() - (86400 * 30), "/",$_SERVER['HTTP_HOST']);
    }

    function annadirAlimentoCesta($id_alimento, $nombre, $peso){
        $_SESSION["cliente"]["cesta"][$id_alimento] = [
            'nombre' => $nombre,
            'peso' => $peso
        ];
    }

    function devolverCesta(){
        $cesta = $_SESSION["cliente"]["cesta"];
        return $cesta;
    }

    function eliminarCesta() {
        $_SESSION["cliente"]["cesta"] = [];
    }

    function eliminarAlimentoCesta($id_alimento) {
        unset($_SESSION["cliente"]["cesta"][$id_alimento]);
    }
?>