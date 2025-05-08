<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Page Alumno - webDietetica</title>
    <link rel="stylesheet" href="../assets/css/index-alumno/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous"/>
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
        <a class="search" href="#"><i class="fa fa-search icon-search"></i></a>
    </header>
    <main>
        <h1>Bienvenido, </h1>

        <section>
            <article>
            <div class="article-header">
                    <h2>Todas las recetas</h2>
                    <a href="../controllers/controller_Recetas.php">Ver todas</a>
                </div>
                <div class="article-main">
                    <?php
                        for($i= 0; $i< 4; $i++)
                            echo '<div  class="recipe">
                                Nombre Alumno <br>
                                Nº Clientes <br>
                                Nº Recetas <br>
                                <a>Más información </a>
                            </div>';
                    ?>
                </div>
            </article>
        </section>
        <section>
            <article>
            <div class="article-header">
                    <h2>Ingredientes populares</h2>
                    <a href="../controllers/controller_Alimentos.php">Ver todos</a>
                </div>
                <div class="article-main">
                    <table>
                        <?php
                            for($i= 0; $i< 4; $i++)
                                echo '<tr>
                                    <td>Ingrediente</td>
                                    <td class="cantidad">Cantidad <a>></a></td>
                                </tr>';
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