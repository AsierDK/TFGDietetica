<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Page Alumno - webDietetica</title>
    <link rel="stylesheet" href="../assets/css/alimentos/alimentos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous"/>
    <script src="../assets/js/toggle.js" type="text/javascript"></script>
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
            <button id="btnNew" onclick="toggleSection('new')">Nuevo alimento</button>
            <button id="btnAll" onclick="toggleSection('all')">Todos los alimentos</button>
        </div>
        <span class="mayor"><span class="menor"></span></span>

        <section id="new" class="active">
            <div class="background"></div>
            <article>
                <h1>Nuevo alimento</h1>
                <form>
                    <div>
                        <label for="name">Nombre alimento</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="pc">PC</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="E">E/100</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="PROT_100">PROT_100</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="GRASA_100">GRASA_100</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="AGS_100">AGS_100</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="AGMI_100">AGMI_100</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="AGPI_100">AGPI_100</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="COL_100">COL_100</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="HC_100">HC_100</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="FIBRA_100">FIBRA_100</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="VIT_B6_100">VIT_B6_100</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="VIT_C_100">VIT_C_100</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="VIT_D_100">VIT_D_100</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="VIT_E_100">VIT_E_100</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="FE_100">FE_100</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="NA_100">NA_100</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="CA_100">CA_100</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="K_100">K_100</label>
                        <input type="text">
                    </div>
                    <input type="submit" value="Nuevo alimento" class="btn">
                </form>
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