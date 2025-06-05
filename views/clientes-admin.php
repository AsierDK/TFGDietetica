<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cliente - Admin - webDietetica</title>
    <link rel="stylesheet" href="../assets/css/index-admin/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous"/>
    <script src="../assets/js/toggle.js" type="text/javascript"></script>
</head>
<body>
    <header>
        <a href="#"><img class="logo" src="../assets/images/dieta-al-plato-logo.svg" alt="Logo Web Dietética"></a>
        <nav>
            <menu>
                <li><a href="../controllers/controller_inicio.php">Alumnos</a></li>
                <li><a href="#">Clientes</a></li>
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
            <button id="btnNew" onclick="toggleSection('new')">Nuevo cliente</button>
            <button id="btnAll" onclick="toggleSection('all')">Todos los clientes</button>
        </div>
        <span class="mayor"><span class="menor"></span></span>
        <section id="new" class="active">
            <div class="background"></div>
            <article>
                <h1>Nuevo cliente</h1>
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
                        <label for="dni">DNI</label>
                        <input type="text" name="dni" id="dni">
                    </div>
                    <div>
                        <label for="edad">Edad</label>
                        <input type="number" name="edad" id="edad">
                    </div>
                    <div>
                        <label for="desc">Descripción del caso práctico</label>
                        <textarea name="desc" id="desc"></textarea>
                    </div>
                    <div>
                        <label for="carac">Características del menú</label>
                        <textarea name="carac" id="carac"></textarea>
                    </div>
                    <input type="submit" name="submit" value="Nuevo cliente" class="btn">
                </form>
            </article>
        </section>
        <section id="all">
            <article>
                <?php
                    if (empty($clientes)) {
                        echo 'No hay clientes registrados.';
                    }
                    else {
                        foreach ($clientes as $cliente)
                            echo '<div  class="box-cliente"> '
                                .$cliente['nombre'].' <br> '. $cliente['apellido']. '<br>'.$cliente['email']. '<br></div>';
                    }
                ?>
            </article>
        </section>
    </main>
    <footer></footer>
    <aside></aside>
</body>
</html>