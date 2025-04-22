function film_list(base_url, api_url){
    $.ajax({
        url: api_url + 'films/',
        method: 'GET',
        dataType: 'json',
        success: function(response){
            let films = response;

            let watched = [];
            if(getCookie('watched')){
                watched = JSON.parse(decodeURIComponent(getCookie('watched')));
            }

            let films_div = $('#films-div');
            for(let i = 0; i < films.length; i++){
                let release_date = new Date(films[i]['release_date']);
                release_date = release_date.toLocaleDateString('pt-BR');

                let watched_btn = `
                    <a href="" class="watched-btn btn btn-sm btn-success" onclick="updateWatchedCookie(${films[i]['id']});">I watched</a>
                `;

                if(watched.includes(parseInt(films[i]['id']))){
                    watched_btn = `
                        <a href="" class="watched-btn btn btn-sm btn-danger" onclick="updateWatchedCookie(${films[i]['id']});">I didn't watch</a>
                    `;
                }

                let film = $(`
                    <div class="film-item col-lg-3 col-md-4 p-2">
                        <div class="film-card h-100">
                            <a href="${base_url}detail/${films[i]['id']}">
                                <img src="${base_url}static/images/standard_image_movies.png" width="100%">
                                <div class="p-4">
                                    <h4 class="title">
                                        <i class="fas fa-film"></i>
                                        Star Wars: ${films[i]['name']} (${films[i]['episode_number']})
                                    </h4>
                                    <br>
                                    Release date: ${release_date}
                                </div>
                            </a>

                            ${watched_btn}
                        </div>
                    </div>
                `);

                films_div.append(film);
            }

            $('#loader').hide();
            $('#content').removeClass('d-none');
        },
        error: function(jqXHR, textStatus, errorThrown){
            $('#error').html(`
                <h6>Error ${jqXHR.status}</h6>
                <h2>${errorThrown}</h2>
            `);
            
            $('#loader').hide();
            $('#error').removeClass('d-none');
        }
    });
}

function film_detail(base_url, api_url, id){
    $.ajax({
        url: api_url + 'films/' + id + '/',
        method: 'GET',
        dataType: 'json',
        success: function(response){
            let film = response;

            let watched = [];
            if(getCookie('watched')){
                watched = JSON.parse(decodeURIComponent(getCookie('watched')));
            }

            let film_div = $('#film-div');
                
            let release_date = new Date(film['release_date']);
            release_date = release_date.toLocaleDateString('pt-BR');

            let film_full_age = film['film_age']['years'] + ' years, ' + film['film_age']['months'] + ' months and ' + film['film_age']['days'] + ' days';

            let characters = '';
            if(!film['characters']['error']){
                characters = film['characters'].join(', ');
            }
            else{
                characters = '<span class="text-danger">Error ' + film['characters']['http_code'] + '<br>' + film['characters']['error'] + '</span>'
            }

            let watched_btn = `
                <a href="" class="btn btn-sm btn-success" onclick="updateWatchedCookie(${film['id']});">I watched</a>
            `;
            if(watched.includes(parseInt(film['id']))){
                watched_btn = `
                    <a href="" class="btn btn-sm btn-danger" onclick="updateWatchedCookie(${film['id']});">I didn't watch</a>
                `;
            }

            let film_details = $(`
                <div>
                    <div class="mb-3 border-bottom border-color-standard d-flex justify-content-between align-items-center">
                        <h2>Film details</h2>

                        ${watched_btn}
                    </div>

                    <h4 class="title-highligh">Name</h4>
                    <p>Star Wars: ${film['name']}</p>

                    <h4 class="title-highligh">Episode number</h4>
                    <p>Episode ${film['episode_number']}</p>

                    <h4 class="title-highligh">Synopsis</h4>
                    <p>${film['synopsis']}</p>

                    <h4 class="title-highligh">Release date</h4>
                    <p>${release_date}</p>
                    
                    <h4 class="title-highligh">Director</h4>
                    <p>${film['director']}</p>
                    
                    <h4 class="title-highligh">Producer(s)</h4>
                    <p>${film['producers']}</p>
                    
                    <h4 class="title-highligh">Names of characters</h4>
                    <p>${characters}</p>
                    
                    <h4 class="title-highligh">Film age</h4>
                    <p>${film_full_age}</p>
                </div>
            `);

            film_div.append(film_details);

            $('#loader').hide();
            $('#content').removeClass('d-none');
        },
        error: function(jqXHR, textStatus, errorThrown){
            $('#error').html(`
                <a href="${base_url}" class="link">
                    <i class="fas fa-arrow-left"></i> Back to catalog
                </a>
                <br><br>
                <h6>Error ${jqXHR.status}</h6>
                <h2>${errorThrown}</h2>
            `);
            
            $('#loader').hide();
            $('#error').removeClass('d-none');   
        }
    });
}

