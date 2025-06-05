<?php

    require_once("../models/model_Alimento_Receta.php");
    require_once("../models/model_Recetas.php");

    $alimentosUsuario = AlimentosUsadosPorUsuario($idUsuario);
    $recetasUsuario =  mostrarRecetasPorUsuario($idUsuario);

?>