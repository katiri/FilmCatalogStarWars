$('#search').on('keyup', function(){
    let term = $(this).val().toLowerCase();

    $('#films-div .film-item').each(function() {
        let title = $(this).text().toLowerCase();
        if(!title.includes(term)){
            $(this).addClass('d-none');
        }
        else{
            $(this).removeClass('d-none');
        }
    });
});