function film_tierlist(base_url, api_url){
    $.ajax({
        url: api_url + 'films/',
        method: 'GET',
        dataType: 'json',
        success: function(response){
            let ranks = {
                'rank_s': 'Rank S',
                'rank_a': 'Rank A',
                'rank_b': 'Rank B',
                'rank_c': 'Rank C',
                'rank_d': 'Rank D'
            }

            let ranks_div = $('#ranks');
            

            for(let key in ranks){
                let rank = $(`
                    <div class="row">
                        <div id="tier_${key}" class="tier_rank col-2 d-flex justify-content-center align-items-center p-4 tier-rank">
                            ${ranks[key]}
                        </div>
                        <div class="col-10 p-0">
                            <ul id="${key}" class="droptrue"></ul>
                        </div>
                    </div>
                `);

                ranks_div.append(rank);
            }
            
            let films = response;

            let films_li = [];
            films.forEach((film) => {
                films_li.push('Star Wars: ' + film['name'] + ' (' + film['episode_number'] + ')');
            });

            let tierlist = {
                'rank_s': [],
                'rank_a': [],
                'rank_b': [],
                'rank_c': [],
                'rank_d': [],
                'rank_none': films_li
            };
            if(getCookie('tierlist')){
                tierlist = JSON.parse(decodeURIComponent(getCookie('tierlist')));
            }
            
            for(let key in tierlist){
                let rank_list = $('#' + key);

                tierlist[key].forEach((film) => {
                    let film_li = $(`
                        <li class="ui-state-default ${key == 'rank_none' ? '' : 'ui-sortable-handle'}">${film}</li>
                    `);

                    rank_list.append(film_li);
                });
            }
            
            $("ul.droptrue").sortable({
                connectWith: "ul",
                placeholder: "ui-state-highlight",
                stop: function(event, ui) {
                    let rank = ui.item.parent().attr('id');
                    updateTierListCookie();
        
                    // console.log(JSON.parse(decodeURIComponent(getCookie('tierlist'))));
                }
            });
         
            $(".droptrue").disableSelection();

            $('#loader').hide();
            $('#content').removeClass('d-none');
        },
        error: function(jqXHR, textStatus, errorThrown){
            $('#error').html(`
                <a href="${base_url}" class="link">
                    <i class="fas fa-arrow-left"></i> Back to catalog
                </a>
                <br><br>
                <h6>Error ${jqXHR.status}</h6>
                <h2>${errorThrown}</h2>
            `);
            
            $('#loader').hide();
            $('#error').removeClass('d-none');
        }
    });
}

function film_watched(base_url, api_url){
    $.ajax({
        url: api_url + 'films/',
        method: 'GET',
        dataType: 'json',
        success: function(response){
            let films = response;

            let watched = [];
            if(getCookie('watched')){
                watched = JSON.parse(decodeURIComponent(getCookie('watched')));
            }

            if(watched.length == 0){
                $('#content').html(`
                    <a href="${base_url}" class="link">
                        <i class="fas fa-arrow-left"></i> Back to catalog
                    </a>
                    <br><br>
                    <h2>No movies watched</h2>
                `);
            }
            else{
                let films_div = $('#films-div');
                for(let i = 0; i < films.length; i++){
                    let release_date = new Date(films[i]['release_date']);
                    release_date = release_date.toLocaleDateString('pt-BR');

                    if(watched.includes(parseInt(films[i]['id']))){
                        let film = $(`
                            <div class="col-lg-3 col-md-4 p-2">
                                <div class="film-card h-100">
                                    <a href="${base_url}detail/${films[i]['id']}">
                                        <img src="${base_url}static/images/standard_image_movies.png" width="100%">
                                        <div class="p-4">
                                            <h4 class="title">
                                                <i class="fas fa-film"></i>
                                                Star Wars: ${films[i]['name']} (${films[i]['episode_number']})
                                            </h4>
                                            <br>
                                            Release date: ${release_date}
                                        </div>
                                    </a>

                                    <a href="" class="watched-btn btn btn-sm btn-danger" onclick="updateWatchedCookie(${films[i]['id']});">I didn't watch</a>
                                </div>
                            </div>
                        `);

                        films_div.append(film);
                    }
                }
            }

            $('#loader').hide();
            $('#content').removeClass('d-none');
        },
        error: function(jqXHR, textStatus, errorThrown){
            $('#error').html(`
                <a href="${base_url}" class="link">
                    <i class="fas fa-arrow-left"></i> Back to catalog
                </a>
                <br><br>
                <h6>Error ${jqXHR.status}</h6>
                <h2>${errorThrown}</h2>
            `);
            
            $('#loader').hide();
            $('#error').removeClass('d-none');
        }
    });
}