function newreleases(event){
    fetch("new_releases.php").then(onResponse).then(onRelease);
}

function onResponse(response){
    return response.json();
}

function onRelease(json){
    console.log(json);
    const container = document.querySelector('#releases');
    container.classList.add('container');

    for(let i=0;i<18; i++){
        const doc = json.albums.items[i];
        const contenuto = document.createElement('div');
        contenuto.classList.add('blocco');
        const img = doc.images[0].url;
        const name = doc.name;
        const artist = doc.artists[0].name;

        const immagine = document.createElement('img');
        immagine.src= img;
        const nome = document.createElement('div');
        nome.textContent= name;
        const artista = document.createElement('div');
        artista.textContent = artist;

        contenuto.appendChild(immagine);
        contenuto.appendChild(nome);
        contenuto.appendChild(artista);
        container.appendChild(contenuto);
    }

}

function loadHome(){
    fetch("loadHome.php").then(onResponse).then(onHome);
}

function onHome(json){
    console.log(json);
    const home = document.querySelector('#home');
    home.innerHTML = '';

    for(let i=0; i<json.json.length; i++){
        const doc = json.json[i]; 
        const post = document.createElement('div');
        post.classList.add('post');
        
        const user = document.createElement('span');
        user.textContent = doc.user;

        const imag = document.createElement('img');
        imag.src = doc.img;
        imag.classList.add('imgprofilo');
        

        const datas = document.createElement('div');
        datas.textContent = doc.datas;
        datas.classList.add('datas');

        const removebutton = document.createElement('img');
        removebutton.classList.add('remove-button');
        removebutton.src = "images/delete.png";
        removebutton.dataset.id = doc.id;
        removebutton.addEventListener('click', removePost);

        const profile = document.createElement('div');
        profile.appendChild(imag);
        profile.appendChild(user);
        profile.appendChild(datas);

        fetch("returnUser.php").then(onResponse).then(function(json){ 
            const username = json.user;
            console.log(json.user);
           
            if(doc.user === username) profile.appendChild(removebutton);})
        
        profile.classList.add('profile');

        const albumCover = document.createElement('img');
        albumCover.src = doc.albumCover;

        const trackContainer = document.createElement('div');

        const trackLabel = document.createElement('span');
        trackLabel.textContent = 'Brano: ';
        trackLabel.classList.add('green-text');
        trackContainer.appendChild(trackLabel);

        const trackValue = document.createElement('span');
        trackValue.textContent = doc.trackName;
        trackContainer.appendChild(trackValue);


        const artistContainer = document.createElement('div');

        const artistLabel = document.createElement('span');
        artistLabel.textContent = 'Artista: ';
        artistLabel.classList.add('green-text');
        artistContainer.appendChild(artistLabel);

        const artistValue = document.createElement('span');
        artistValue.textContent = doc.artist;
        artistContainer.appendChild(artistValue);

        const genreContainer = document.createElement('div');

        const genreLabel = document.createElement('span');
        genreLabel.textContent = 'Genere: ';
        genreLabel.classList.add('green-text');
        genreContainer.appendChild(genreLabel);

        const genreValue = document.createElement('span');
        genreValue.textContent = doc.genre;
        genreContainer.appendChild(genreValue);


        const collectionNameContainer = document.createElement('div');

        const collectionNameLabel = document.createElement('span');
        collectionNameLabel.textContent = 'Album: ';
        collectionNameLabel.classList.add('green-text');
        collectionNameContainer.appendChild(collectionNameLabel);

        const collectionNameValue = document.createElement('span');
        collectionNameValue.textContent = doc.collectionName;
        collectionNameContainer.appendChild(collectionNameValue);


        const captionContainer = document.createElement('div');

        const captionLabel = document.createElement('span');
        captionLabel.textContent = "Descrizione dell'utente: ";
        captionLabel.classList.add('green-text');
        captionContainer.appendChild(captionLabel);

        const captionValue = document.createElement('span');
        captionValue.textContent = doc.caption;
        captionContainer.appendChild(captionValue);

        const audio = document.createElement('audio');
        audio.controls = true;
        const audiosrc = document.createElement('source');
        audiosrc.src = doc.audio;
        audio.appendChild(audiosrc);

        const content = document.createElement('div');
        content.classList.add('content');

        post.appendChild(profile);

        post.appendChild(albumCover);
        content.appendChild(trackContainer);
        content.appendChild(artistContainer);
        content.appendChild(genreContainer);
        content.appendChild(collectionNameContainer);
        content.appendChild(captionContainer);
        content.appendChild(audio);

        post.appendChild(content);

        home.appendChild(post);

    }
}

function removePost(event){
    fetch("remove_post.php?q="+ event.currentTarget.dataset.id).then(onResponse).then(function(json){console.log(json)});
    event.currentTarget.parentNode.parentNode.remove();
}

const menu = document.querySelector('#menu');
menu.addEventListener('click', openMenu);

function openMenu(event){
    const menu = event.currentTarget.parentNode;
    menu.classList.toggle('extended');
    document.querySelector('.contenutosidebar').classList.toggle('hidden');
    document.querySelector('.titolo').classList.toggle('hidden');

}

newreleases();
loadHome();