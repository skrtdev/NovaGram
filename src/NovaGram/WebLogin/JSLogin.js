const API = "%s";
const NAME = "%s";

const method = (method, data = [], token = null) => {
    let xhttp = new XMLHttpRequest();
    let url = API+"/user"+(token ? token+'/' : '')+method;

    xhttp.open("POST", "method.php", false);
    xhttp.send(JSON.stringify({url: url, data: data, session_name: NAME}));

    if(xhttp.status === 200){
        return JSON.parse(xhttp.responseText);
    }
    else{
        alert("Error: "+xhttp.status);
    }
}

const confirm = (token) => {
    let xhttp = new XMLHttpRequest();

    xhttp.open("POST", "method.php", false);
    xhttp.send(JSON.stringify({token: token, session_name: NAME}));

    if(xhttp.status !== 200){
        alert(`Error: ${xhttp.status}`);
    }
}

let phone_number = prompt("Insert phone number:");

while(true){
    if(!phone_number) throw '';
    phone_number = phone_number.replace(/(\+|\s)/g, "");
    let result = method("login", {phone_number: phone_number});
    if (result.ok){
        var token = result.result.token;
        break;
    }
    else{
        phone_number = prompt("Invalid phone number, retry:");
    }
}

let code = prompt("Insert code:");
while(true){
    if(!code) throw '';
    var result = method("authcode", {code: code}, token);
    if (result.ok){
        break;
    }
    else{
        code = prompt("Invalid code, retry:");
    }
}


result = result.result
if(result.authorization_state === "wait_password"){
    let password = prompt(result.password_hint ? `Insert 2fa password (hint: ${result.password_hint}):` : "Insert 2fa password:");
    while(true){
        if(!password) throw '';
        result = method("2fapassword", {password: password}, token);
        if (result.ok){
            break;
        }
        else{
            password = prompt("Wrong password, retry:");
        }
    }
}

method("setWebhook", {url: location.href}, token)
confirm(token);

alert("Successfully logged in! Userbot is now running");
