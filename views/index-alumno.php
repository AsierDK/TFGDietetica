<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Page Alumno - webDietetica</title>
    <link rel="stylesheet" href="../assets/css/index-alumno/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous"/>
    <script src="../assets/js/toggle.js" type="text/javascript"></script>
</head>
<body>
    <header>
        <a href="../controllers/controller_inicio.php"><img class="logo" src="../assets/images/dieta-al-plato-logo.svg" alt="Logo Web Dietética"></a>
        <nav>
            <menu>
                <li><a href="../controllers/controller_Clientes.php">Clientes</a></li>
                <li><a href="../controllers/controller_Recetas.php">Recetas</a></li>
                <li><a href="../controllers/controller_Alimentos.php">Alimentos</a></li>
            </menu>
        </nav>
        <div class="icons">
            <a class="search" href="#"><i class="fa fa-search icon-search"></i></a>
            <a class="user" href="controller_logout.php"><i class="fa fa-user"></i></a>
            <a class="menu-burger" href="#menu"><i class="fa fa-bars"></i></a>
        </div>
        <div id="menu">
            <<a href="#"><i class="fa fa-times"></i></a>
            <menu>
                <li><a href="../controllers/controller_Clientes.php">Clientes</a></li>
                <li><a href="../controllers/controller_Recetas.php">Recetas</a></li>
                <li><a href="../controllers/controller_Alimentos.php">Alimentos</a></li>
            </menu>
        </div>
    </header>
    <main>
        <h1>Bienvenido <?php echo $nombre;?></h1>
        <section>
            <article>
            <div class="article-header">
                    <h2>Todas las recetas</h2>
                    <a href="../controllers/controller_Recetas.php#all">Ver todas</a>
                </div>
                <div class="article-main">
                    <?php
                        foreach($recetasUsuario as $receta) {
                            echo '<div  class="recipe">
                                '.$receta['nombre_receta'].'<br>
                                '.$receta['desc_receta'].'
                            </div>';
                        }
                    ?>
                </div>
            </article>
        </section>
        <section>
            <article>
            <div class="article-header">
                    <h2>Ingredientes populares</h2>
                    <a href="../controllers/controller_Alimentos.php#all">Ver todos</a>
                </div>
                <div class="article-main">
                    <table>
                        <?php
                            foreach ($alimentosUsuario as $alimento) {
                                echo '<tr>
                                    <td>'.$alimento["nombre"].'</td>
                                    <td class="cantidad">'.$alimento['veces_usado'].' </td>
                                </tr>';
                            }
                        ?>
                    </table>
                </div>
            </article>
        </section>
    </main>
    <footer></footer>
    <aside></aside>
</body>
</html>