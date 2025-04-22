function updateWatchedCookie(film_id){
    let watched = [];
    
    if(getCookie('watched')){    
        watched = JSON.parse(decodeURIComponent(getCookie('watched')));
    }

    if(!watched.includes(film_id)){
        watched.push(film_id);
    }
    else{
        watched.splice(watched.indexOf(film_id), 1);
    }

    let jsonString = encodeURIComponent(JSON.stringify(watched));
        
    setCookie('watched', jsonString, 365);
}