document.querySelector("#form").addEventListener("submit", search);
document.querySelector("#form2").addEventListener("submit", search2);


function onResponse(response){
    return response.json();
}

function search2(event){
    const form_data = new FormData(document.querySelector("#form2"));
    fetch("search_song.php?q="+encodeURIComponent(form_data.get('search'))).then(onResponse).then(jsoniTunes);
    event.preventDefault();
}

function search(event){
    const form_data = new FormData(document.querySelector("#form"));
    fetch("search_playlist.php?q="+encodeURIComponent(form_data.get('search'))).then(onResponse).then(jsonSpotify);
    event.preventDefault();
}

function jsoniTunes(json){
    console.log(json);
    const covers = document.getElementById('covers');
    covers.innerHTML = '';
    
    covers.classList.add('container');
    let num_results = json.resultCount;

    if(num_results > 14)
    num_results = 14;

    if(num_results === 0){
      const err = document.createElement('p');
      err.textContent= 'Spiacente, la ricerca non è andata a buon fine';
      covers.appendChild(err);

    }else{

    for(let i=0; i<num_results; i++){
        
      const doc = json.results[i];
      const albumCover = doc.artworkUrl100;
      const trackName = doc.trackName;
      const info = document.createElement('div');
      info.classList.add('blocco');

      const imgecuoreover = document.createElement('div');
      imgecuoreover.classList.add('imgecuoreover');

      const txt = document.createElement('div');
      txt.classList.add('txt');

      const img_e_cuore = document.createElement('div');
      
      img_e_cuore.classList.add('img_e_cuore');

      const img = document.createElement('img');
      img.src = albumCover;
      img.classList.add('albumCover');

      
      const nameAlbum = document.createElement('span');
      nameAlbum.textContent = trackName;
      const artist = document.createElement('p');
      artist.textContent= doc.artistName

      const audio = document.createElement('audio');
      audio.controls=true;

      const audioSource = document.createElement('source')
      audioSource.src=doc.previewUrl;

      const heartIcon = document.createElement('img');
        fetch("isFav.php?q=" + encodeURIComponent(doc.trackId)).then(onResponse).then(function(json){ heartIcon.src = json.img;
        img_e_cuore.appendChild(heartIcon);
        if(json.msg === true){heartIcon.classList.add('filled')}});

     
      heartIcon.classList.add('heart-icon');

     // img_e_cuore.appendChild(heartIcon);

      heartIcon.addEventListener('click', addToFav);
    
      imgecuoreover.appendChild(img_e_cuore);
      img_e_cuore.appendChild(img);
      imgecuoreover.appendChild(img_e_cuore);
      info.appendChild(imgecuoreover);
     // info.appendChild(img_e_cuore);
      //info.appendChild(img);
      
      txt.appendChild(artist);
      txt.appendChild(nameAlbum);
      txt.appendChild(audio);
      audio.appendChild(audioSource);
info.appendChild(txt);
      covers.appendChild(info);

      const trackId = doc.trackId;

      img_e_cuore.dataset.albumCover = albumCover;
      img_e_cuore.dataset.trackName = trackName;
      img_e_cuore.dataset.artist = doc.artistName;
      img_e_cuore.dataset.audio = doc.previewUrl;
      img_e_cuore.dataset.id = trackId;
      img_e_cuore.dataset.genre = doc.primaryGenreName;
      img_e_cuore.dataset.collectionName = doc.collectionName;
    }

}
}

function jsonSpotify(json){
    console.log(json);
    const playlists = document.getElementById('plays');
    playlists.innerHTML = '';
    
    playlists.classList.add('container');

    let num_results = json.length;

    if(num_results > 14)
    num_results = 14;

    if(num_results === 0){
      const err = document.createElement('p');
      err.textContent= 'Spiacente, la ricerca non è andata a buon fine';
      playlists.appendChild(err);

    }else{


    for(let i=0; i<14; i++){
        const blocco = document.createElement('div');
        blocco.classList.add('blocco');
        const doc = json[i];
        const id = doc.id;
        const img = doc.images[0].url;
        const name = doc.name;

        const img_e_cuore = document.createElement('div');
        img_e_cuore.classList.add('img_e_cuore');
        const heartIcon = document.createElement('img');
        heartIcon.classList.add('heart-icon');
        //heartIcon.dataset.msg = true;       
        img_e_cuore.dataset.id = doc.id;
        img_e_cuore.dataset.oldId = doc.oldId;
        
        img_e_cuore.dataset.msg = doc.msg;
        img_e_cuore.appendChild(heartIcon); 
        heartIcon.addEventListener('click', addToFavPlaylist);
        if(doc.msg){
           heartIcon.src = 'images/heart_filled.png';
           heartIcon.classList.add('filled');
        }
        else {
          heartIcon.src = 'images/heart.png';
          heartIcon.classList.remove('filled');
        } 
        const immagine = document.createElement('img');
        immagine.src=img;
        immagine.classList.add('albumCover');
        const nome = document.createElement('div');
        nome.textContent = name;

        const imgecuoreover = document.createElement('div');
        imgecuoreover.classList.add('imgecuoreover');
        imgecuoreover.appendChild(img_e_cuore);

        img_e_cuore.appendChild(heartIcon);
        img_e_cuore.appendChild(immagine); 
        blocco.appendChild(imgecuoreover);
        //blocco.appendChild(immagine);
        blocco.appendChild(nome);
        playlists.appendChild(blocco);

      blocco.dataset.immagine = img;
      blocco.dataset.nome = name;
      blocco.dataset.id = doc.id;
    }
  }
}

