<?php
    require_once "controller_session.php";
    require_once "controller_Alergias.php";
     iniciarSession();

    if(!verificarSessionExistente())
    {
        eliminarSessionSinRedireccion();
        header("Location: ../index.php");
    }

    require_once '../models/model_Recetas.php';
    require_once '../models/model_Alimentos.php';
    $alergias = getAlergias();
    $idUsu = devolverId();
    $alimentos = AlimentosPorUsuario($idUsu);
    $cesta = json_decode($_COOKIE['cesta']);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["submit"])){

            $receta = datosReceta();
            $cesta = devolverCesta();
            annadirReceta($idUsu,$receta,$cesta);

            print "Alimento Añadido";
        }
        if ($_POST['accion'==='actualizarCesta']){
            echo pintar_tabla();
        }
        print "<script type='text/javascript'>history.replaceState(null,null)</script>";
    }
    function pintar_tabla(){
        $cesta = json_decode($_COOKIE['cesta']);
        $resultado = '';
        foreach ($cesta as $value){
            $resultado .='<span>Nombre: <b>'.$value->nombre.'</b> </span>'
            .'<span>Peso: <b>'.$value->peso.'</b></span><br>';
        }
        return $resultado;
    }
    require_once '../views/recetas.php';

?>