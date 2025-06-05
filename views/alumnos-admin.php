<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alumnos - Admin - webDietetica</title>
    <link rel="stylesheet" href="../assets/css/index-admin/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous"/>
    <script src="../assets/js/toggle.js" type="text/javascript"></script>
    <script src="../assets/js/password.js" type="text/javascript"></script>
</head>
<body>
    <header>
        <a href="#"><img class="logo" src="../assets/images/dieta-al-plato-logo.svg" alt="Logo Web Dietética"></a>
        <nav>
            <menu>
                <li><a href="#">Alumnos</a></li>
                <li><a href="../controllers/controller_Clientes.php">Clientes</a></li>
            </menu>
        </nav>
        <div class="icons">
            <a class="search" href="#"><i class="fa fa-search icon-search"></i></a>
            <a class="user" href="controller_logout.php"><i class="fa fa-user"></i></a>
            <a class="menu-burger" href="#menu"><i class="fa fa-bars"></i></a>
        </div>
        <div id="menu">
            <menu>
                <a href="#"><i class="fa fa-times"></i></a>
                <li><a href="#">Alumnos</a></li>
                <li><a href="../controllers/controller_Clientes.php">Clientes</a></li>
            </menu>
        </div>
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
                <form  action="" method="post">
                    <div>
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name">
                    </div>
                    <div>
                        <label for="ape">Apellidos</label>
                        <input type="text" name="ape" id="ape"> 
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email">
                    </div>
                    <div>
                        <label for="pass">Contraseña</label>
                        <input type="password" name="pass" id="pass">
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
                            echo '<div class="box-alumno">'
                                . $alumno['nombre'] . '<br>' . $alumno['apellidos'] . '<br>' . $alumno['email'] . '<br>'
                                . '<button class="btn cambiar-pass" data-id="' . $alumno['id_usuario'] . '">Cambiar contraseña</button>'
                                . '</div>';
                    }
                ?>

                <dialog id="cambiarPass">
                    <form action="" method="post">
                        <input type="hidden" id="id_alumno" name="id_alumno">
                        <label>Nueva contraseña:</label>
                        <input type="password" name="nueva_pass" id="nueva_pass" required>
                        <button type="submit" name="submit" class="btn">Guardar</button>
                        <button type="button" class="btn" id="cerrarDialog">Cancelar</button>
                    </form>
                </dialog>
            </article>
        </section>
    </main>
    <footer></footer>
    <aside></aside>
</body>
</html>