function addToFav(event){

    const img = event.currentTarget;
    img.src = img.classList.toggle('filled') ? "images/heart_filled.png" : "images/heart.png";
    const img_e_cuore = event.currentTarget.parentNode;
    const form_data = new FormData();
    form_data.append('albumCover', img_e_cuore.dataset.albumCover);
    form_data.append('trackName', img_e_cuore.dataset.trackName);
    form_data.append('artist', img_e_cuore.dataset.artist);
    form_data.append('audio',img_e_cuore.dataset.audio);
    form_data.append('id', img_e_cuore.dataset.id);
    form_data.append('genre', img_e_cuore.dataset.genre);
    form_data.append('collectionName', img_e_cuore.dataset.collectionName);
    fetch("save_song.php", {method: 'post', body: form_data}).then(onResponse).then(onAdded);
    event.preventDefault();
}


function addToFavPlaylist(event) {

  const cuore = event.currentTarget;
  console.log(cuore.parentNode.dataset.msg);
 
  if(cuore.parentNode.dataset.msg === 'true') {
    cuore.classList.remove('filled');
    cuore.src = "images/heart.png";
    cuore.parentNode.dataset.msg='false';
    cuore.parentNode.dataset.oldId=0;
  }else{
    cuore.src = "images/heart_filled.png";
    cuore.classList.add('filled');
    cuore.parentNode.dataset.msg = 'true';
    const imgecuori = document.querySelectorAll('.img_e_cuore');
    for (let i=0;i < imgecuori.length; i++){
      //console.log(imgecuori[i].dataset.oldId)
      if (imgecuori[i].dataset.oldId === imgecuori[i].dataset.id && imgecuori[i].dataset.oldId !== cuore.parentNode.dataset.id){
        const vecchiocuore = imgecuori[i].querySelector('.heart-icon');
        vecchiocuore.src = "images/heart.png";
        console.log(vecchiocuore.parentNode.dataset.id);
        vecchiocuore.parentNode.dataset.msg = 'false';
        vecchiocuore.parentNode.dataset.oldId = cuore.parentNode.dataset.id;

        cuore.parentNode.dataset.oldId =cuore.parentNode.dataset.id;
      }
      imgecuori[i].dataset.oldId = cuore.parentNode.dataset.id;

    }
  }

  const blocco = cuore.parentNode.parentNode.parentNode;
  const form_data = new FormData();
  form_data.append('immagine', blocco.dataset.immagine);
  form_data.append('nome', blocco.dataset.nome);
  form_data.append('id', blocco.dataset.id);
  fetch('save_playlist.php', { method: 'post', body: form_data }).then(onResponse).then(onAdded);
        
  event.preventDefault();
}

function onAdded(json){
    console.log(json.msg);
}

function onisFav(json){
    console.log(json);
    return json.img;
}


  
function onImage(json){
    console.log(json);
    console.log(json.success);
    console.log(json.message);
    console.log(json.error);
}

function removeAccount(event){
  fetch("remove_account.php").then(function(){console.log("Eliminato");
  window.location.href = "login.php";}); 
}

function openModal(event){
  const modalView = document.querySelector('#modal-view');
  modalView.innerHTML = '';
  modalView.addEventListener('click', closeModal);
  const riquadrocont = document.createElement('div');
  riquadrocont.classList.add('riquadrocont');
    
      
  const riquadro = document.createElement('div');
  riquadro.classList.add('riquadro');
  const txt = document.createElement('h3');
  txt.textContent = "Scegli il tuo avatar tra questi:";
  riquadrocont.appendChild(txt);
  riquadrocont.appendChild(riquadro);

  document.body.classList.add('no-scroll');
  for(let i=0; i<15; i++){
    const immagine = document.createElement('img');
    immagine.src = "images/pfp" + i + ".png";
    immagine.classList.add('avatar_pic');
    immagine.addEventListener('click', changeAvatar);
    riquadro.append(immagine);
    
  }
  modalView.appendChild(riquadrocont);
  modalView.classList.remove('hidden');
}

function closeModal(event){
  event.stopPropagation();
    const modalView = document.querySelector('#modal-view');
    const riquadro = document.querySelector('.riquadro');
    const input = document.querySelector('#textpost')
    if (event.target !== riquadro &&  event.target !== input) {
    modalView.classList.add('hidden');
    document.body.classList.remove('no-scroll');
    }
}

function changeAvatar(event) {
  const img = event.currentTarget;
  fetch("changeAvatar.php?q=" + img.src).then(onResponse).then(function(json){console.log(json)});
  const pfp = document.querySelector('#pfp');
  pfp.src = img.src;
}

const button = document.querySelector('button');
button.addEventListener('click', removeAccount);

const avatar = document.querySelector('.avatar img');
avatar.addEventListener('click', openModal);


const menu = document.querySelector('#menu');
menu.addEventListener('click', openMenu);

function openMenu(event){
    const menu = event.currentTarget.parentNode;
    menu.classList.toggle('extended');
    document.querySelector('.contenutosidebar').classList.toggle('hidden');
    document.querySelector('.titolo').classList.toggle('hidden');

}