function getTierList(){
    let tierlist = {};

    $(".droptrue").each(function (){
        let rank = $(this).attr("id");
        let films = [];

        $(this).find('li').each(function (){
            films.push($(this).text());
        });

        tierlist[rank] = films;
    });

    return tierlist;
}

function updateTierListCookie(){
    let tierlist = getTierList();

    if(getCookie('tierlist')){    
        deleteCookie('tierlist');
    }

    let jsonString = encodeURIComponent(JSON.stringify(tierlist));
        
    setCookie('tierlist', jsonString, 365);
}