function validazione(event)
{
    
    // Verifica se tutti i campi sono riempiti
    if(form.username.value.length === 0 ||
       form.password.value.length === 0 ||
       form.name.value.length === 0 ||
       form.surname.value.length === 0 ||
       form.email.value.length === 0 ||
       form.gender.value.length === 0 )
    {
        // Avvisa utente
        // (meglio con div nascosto)
        
        const err = document.querySelector("#errore_compilazione");
        err.classList.remove('hidden');
        // Blocca l'invio del form
        event.preventDefault();
    }
        
}

function onResponse(response) 
{
    if (!response.ok) return null;
    return response.json();
}

function jsonCheckEmail(json) 
{
    if (!json.exists) 
    {
        document.querySelector("#err_email").classList.add("hidden");
    } else 
    {
        document.querySelector("#err_email").classList.remove("hidden");
    }
}


function checkEmail(event) 
{
    const input = event.currentTarget;
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(input.value).toLowerCase())) 
    {
        document.querySelector("#err_email_regex").classList.remove("hidden");

    }else 
    {
        fetch("check_email.php?q="+encodeURIComponent((input.value))).then(onResponse).then(jsonCheckEmail);
    }
}

function jsonCheckUsername(json) 
{
    console.log(json);
    if (!json.exists) 
    {
        document.querySelector("#err_username").classList.add("hidden");
    } else 
    {
        document.querySelector("#err_username").classList.remove("hidden");
    }
}

function checkUsername(event) 
{
    const input = event.currentTarget;
    const regex = /^[a-zA-Z0-9_]{4,16}$/;

    if(!regex.test(input.value)) 
    {
        document.querySelector("#err_username_regex").classList.remove("hidden");
    }else 
    {
        document.querySelector("#err_username_regex").classList.add("hidden");
        fetch("check_username.php?q="+encodeURIComponent(input.value)).then(onResponse).then(jsonCheckUsername);
    }    
}

function checkPassword(event) 
{
    const input = event.currentTarget;
    const regex = /[!@#$&^&*(),.?":{}|<>]/;
    if (input.value.length >= 8) 
    {
        document.querySelector("#err_password").classList.add("hidden");
    } else 
    {
        document.querySelector("#err_password").classList.remove("hidden");
    }

    if(regex.test(input.value)){
        document.querySelector("#err_password_char").classList.add("hidden");
    } else 
    {
        document.querySelector("#err_password_char").classList.remove("hidden");
    }
}

function checkPasswordConfirm(event) {
    const input = document.querySelector('#passwordconfirm');
    if (input.value === document.querySelector('#password').value) {
        document.querySelector('#err_password_confirm').classList.add('hidden');
    }else {
        document.querySelector('#err_password_confirm').classList.remove('hidden');
    }

}


// Riferimento al form
const form = document.forms['signup'];
// Aggiungi listener
form.addEventListener('submit', validazione);
document.querySelector('#email').addEventListener('blur', checkEmail);
document.querySelector('#username').addEventListener('blur', checkUsername);
document.querySelector('#password').addEventListener('blur', checkPassword);
document.querySelector('#passwordconfirm').addEventListener('blur', checkPasswordConfirm);