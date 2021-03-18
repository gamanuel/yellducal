  
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="css/style.css" rel="stylesheet" media="all">
        <title>Yellducal</title>
    </head>


    <body>

        <div class="login-page">
            <div class="form">
                <img src="assets/logo.png" class="logoSizeLogin" >
                <form class="login-form">
                    <input type="text" id="user" placeholder="Usuario" />
                    <input type="password" id="password" placeholder="Contraseña" />
                    <button type="button" id="btnConfirmLogin">Iniciar sesion</button>
                    
                    <p class="message d-none" id="message">Credenciales invalidas</p>
                </form>
            </div>
        </div>

    </body>

    <script src="js/utils.js"></script>
    <script src="js/login.js"></script>

</html>