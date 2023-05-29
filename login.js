function validazione(event)
{
    // Verifica se tutti i campi sono riempiti
    if(form.username.value.length == 0 ||
       form.password.value.length == 0 )
    {
        
    const errore=document.querySelector(".errore");
    errore.classList.remove("hidden");

    event.preventDefault();
   
    }
        
}

// Riferimento al form
const form = document.forms['login'];
// Aggiungi listener
form.addEventListener('submit', validazione);