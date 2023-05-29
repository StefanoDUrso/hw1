tenSongsFromPlaylist();
favsongs();

function tenSongsFromPlaylist(){
    fetch("showPlaylist.php").then(onResponse).then(onjsonShowPl);
}

function onResponse(response){
    return response.json();
}

function onjsonShowPl(json){
    if(json.length !== 0 ){
    const column1 = document.createElement('div');
   
    column1.classList.add('colonna');
    forcolumn(0,5,json);
    forcolumn(5,10, json);
    }
}

function forcolumn(j, k, json) {
    const column1 = document.createElement('div');
    column1.classList.add('colonna');

    for (let i = j; i < k; i++) {
        const doc = json.tracks.items[i].track;
        const artist = doc.artists[0].name;
        const name = doc.name;
        const audio = doc.preview_url;
        const albumCover = doc.album.images[0].url;

        const txt = document.createElement('div');
        txt.classList.add('txt');
        const album = document.createElement('img');
        album.src = albumCover;
        const audios = document.createElement('audio');
        audios.controls = true;
        const audiosrc = document.createElement('source');
        if (audio !== null) audiosrc.src = audio;
        audios.appendChild(audiosrc);
        txt.textContent = name + ' - ' + artist;
        const blocco = document.createElement('div');
        blocco.classList.add('blocco');
        blocco.appendChild(album);
        blocco.appendChild(txt);
        blocco.appendChild(audios);

        column1.appendChild(blocco);
    }

    const songs = document.querySelector('#topten');
    songs.appendChild(column1);
}

function favsongs(){
    fetch("showSongs.php").then(onResponse).then(onjsonShowSongs);
}

function onjsonShowSongs(json){
    console.log(json);

    if(json.length !== 0){

        const favs = document.querySelector('#songs');
        for (let i = 0; i < json.length; i++) {
            const doc = json[i];
            const artist = doc.artist;
            const trackName = doc.trackName;
            const audio = doc.audio;
            const albumCover = doc.albumCover;
            const id = doc.id;

            const album = document.createElement('img');
            album.src = albumCover;
            const audios = document.createElement('audio');
            audios.controls = true;
            const audiosrc = document.createElement('source');
            if (audio !== null) audiosrc.src = audio;
            audios.appendChild(audiosrc);
        
            const blocco = document.createElement('div');
            blocco.classList.add('blocco2');
            blocco.appendChild(album);
            blocco.addEventListener('click', openModal);
            blocco.dataset.id = id;

            blocco.appendChild(audios);
            favs.appendChild(blocco);
        }

    }

}

function openModal(event){
   
    const formdata = new FormData();
    formdata.append('id', event.currentTarget.dataset.id);
    fetch("showSong.php",{method: 'post', body: formdata}).then(onResponse).then(onjsonShowModal);
}

