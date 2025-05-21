<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page - webDietetica</title>
    <link rel="stylesheet" href="../assets/css/login/login.css">
</head>
<body>
    <header><nav></nav></header>
    <main>
        <div class="login">
            <h1>LOGIN</h1>
            <form action="../controllers/controller_login.php" method="post">
                <div>
                    <label for="text">Email</label>
                    <input type="text" name="usr">
                </div>
                <div>
                    <label for="password">Constraseña</label>
                    <input type="password" name="psw">
                </div>
                <input type="submit" name="submit" value="Login" class="btn">
            </form>
        </div>
    </main>
    <footer></footer>
    <aside></aside>
</body>
</html>