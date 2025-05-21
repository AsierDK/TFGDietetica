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
        <a href="#"><img class="logo" src="../assets/images/dieta-al-plato-logo.svg" alt="Logo Web Dietética"></a>
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
        <div class="sidebar">
            <button id="btnNew" onclick="toggleSection('new')">Nueva receta</button>
            <button id="btnAll" onclick="toggleSection('all')">Todas las recetas</button>
        </div>
        <span class="mayor"><span class="menor"></span></span>

        <section id="new" class="active">
            <div class="background"></div>
            <article>
                <h1>Nueva receta</h1>
                <form>
                    <div>
                        <label for="name">Nombre receta</label>
                        <input type="text" id="nombreReceta">
                    </div>
                    <div>
                        <label for="alergia">Alergias cliente</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="desc">Descripción</label>
                        <input type="text">
                    </div>
                    <input type="button" value="Añadir ingredientes" onclick="addAlimento()" class="btn">
                    <input type="submit" value="Finalizar Receta" class="btn">
                </form>
            </article>
            <article id="alimento">
                <?php
                    /*if (empty($resultado)) {
                        echo 'No hay alimentos registrados.';
                    }
                    else {*/
                        for ($i =0; $i<10; $i++)
                            echo '<div  class="box-alimento">
                                <a href="#" onclick="addPesoBruto(event)"><i id="heart-icon" class="far fa-heart"></i></a>
                                Nombre Alimento
                            </div>';
                    //}
                ?>
                <div id="pop-up-pb">
                    <a href="#" onclick="closePopUp(event)"><i class="fa fa-times"></i></a>
                    <h3>PESO BRUTO</h3>
                    <form>
                        <label for="name">Peso bruto del alimento</label>
                        <input type="text" id="peso" name="peso">
                        <input type="input" value="Añadir" onclick="submitPesoBruto()" class="btn">
                    </form>
                </div>
                 <input type="button" value="Cerrar seleccion alimentos" onclick="closeAlimento()" class="btn">
            </article>
        </section>
        <section id="all">
            <article>
                <?php
                    if (empty($resultado)) {
                        echo 'No hay recetas registradas.';
                    }
                    else {
                        echo '<h1>Mis recetas</h1>';
                        foreach ($resultado as $alumno)
                            echo '<div  class="box-alumno">
                                Nombre Alumno <br>
                                Nº Clientes <br>
                                Nº Recetas <br>
                                <a>Más información </a>
                            </div>';
                    }
                ?>
            </article>
        </section>
    </main>
    <footer></footer>
    <aside></aside>
</body>
</html>