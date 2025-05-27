<?php
    require_once "controller_session.php";
    require_once '../models/model_Alergias.php';
    function getAlergias()
    {
        return allAlergias();
    }
?>