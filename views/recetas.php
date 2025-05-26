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
                <li><a href="../controllers/controller_Recetas.php">Recetas</a></li>
                <li><a href="../controllers/controller_Alimentos.php">Alimentos</a></li>
            </menu>
        </nav>
        <div>
            <a class="search" href="#"><i class="fa fa-search icon-search"></i></a>
            <a class="search" href="controller_logout.php"><i class="fa fa-user"></i></a>
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
                        <label for="nombreCliente">Nombre cliente</label>
                        <input type="text" id="nombreCliente" name="nombreCliente">
                    </div>
                    <div>
                        <label for="alergias">Alergias cliente</label>
                        <select name="alergias[]" multiple>
                            <?php
                                $resultado = AlergiasPorUsuario(0);
                                var_dump($resultado);
                                foreach ($resultado as $alergia)
                                    echo '<option value="'.$alergia["id_alergia"].'">'. $alergia["nombre_alergia"]. '</option>';
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="nombreReceta">Nombre receta</label>
                        <input type="text" id="nombreReceta" name="nombreReceta">
                    </div>
                    <div>
                        <label for="desc">Descripción</label>
                        <input type="text" id="desc" name="desc">
                    </div>
                    <input type="button" value="Añadir ingredientes" onclick="addAlimento()" class="btn">
                </form>
            </article>
            <article id="alimento">
                <?php
                    $resultado = AlimentosPorUsuario(0);
                    if (empty($resultado)) {
                        echo 'No hay alimentos registrados.';
                    }
                    else {
                        foreach ($resultado as $alimento)
                            echo '<div  class="box-alimento">
                                <a href="#" onclick="addPesoBruto(event)"><i id="heart-icon" class="far fa-heart"></i></a>'
                                . $alimento['nombreAlimento'].
                            '</div>';
                    }
                ?>
                <div id="pop-up-pb">
                    <div>
                        <a href="#" onclick="closePopUp(event)"><i class="fa fa-times"></i></a>
                        <h3>PESO BRUTO</h3>
                        <form  action="" method="post">
                            <label for="name">Peso bruto del alimento</label>
                            <input type="text" id="peso" name="peso">
                            <input type="input" value="Añadir" onclick="submitPesoBruto()" class="btn">
                        </form>
                    </div>
                </div>
                <div class="cesta">

                </div>
            </article>
        </section>
        <section id="all">
            <article class="carrusel">
                <?php
                    $resultado = RecetasPorUsuario(0);
                    echo '<script>';
                    echo 'window.alimentos = ' . json_encode($resultado, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) . ';';
                    echo '</script>';
                    if (empty($resultado)) {
                        echo 'No hay recetas registradas.';
                    }
                    else {
                        echo '<h1>Mis alimentos</h1>';
                        echo '<div class="carousel-container">';
                        echo '<div class="carousel-track" id="carouselTrack">';
                        foreach ($resultado as $index => $alimento) {
                            echo '<div class="slide" onclick="onSlideClick('.$index.')">';
                            echo '<img src="../assets/images/clasificacion-alimentos.jpg.webp">';
                            echo '</div>';
                        }
                        echo '</div></div>';

                        echo '<div id="alimento-info" class="info-box">';
                        echo '<h3 id="nombreAlimento"></h3>';
                        echo '<p id="descripcionAlimento"></p>';
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