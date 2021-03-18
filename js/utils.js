async function serverPostConnection(url,data) {
    let response = await fetch(url, {
        method: 'POST',
        headers: new Headers({
            'Authorization': 'Bearer ' + validateSession(),
        }),
        body: data
    });
    return await response.json();
}

async function serverGetConnection(url) {
    let response = await fetch(url, {
        headers: new Headers({
            'Authorization': 'Bearer ' + validateSession(),
        }),
    });
    return await response.json();
}

async function serverDeleteConnection(url) {
    let response = await fetch(url, {
        method: 'DELETE',
        headers: new Headers({
            'Authorization': 'Bearer ' + validateSession(),
        }),
    });
    return await response.json();
}

function validateSession(){
    let token = sessionStorage.getItem('token');
    if(token){
        return token;
    }
    return null;
}