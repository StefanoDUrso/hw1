function onNews(json)
{
    console.log(json);
    const news = document.querySelector('#news');
    let numnews = 10;

    if(json.totalResults < 10){
        numnews = json.totalResults;    
    }

   for(let i=0;i<numnews;i++)
    {
        const doc=json.results[i];
        const title=doc.title;
        const articolo=doc.description;
        const link=doc.link;

        const titolo=document.createElement('h3');
        titolo.textContent=title;
        titolo.classList.add('green');
        

        const testo=document.createElement('p');
        testo.textContent=articolo;

        const linkk=document.createElement('a');
        linkk.textContent='Link notizia';
        linkk.href=link;

        const notizia = document.createElement('section');
        notizia.classList.add('notizia');
        notizia.appendChild(titolo);
        notizia.appendChild(testo);
        notizia.appendChild(linkk);
        news.appendChild(notizia);
    }
    
}

function onResponse(response) 
{
    return response.json();
}

const menu = document.querySelector('#menu');
menu.addEventListener('click', openMenu);

function openMenu(event){
    const menu = event.currentTarget.parentNode;
    menu.classList.toggle('extended');
    document.querySelector('.contenutosidebar').classList.toggle('hidden');
    document.querySelector('.titolo').classList.toggle('hidden');

    if(menu.classList.contains('extended')){
        
    }
}


fetch('search_news.php').then(onResponse).then(onNews);
