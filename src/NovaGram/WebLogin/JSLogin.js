const API = "%s";
const NAME = "%s";

const method = (method, data = [], token = null) => {
    var xhttp = new XMLHttpRequest();
    let url = API+"/user"+(token ? token+'/' : '')+method;

    xhttp.open("POST", "method.php", false);
    xhttp.send(JSON.stringify({url: url, data: data, session_name: NAME}));

    if(xhttp.status === 200){
        return JSON.parse(xhttp.responseText);
    }
    else{
        alert("error: "+xhttp.status);
    }
}

const confirm = (token) => {
    var xhttp = new XMLHttpRequest();

    xhttp.open("POST", "method.php", false);
    xhttp.send(JSON.stringify({token: token, session_name: NAME}));

    if(xhttp.status === 200){
        return JSON.parse(xhttp.responseText);
    }
    else{
        alert("error: "+xhttp.status);
    }
}


phone_number = prompt("Insert phone number:");

while(true){
    if(!phone_number) break;
    phone_number = phone_number.replace(/(\+|\s)/g, "");
    result = method("login", {phone_number: phone_number});
    if (result.ok){
        token = result.result;
        break;
    }
    else{
        phone_number = prompt("Invalid phone number, retry:");
    }
}

code = prompt("Insert code:");
while(true){
    if(!code) break;
    result = method("authcode", {code: code}, token);
    if (result.ok){
        break;
    }
    else{
        code = prompt("Invalid code, retry:");
    }
}


getme = method("getme", {}, token);

if(!getme.ok){
    password = prompt("Insert 2fa password:");
    while(true){
        if(!password) break;
        result = method("2fapassword", {password: password}, token);
        if (result.ok){
            break;
        }
        else{
            password = prompt("Wrong password, retry:");
        }
    }
}

confirm(token);
method("setWebhook", {url: location.href}, token)

alert("Successfully logged in!");
