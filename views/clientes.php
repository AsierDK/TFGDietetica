<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Page Alumno - webDietetica</title>
    <link rel="stylesheet" href="../assets/css/clientes/clientes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous"/>
    <script src="https://unpkg.com/pdf-lib/dist/pdf-lib.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>
    <script src="../assets/js/calendarCliente.js" type="text/javascript"></script>
    
</head>
<body>
    <header>
        <a href="../controllers/controller_inicio.php"><img class="logo" src="../assets/images/dieta-al-plato-logo.svg" alt="Logo Web Dietética"></a>
        <nav>
            <menu>
                <li><a href="#">Clientes</a></li>
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
            <a href="#"><i class="fa fa-times"></i></a>
            <menu>
                <li><a href="#">Clientes</a></li>
                <li><a href="../controllers/controller_Recetas.php">Recetas</a></li>
                <li><a href="../controllers/controller_Alimentos.php">Alimentos</a></li>
            </menu>
        </div>
    </header>
    <main>
        <section>
            <article class="clientes">
                <?php
                    if (empty($clientes)) {
                        echo 'No hay clientes registrados.';
                    }
                    else {
                        foreach ($clientes as $cliente)
                            echo '<div class="box-cliente" data-id="' . $cliente['dni_cliente'] . '" > '
                                .$cliente['nombre'].' <br> '.$cliente['email']. '<br></div>';
                    }
                ?>
            </article>
            <article id="calendar">
            </article>
            <article id="recetas">
                <div class="box-recetasClientes">
                    <a href="#" onclick="closePopUp(event)"><i class="fa fa-times"></i></a>
                </div>
                <div id="fecha">
                    <form  action="" method="post">
                        <label for="mes">Mes:</label>
                        <select id="mes" name="mes" onchange="actualizarDias()">
                            <option value="">-- Seleccionar mes --</option>
                            <option value="1">Enero</option>
                            <option value="2">Febrero</option>
                            <option value="3">Marzo</option>
                            <option value="4">Abril</option>
                            <option value="5">Mayo</option>
                            <option value="6">Junio</option>
                            <option value="7">Julio</option>
                            <option value="8">Agosto</option>
                            <option value="9">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>

                        <label for="dia">Día:</label>
                        <select id="dia" name="dia">
                            <option value="">-- Seleccionar día --</option>
                        </select>

                        <label for="tipoComida">Tipo de comida:</label>
                        <select id="tipoComida" name="tipoComida">
                            <option value="">-- Seleccionar --</option>
                            <option value="desayuno">Desayuno</option>
                            <option value="almuerzo">Almuerzo</option>
                            <option value="comida">Comida</option>
                            <option value="merienda">Merienda</option>
                            <option value="cena">Cena</option>
                            <option value="suplemento">Suplemento</option>
                        </select>
                        <button type="submit">Guardar</button>
                    </form>
                </div>
            </article>
        </section>
    </main>
    <footer></footer>
    <aside></aside>
</body>
</html>