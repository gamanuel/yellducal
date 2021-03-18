document.addEventListener('DOMContentLoaded', e => {

    const USER = document.querySelector('#user');
    const PASSWORD = document.querySelector('#password');
    
    const BTNCONFIRMLOGIN = document.querySelector('#btnConfirmLogin');
    BTNCONFIRMLOGIN.addEventListener('click', authenticate);

    const MESSAGE = document.querySelector('#message');


    if(validateSession()){
        location.replace('home.php');
    }
    
    
    function authenticate(){

        
        if(!MESSAGE.classList.contains('d-none')){
            MESSAGE.classList.add('d-none');
        }
        
        if((!USER.value) || (!PASSWORD.value)){
            console.log('error');
            MESSAGE.classList.remove('d-none');
            return;
        }
        BTNCONFIRMLOGIN.disabled = true;
        BTNCONFIRMLOGIN.innerHTML = '<div class="loader"></div>';
        
        let data = new FormData();
        data.append('user', USER.value);
        data.append('password', PASSWORD.value);
        
        let uri = 'api/auth';

        serverPostConnection(uri,data).then( response => {
            
            if(!MESSAGE.classList.contains('d-none')){
                MESSAGE.classList.add('d-none');
            } 
            if(response.status === 'success'){
                sessionStorage.setItem('token', response.token);
                location.replace('home.php');
            }
            else {
                MESSAGE.classList.remove('d-none');
                BTNCONFIRMLOGIN.disabled = false;
                BTNCONFIRMLOGIN.innerHTML = 'Iniciar sesion';
            }

        })
    }

    
      

});