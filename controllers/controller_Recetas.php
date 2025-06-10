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
    $recetas = RecetasPorUsuario($idUsu);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["annadirReceta"])){

            $receta = datosReceta();
            $cesta = devolverCesta();
            annadirReceta($idUsu,$receta,$cesta);
            eliminarCesta();
            print "Receta Añadida";
        }  else if (isset($_POST["accion"]) && $_POST["accion"] === "Editar")  {
            editarReceta($idUsu,$_POST);
            print "Receta modificada";
        } else if (isset($_POST["accion"]) && $_POST["accion"] === "Eliminar") {
            borrarReceta($_POST['id_receta']);
            print "Receta eliminada";
        }
        else {
            print "Error";
        }
        print "<script type='text/javascript'>history.replaceState(null,null)</script>";
    }
    function datosReceta(){
        $resultados = ['nombre_receta'=>$_POST['nombreReceta'],'desc_receta'=>$_POST['desc']];
        return $resultados;
    }
    require_once '../views/recetas.php';
?>