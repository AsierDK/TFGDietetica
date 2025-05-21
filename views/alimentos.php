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
                <form action="" method="post">
                    <div>
                        <label for="name">Nombre alimento</label>
                        <input name="name" type="text">
                    </div>
                    <div>
                        <label for="pc">PC</label>
                        <input name="pc" type="text">
                    </div>
                    <div>
                        <label for="E">E/100</label>
                        <input name="E_100" type="text">
                    </div>
                    <div>
                        <label for="PROT_100">PROT_100</label>
                        <input name="PROT_100" type="text">
                    </div>
                    <div>
                        <label for="GRASA_100">GRASA_100</label>
                        <input name="GRASA_100" type="text">
                    </div>
                    <div>
                        <label for="AGS_100">AGS_100</label>
                        <input name="AGS_100" type="text">
                    </div>
                    <div>
                        <label for="AGMI_100">AGMI_100</label>
                        <input name="AGMI_100" type="text">
                    </div>
                    <div>
                        <label for="AGPI_100">AGPI_100</label>
                        <input name="AGPI_100" type="text">
                    </div>
                    <div>
                        <label for="COL_100">COL_100</label>
                        <input name="COL_100" type="text">
                    </div>
                    <div>
                        <label for="HC_100">HC_100</label>
                        <input name="HC_100" type="text">
                    </div>
                    <div>
                        <label for="FIBRA_100">FIBRA_100</label>
                        <input name="FIBRA_100" type="text">
                    </div>
                    <div>
                        <label for="VIT_B6_100">VIT_B6_100</label>
                        <input name="VIT_B6_100" type="text">
                    </div>
                    <div>
                        <label for="VIT_C_100">VIT_C_100</label>
                        <input name="VIT_C_100" type="text">
                    </div>
                    <div>
                        <label for="VIT_D_100">VIT_D_100</label>
                        <input name="VIT_D_100" type="text">
                    </div>
                    <div>
                        <label for="VIT_E_100">VIT_E_100</label>
                        <input name="VIT_E_100" type="text">
                    </div>
                    <div>
                        <label for="FE_100">FE_100</label>
                        <input name="FE_100" type="text">
                    </div>
                    <div>
                        <label for="NA_100">NA_100</label>
                        <input name="NA_100" type="text">
                    </div>
                    <div>
                        <label for="CA_100">CA_100</label>
                        <input name="CA_100" type="text">
                    </div>
                    <div>
                        <label for="K_100">K_100</label>
                        <input name="K_100" type="text">
                    </div>
                    <input type="submit" name="submit" value="Nuevo alimento" class="btn">
                </form>
            </article>
        </section>
        <section id="all">
            <article>
                <?php
                    if (empty($alimentos)) {
                        echo 'No hay alimentos registrados.';
                    }
                    else {
                        echo '<h1>Mis alimentos</h1>';
                        foreach ($alimentos as $alimento)
                            echo '<div  class="box-alumno">
                                nombre: '.$alimento['nombreAlimento'].' <br>
                                PC: '.$alimento['PC'].' <br>
                                e_100: '.$alimento['e_100'].' <br>
                                prot_100: '.$alimento['prot_100'].' <br>
                                grasa_100: '.$alimento['grasa_100'].' <br>
                                ags_100: '.$alimento['ags_100'].' <br>
                                agmi_100: '.$alimento['agmi_100'].' <br>
                                agpi_100: '.$alimento['agpi_100'].' <br>
                                col_100: '.$alimento['col_100'].' <br>
                                hc_100: '.$alimento['hc_100'].' <br>
                                fibra_100: '.$alimento['fibra_100'].' <br>
                                vit_c_100: '.$alimento['vit_c_100'].' <br>
                                vit_b6_100: '.$alimento['vit_b6_100'].' <br>
                                vit_e_100: '.$alimento['vit_e_100'].' <br>
                                fe_100: '.$alimento['fe_100'].' <br>
                                na_100: '.$alimento['na_100'].' <br>
                                ca_100: '.$alimento['ca_100'].' <br>
                                k_100: '.$alimento['k_100'].' <br>
                                vit_d_100: '.$alimento['vit_d_100'].' <br>
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