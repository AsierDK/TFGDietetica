<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recetas - webDietetica</title>
    <link rel="stylesheet" href="../assets/css/recetas/recetas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous"/>
    <script src="../assets/js/toggle.js" type="text/javascript"></script>
    <script src="../assets/js/addAlimento.js" type="text/javascript"></script>
</head>
<body>
    <header>
        <a href="../controllers/controller_inicio.php"><img class="logo" src="../assets/images/dieta-al-plato-logo.svg" alt="Logo Web Dietética"></a>
        <nav>
            <menu>
                <li><a href="../controllers/controller_Clientes.php">Clientes</a></li>
                <li><a href="#">Recetas</a></li>
                <li><a href="../controllers/controller_Alimentos.php">Alimentos</a></li>
            </menu>
        </nav>
        <div class="icons">
            <a class="search" href="#"><i class="fa fa-search icon-search"></i></a>
            <a class="user" href="controller_logout.php"><i class="fa fa-user"></i></a>
            <a class="menu-burger" href="#menu"><i class="fa fa-bars"></i></a>
        </div>
        <div id="menu">
            <a href="#"><i class="fa fa-times"></i></a>
            <menu>
                <li><a href="../controllers/controller_Clientes.php">Clientes</a></li>
                <li><a href="#">Recetas</a></li>
                <li><a href="../controllers/controller_Alimentos.php">Alimentos</a></li>
            </menu>
        </div>
    </header>
    <main>
        <div class="sidebar">
            <button id="btnNew" onclick="toggleSection('new')">Nueva receta</button>
            <button id="btnAll" onclick="toggleSection('all')">Todas las recetas</button>
        </div>
        <span class="mayor"><span class="menor"></span></span>

        <section id="new" class="active">
            <div class="background"></div>
            <article>
                <h1>Nueva receta</h1>
                <form  action="" method="post">
                    <div>
                        <label for="nombreReceta">Nombre receta</label>
                        <input type="text" id="nombreReceta" name="nombreReceta">
                    </div>
                    <div>
                        <label for="desc">Descripción</label>
                        <textarea name="desc" id="desc"></textarea>
                    </div>
                    <input type="button" value="Añadir ingredientes" onclick="addAlimento()" class="btn">
                    <div id="alimento">
                        <a onclick="verCesta()">Ver alimentos añadidos</a>
                        <?php
                            if (empty($alimentos)) {
                                echo 'No hay alimentos registrados.';
                            }
                            else {
                                foreach ($alimentos as $alimento)
                                    echo '<div  class="box-alimento">
                                        <p>'. $alimento['nombreAlimento'].'</p>
                                        <a href="#" data-id="' . $alimento['id_alimentos'] . '" onclick="addPesoBruto(event, \'' . $alimento['id_alimentos'] . '\', \'' . addslashes($alimento['nombreAlimento']) . '\', this)">
                                            <i id="heart-icon" class="far fa-heart"></i>
                                        </a>
                                    </div>';
                            }
                        ?>
                        <input type="submit" name="annadirReceta" value="Crear receta" class="btn annadir">
                        <div id="pop-up-pb">
                            <div>
                                <a href="#" onclick="closePopUp(event)"><i class="fa fa-times"></i></a>
                                <h3>PESO BRUTO</h3>
                                <div class="form">
                                    <label for="name">Peso bruto del alimento</label>
                                    <input type="number" id="peso" name="peso">
                                    <input type="input" value="Añadir" onclick="submitPesoBruto()" class="btn">
                                </div>
                            </div>
                        </div>
                        <div id="cesta">
                            <a onclick="closeCesta()"><i class="fa fa-times"></i></a>
                            <button onclick="eliminarCesta()" class="btn">Eliminar todos los ingredientes</button>
                            <ul class="alimentosRecetas"></ul>
                        </div>
                    </div>
                </form>
            </article>
        </section>
        <section id="all">
            <article class="carrusel">
                <?php
                    echo '<script>';
                    echo 'window.tipo = "recetas";';
                    echo '</script>';
                    if (empty($recetas)) {
                        echo 'No hay recetas registradas.';
                    }
                    else {
                        echo '<h1>Mis recetas</h1>';
                        echo '<div class="carousel-container">';
                        echo '<div class="carousel-track" id="carouselTrack">';
                        foreach ($recetas as $index => $receta) {
                            echo '<div class="slide" onclick="onSlideClick('.$index.')">';
                            echo '<div class="item-carrusel">'.$receta['nombre_receta'].'</div>';
                            echo '</div>';
                        }
                        echo '</div></div>';

                        echo '<button class="edit btn">Editar receta</button>';
                        echo '<div id="receta-info" class="info-box">';
                        echo '<div class="info" id="descipcionReceta"></div>';
                        echo '</div>';
                    }
                ?>
                <script src="../assets/js/carrusel.js" type="text/javascript"></script>
            </article>
        </section>
    </main>
    <footer></footer>
    <aside></aside>
</body>
</html>