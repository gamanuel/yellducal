  
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

        <div class="main">
        <h1>Crud usuarios</h1>
        <button class="btnLogout" id="logout">Cerrar sesion</button>
        <ul class="cards" >
            <li class="cards_item" >
                <div class="card">
                <div class="card_content">
                    <h4>Nuevo usuario</h4>
                    <input type="text" class="  " id="user"   placeholder="Usuario" >
                    <input type="password" class="  " id="password"   placeholder="Nueva contraseña" >
                    
                    <button id="btnConfirmNewUser">Confirmar</button>
                </div>
                </div>
            </li>

        </ul>
        <ul class="cards" id="usersContainer">
        </ul>
        </div>

        <div id="snackbar"></div>
    </body>

    <script src="js/utils.js"></script>
    <script src="js/home.js"></script>

</html>