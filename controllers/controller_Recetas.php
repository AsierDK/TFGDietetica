<?php
require_once "controller_session.php";
require_once "controller_Alergias.php";
    iniciarSession();

    if(!verificarSessionExistente())
    {
        eliminarSessionSinRedireccion();
        header("Location: ../index.php");
    }
    $alergias = getAlergias();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["submit"])){
        $receta=datosReceta();
        annadirReceta();
        annadirAlimento($idUsu,$_POST);
        print "Alimento Añadido";
    }
    print "<script type='text/javascript'>history.replaceState(null,null)</script>";
}
function datosReceta()
{
    $resultados = ['nombreReceta'=>$_POST['nombreReceta'],'desc_receta'=>$_POST['desc']];
    return $resultados;
}
require_once '../models/model_Recetas.php';
require_once '../models/model_Alimentos.php';
require_once '../views/recetas.php';
?>