function onjsonShowModal(json){
    console.log(json);
    const modalView = document.querySelector('#modal-view');
    modalView.innerHTML= '';
    modalView.addEventListener('click', closeModal);

    const riquadrocont = document.createElement('div');
    riquadrocont.classList.add('riquadrocont');
      
        
    const riquadro = document.createElement('div');
    riquadro.classList.add('riquadro');
    riquadro.addEventListener('click', function(event){ event.stopPropagation()});
    
    riquadrocont.appendChild(riquadro);
      
    const img = json.albumCover;
    const artist = json.artist;
    const trackName = json.trackName;
    const audio = json.audio;

    const immagine = document.createElement('img');
    immagine.src = img;
    const artista = document.createElement('div');
    artista.textContent = artist;
    const track = document.createElement('div');
    track.textContent = trackName;
    const audios = document.createElement('audio');
    audios.controls =true;
    const audiosrc = document.createElement('source');
    audiosrc.src = audio;
    audios.appendChild(audiosrc);

    const button = document.createElement('button');
    button.id = "remove";
    button.textContent = "Rimuovi dai preferiti";
    button.addEventListener('click', removeFav);

    const form = document.createElement('form');
    form.id = 'post';
    form.name= 'post';
    const input = document.createElement('input');
    input.type = 'text';
    input.id = 'textpost';
    const input2 = document.createElement('input');
    input2.type = 'submit';
    input2.id = 'submitpost';
    input2.value= 'Posta la canzone con descrizione';

    form.appendChild(input);
    form.appendChild(input2);

    const tick = document.createElement('img');
    tick.src= "images/tick.png";
    tick.classList.add('tick');
    tick.classList.add('opacity');
    form.appendChild(tick);

    const inputs = document.createElement('div');
    inputs.appendChild(button);
    inputs.appendChild(form);
    inputs.classList.add('inputs');

    

    document.body.classList.add('no-scroll');
    riquadro.appendChild(immagine);
    riquadro.appendChild(track);
    riquadro.appendChild(artista);
    riquadro.appendChild(audios);
    riquadro.appendChild(inputs);

    riquadro.dataset.id = json.id;
    riquadro.dataset.albumCover = img;
    riquadro.dataset.trackName = trackName;
    riquadro.dataset.artist = artist;
    riquadro.dataset.audio = audio;
    riquadro.dataset.genre = json.genre;
    riquadro.dataset.collectionName = json.collectionName;
    form.addEventListener('submit', postSong);
       
    modalView.appendChild(riquadrocont);
    modalView.classList.remove('hidden');
}

function closeModal(event) {
    event.stopPropagation();
    const modalView = document.querySelector('#modal-view');
    const riquadro = document.querySelector('.riquadro');
    const input = document.querySelector('#textpost')
    modalView.classList.add('hidden');
    document.body.classList.remove('no-scroll');
    document.querySelector('.tick').classList.add('opacity');
    
}
  
function removeFav(event){
    fetch("removeFav.php?q=" + encodeURIComponent(event.currentTarget.parentNode.parentNode.dataset.id)).then(onResponse).then(onDeleted);
    //queryselectorAll scorri finche non trovi quello con l'id e fai removechild 
    
    const blocchi = document.querySelectorAll('.blocco2');
    const songs = document.querySelector('#songs')

    for (let i = 0; i < blocchi.length; i++) {
        const element = blocchi[i];
        if(element.dataset.id === event.currentTarget.parentNode.parentNode.dataset.id) songs.removeChild(element); 
    }
}

function onDeleted(json){
    console.log(json);
}

function postSong(event){
    event.preventDefault();
    const formdata = new FormData();
    formdata.append('id', event.currentTarget.parentNode.parentNode.dataset.id);
    formdata.append('albumCover', event.currentTarget.parentNode.parentNode.dataset.albumCover);
    formdata.append('trackName', event.currentTarget.parentNode.parentNode.dataset.trackName);
    formdata.append('artist', event.currentTarget.parentNode.parentNode.dataset.artist);
    formdata.append('audio', event.currentTarget.parentNode.parentNode.dataset.audio);
    formdata.append('genre', event.currentTarget.parentNode.parentNode.dataset.genre);
    formdata.append('collectionName', event.currentTarget.parentNode.parentNode.dataset.collectionName);

    const input = document.querySelector('#textpost');
    formdata.append('caption', input.value);
    console.log(input.value);
    fetch("postSong.php", {method: 'post', body: formdata}).then(onResponse).then(onPosted);
    document.querySelector('.tick').classList.remove('opacity');
}

function onPosted(json){
    console.log(json);
    if(json.msg === true){
        const img = document.querySelector('.tick');
    }
}


const menu = document.querySelector('#menu');
menu.addEventListener('click', openMenu);

function openMenu(event){
    const menu = event.currentTarget.parentNode;
    menu.classList.toggle('extended');
    document.querySelector('.contenutosidebar').classList.toggle('hidden');
    document.querySelector('.titolo').classList.toggle('hidden');

}