<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Page Admin - webDietetica</title>
    <link rel="stylesheet" href="../assets/css/index-admin/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous"/>
    <script src="../assets/js/toggle.js" type="text/javascript"></script>
</head>
<body>
    <header>
        <a href="#"><img class="logo" src="../assets/images/dieta-al-plato-logo.svg" alt="Logo Web Dietética"></a>
        <a class="search" href="#"><i class="fa fa-search icon-search"></i></a>
    </header>
    <main>
        <div class="sidebar">
            <button id="btnNew" onclick="toggleSection('new')">Nuevo alumno</button>
            <button id="btnAll" onclick="toggleSection('all')">Todos los alumnos</button>
        </div>
        <span class="mayor"><span class="menor"></span></span>

        <section id="new" class="active">
            <div class="background"></div>
            <article>
                <h1>Nuevo alumno</h1>
                <form>
                    <div>
                        <label for="name">Nombre</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="ape">Apellidos</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email">
                    </div>
                    <div>
                        <label for="pass">Contraseña</label>
                        <input type="password">
                    </div>
                    <input type="submit" name="submit" value="Nuevo alumno" class="btn">
                </form>
            </article>
        </section>
        <section id="all">
            <article>
                <?php
                    if (empty($alumnos)) {
                        echo 'No hay alumnos registrados.';
                    }
                    else {
                        foreach ($alumnos as $alumno)
                            echo '<div  class="box-alumno"> '
                                .$alumno['nombre'].' <br> '. $alumno['apellidos']. '<br>'.$alumno['email']. '<br>'.'
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