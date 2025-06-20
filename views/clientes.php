<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Page Alumno - webDietetica</title>
    <link rel="stylesheet" href="../assets/css/clientes/clientes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>
    <script src="../assets/js/calendarCliente.js" type="text/javascript"></script>
    <script src="../assets/js/alumnoCliente.js" type="text/javascript"></script>
    <script>
        const idUsu = <?php echo json_encode($_SESSION["cliente"]["id"]);?>;
        const nombreUsu = <?php echo json_encode($_SESSION["cliente"]["nombre"]);?>;
    </script>
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
                                .$cliente['nombre'].' '.$cliente['apellido'].' <br> '.$cliente['descripcionCaso']. ' <br> '.$cliente['caracteristicasMenu'].'<br></div>';
                    }
                ?>
            </article>
            <article id="calendar">
            </article>
            <article id="recetas">
                <div class="box-recetasClientes">
                    <a href="#" onclick="closePopUp(event)"><i class="fa fa-times"></i></a>
                    <div class="recetasClientes"></div>
                </div>
                <div id="fecha">
                    <form onsubmit="annadirRecetasFecha(event)" method="post">
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
                        <input type="hidden" id="receta_id" name="receta_id">
                        <input type="hidden" id="dni_cliente" name="dni_cliente">
                        <button type="button" onclick="closeFecha(event)" class="btn">Cerrar</button>
                        <button type="submit" class="btn">Guardar</button>
                    </form>
                </div>
            </article>
        </section>
    </main>
    <footer></footer>
    <aside></aside>
</body>
</html>