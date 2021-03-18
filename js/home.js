document.addEventListener('DOMContentLoaded', e => {

    if(!validateSession()){
        location.replace('login.php');
    }

    let users = [];

    let usersContainer = document.querySelector('#usersContainer');
    
    let btnConfirmNewUser = document.querySelector('#btnConfirmNewUser');
    btnConfirmNewUser.addEventListener('click', newUser);

    let userInput = document.querySelector('#user');
    let password = document.querySelector('#password');

    let uriUsers = 'api/users';

    document.querySelector('#userLoggedIn').innerHTML =  sessionStorage.getItem('user');

    document.querySelector('#logout').addEventListener('click', r => {
        sessionStorage.removeItem('token');
        sessionStorage.removeItem('user');

        location.replace('login.php');
    });
    
    getUsers();

    function newUser(){

        if((!userInput.value) || (!password.value)){
            notification('Debe ingresar un usuario y contraseña');
            return;
        }

        btnConfirmNewUser.innerHTML = '<div class="loader"></div>';
        let user = new FormData();
        user.append('user', userInput.value);
        user.append('password', password.value);


        serverPostConnection(uriUsers,user).then( response  => {
            console.log(response);
            getUsers()
            if(response.status == 'error'){
                notification('Verifique que no haya un usuario con el mismo nombre de usuario');
            }
            btnConfirmNewUser.innerHTML = 'Confirmar';

        });
    }


    function getUsers(){


        serverGetConnection(uriUsers).then( response => {
            console.log(response);
            users = response.users;
            let template = '';
            users.forEach(user => {
                template += `
                <li class="cards_item">
                    <div class="card">
                    <div class="card_content">
                        <input class="" type="text" id="userEdit${user.id}"   value="${user.user}" >
                        <input type="password" class="  " id="passwordEdit${user.id}"   placeholder="Nueva contraseña" >
                        
                        <button class="btnEditar" data-id="${user.id}">Guardar</button>
                        <button class="btnEliminar btnBorrar" data-id="${user.id}">Eliminar</button>
                    </div>
                    </div>
                </li>`;
            });

            usersContainer.innerHTML = template;

            document.querySelectorAll('.btnBorrar').forEach( r => {
                r.addEventListener('click', f => {
                    let userId = r.getAttribute('data-id');
                    deleteUser(r,userId);
                });
            });


            document.querySelectorAll('.btnEditar').forEach( r => {
                r.addEventListener('click', f => {
                    let userId = r.getAttribute('data-id');
                    editUser = document.querySelector('#userEdit' + userId);
                    editPassword = document.querySelector('#passwordEdit' + userId);
                    updateUser(r,userId, editUser.value,editPassword.value);
                });
            });


        })

    }

    function deleteUser(btn,userId){

        btn.innerHTML = '<div class="loader"></div>';


        serverDeleteConnection(uriUsers + '/' + userId).then( response => {
            console.log(response);
            if(response.status === 'error'){
                notification('Error al eliminar el usuario / Verifique no haya iniciado sesion con ese usuario');
            }
            else {
                notification('Usuario eliminado con exito');
            }
            getUsers();
            btn.innerHTML = 'Eliminar';
        })

    }

    function updateUser(btn,userId,userEdit,passwordEdit){

        
        if((!userEdit) || (!passwordEdit)) {
            notification('Debe ingresar un usuario y contraseña');
            return;
        }
        btn.innerHTML = '<div class="loader"></div>';

        let user = new FormData();
        user.append('user',userEdit);
        user.append('password',passwordEdit);

        serverPostConnection(uriUsers + '/' + userId,user).then( response => {
            console.log(response);
            getUsers();
            notification('Usuario '+ userEdit +' actualizado con exito');

            btn.innerHTML = 'Guardar';
        });

    }

    function notification(message) {
        var x = document.getElementById("snackbar");
      
        x.innerHTML = message;
        x.className = "show";
      
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
      }



});