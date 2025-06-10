<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Page Alumno - webDietetica</title>
    <link rel="stylesheet" href="../assets/css/alimentos/alimentos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous"/>
    <script src="../assets/js/toggle.js" type="text/javascript"></script>
    <script>
        window.tipo = "alimentos";
    </script>
</head>
<body>
    <header>
        <a href="../controllers/controller_inicio.php"><img class="logo" src="../assets/images/dieta-al-plato-logo.svg" alt="Logo Web Dietética"></a>
        <nav>
            <menu>
                <li><a href="../controllers/controller_Clientes.php">Clientes</a></li>
                <li><a href="../controllers/controller_Recetas.php">Recetas</a></li>
                <li><a href="#">Alimentos</a></li>
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
                <li><a href="../controllers/controller_Recetas.php">Recetas</a></li>
                <li><a href="#">Alimentos</a></li>
            </menu>
        </div>
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
                <form  action="" method="post">
                    <div>
                        <label for="name">Nombre alimento</label>
                        <input type="text" name="nombreAlimento">
                    </div>
                    <div>
                        <label for="pc">PC</label>
                        <input type="text" name="pc">
                    </div>
                    <div>
                        <label for="E">E/100</label>
                        <input type="text" name="e_100">
                    </div>
                    <div>
                        <label for="PROT_100">PROT_100</label>
                        <input type="text" name="prot_100">
                    </div>
                    <div>
                        <label for="GRASA_100">GRASA_100</label>
                        <input type="text" name="grasa_100">
                    </div>
                    <div>
                        <label for="AGS_100">AGS_100</label>
                        <input type="text" name="ags_100">
                    </div>
                    <div>
                        <label for="AGMI_100">AGMI_100</label>
                        <input type="text" name="agmi_100">
                    </div>
                    <div>
                        <label for="AGPI_100">AGPI_100</label>
                        <input type="text" name="agpi_100">
                    </div>
                    <div>
                        <label for="COL_100">COL_100</label>
                        <input type="text" name="col_100">
                    </div>
                    <div>
                        <label for="HC_100">HC_100</label>
                        <input type="text" name="hc_100">
                    </div>
                    <div>
                        <label for="FIBRA_100">FIBRA_100</label>
                        <input type="text" name="fibra_100">
                    </div>
                    <div>
                        <label for="VIT_B6_100">VIT_B6_100</label>
                        <input type="text" name="vit_b6_100">
                    </div>
                    <div>
                        <label for="VIT_C_100">VIT_C_100</label>
                        <input type="text" name="vit_c_100">
                    </div>
                    <div>
                        <label for="VIT_D_100">VIT_D_100</label>
                        <input type="text" name="vit_d_100">
                    </div>
                    <div>
                        <label for="VIT_E_100">VIT_E_100</label>
                        <input type="text" name="vit_e_100">
                    </div>
                    <div>
                        <label for="FE_100">FE_100</label>
                        <input type="text" name="fe_100">
                    </div>
                    <div>
                        <label for="NA_100">NA_100</label>
                        <input type="text" name="na_100">
                    </div>
                    <div>
                        <label for="CA_100">CA_100</label>
                        <input type="text" name="ca_100">
                    </div>
                    <div>
                        <label for="K_100">K_100</label>
                        <input type="text" name="k_100">
                    </div>
                    <input type="hidden" name="annadiralimento" value="1">
                    <div class="alergias-container">
                        <label for="alergias">Alergias</label>
                        <div class="alergias">
                            <?php
                                foreach ($alergias as $alergia){
                                    $class = str_replace(' ', '-', strtolower($alergia["nombre_alergia"]));
                                    echo '<div><input type="checkbox" name="alergias[]" value="'.$alergia["id_alergia"].'">'.$alergia["nombre_alergia"]. '<span class="sprite '.$class.'"></span> </div>';
                                }
                            ?>
                        </div>
                    </div>
                    <input type="submit" value="Añadir alimento" class="btn" name="annadirAlimento">
                </form>
            </article>
        </section>
        <section id="all">
            <article class="carrusel">
                <?php                   
                    if (empty($alimentos)) {
                        echo 'No hay alimentos registrados.';
                    }
                    else {
                        echo '<h1>Mis alimentos</h1>';
                        echo '<div class="carousel-container">';
                        echo '<div class="carousel-track" id="carouselTrack">';
                        foreach ($alimentos as $index => $alimento) {
                            echo '<div class="slide" onclick="onSlideClick('.$index.')">';
                            echo '<div class="item-carrusel">'.$alimento['nombreAlimento'].'</div>';
                            echo '</div>';
                        }
                        echo '</div></div>';

                        echo '<button class="edit btn" data-id="">Editar alimento</button>';
                        echo '<div id="alimento-info" class="info-box">';
                        echo '<div class="info">PC: <p id="pc"></p></div>';
                        echo '<div class="info">E_100: <p id="e_100"></p></div>';
                        echo '<div class="info">Prot_100: <p id="prot_100"></p></div>';
                        echo '<div class="info">Grasa_100: <p id="grasa_100"></p></div>';
                        echo '<div class="info">Ags_100: <p id="ags_100"></p></div>';
                        echo '<div class="info">Agmi_100: <p id="agmi_100"></p></div>';
                        echo '<div class="info">AGPI_100: <p id="agpi_100"></p></div>';
                        echo '<div class="info">COL_100: <p id="col_100"></p></div>';
                        echo '<div class="info">HC_100: <p id="hc_100"></p></div>';
                        echo '<div class="info">FIBRA_100: <p id="fibra_100"></p></div>';
                        echo '<div class="info">VIC_C_100: <p id="vit_c_100"></p></div>';
                        echo '<div class="info">VIT_B6_100: <p id="vit_b6_100"></p></div>';
                        echo '<div class="info">VIT_E_100: <p id="vit_e_100"></p></div>';
                        echo '<div class="info">FE_100: <p id="fe_100"></p></div>';
                        echo '<div class="info">NA_100: <p id="na_100"></p></div>';
                        echo '<div class="info">CA_100: <p id="ca_100"></p></div>';
                        echo '<div class="info">K_100: <p id="k_100"></p></div>';
                        echo '<div class="info">VIT_D_100: <p id="vit_d_100"></p></div>';
                        echo '</div>';
                    }
                ?>
                <script src="../assets/js/carrusel.js" type="text/javascript"></script>
                <script src="../assets/js/editar.js" type="text/javascript"></script>
            </article>
        </section>
        <dialog id="editDialog">
            <form  action="" method="post" name="dialog">
                <div>
                    <label for="name">Nombre alimento</label>
                    <input type="text" name="nombreAlimento">
                </div>
                <div>
                    <label for="pc">PC</label>
                    <input type="text" name="pc">
                </div>
                <div>
                    <label for="E">E/100</label>
                    <input type="text" name="e_100">
                </div>
                <div>
                    <label for="PROT_100">PROT_100</label>
                    <input type="text" name="prot_100">
                </div>
                <div>
                    <label for="GRASA_100">GRASA_100</label>
                    <input type="text" name="grasa_100">
                </div>
                <div>
                    <label for="AGS_100">AGS_100</label>
                    <input type="text" name="ags_100">
                </div>
                <div>
                    <label for="AGMI_100">AGMI_100</label>
                    <input type="text" name="agmi_100">
                </div>
                <div>
                    <label for="AGPI_100">AGPI_100</label>
                    <input type="text" name="agpi_100">
                </div>
                <div>
                    <label for="COL_100">COL_100</label>
                    <input type="text" name="col_100">
                </div>
                <div>
                    <label for="HC_100">HC_100</label>
                    <input type="text" name="hc_100">
                </div>
                <div>
                    <label for="FIBRA_100">FIBRA_100</label>
                    <input type="text" name="fibra_100">
                </div>
                <div>
                    <label for="VIT_B6_100">VIT_B6_100</label>
                    <input type="text" name="vit_b6_100">
                </div>
                <div>
                    <label for="VIT_C_100">VIT_C_100</label>
                    <input type="text" name="vit_c_100">
                </div>
                <div>
                    <label for="VIT_D_100">VIT_D_100</label>
                    <input type="text" name="vit_d_100">
                </div>
                <div>
                    <label for="VIT_E_100">VIT_E_100</label>
                    <input type="text" name="vit_e_100">
                </div>
                <div>
                    <label for="FE_100">FE_100</label>
                    <input type="text" name="fe_100">
                </div>
                <div>
                    <label for="NA_100">NA_100</label>
                    <input type="text" name="na_100">
                </div>
                <div>
                    <label for="CA_100">CA_100</label>
                    <input type="text" name="ca_100">
                </div>
                <div>
                    <label for="K_100">K_100</label>
                    <input type="text" name="k_100">
                </div>
                <input type="hidden" name="editaralimento" value="1">
                <input type="hidden" name="id_alimento" value="">
                <div class="alergias-container">
                    <label for="alergias">Alergias</label>
                    <div class="alergias">
                        <?php
                            foreach ($alergias as $alergia){
                                $class = str_replace(' ', '-', strtolower($alergia["nombre_alergia"]));
                                echo '<div><input type="checkbox" name="alergias[]" value="'.$alergia["id_alergia"].'">'.$alergia["nombre_alergia"]. '<span class="sprite '.$class.'"></span> </div>';
                            }
                        ?>
                    </div>
                </div>
                <input type="submit" value="Guardar" class="btn" name="Guardar">
                <button type="button" id="closeDialogBtn" class="btn">Cerrar</button>
            </form>
        </dialog>
    </main>
    <footer></footer>
    <aside></aside>
</body>
</html>