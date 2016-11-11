/**
 * Created by debian on 07/11/16.
 */

$('.like').click(function(){
    var nb_like
    var id = this.id;
    // requete Ajax en utilisant la variable id
    var text = $('#'+id).text();
    if(text =='thumb_up'){
        nb_like = parseInt($('#like_'+id).text().substr(0,2))+1;

        $('#'+id).text('thumb_down');
        $.post('/like',{id : id},null,'json')
            .done(function (data) {

            })
            .fail(function(data){
                console.log(data)
            })
        var id_tool = $('#'+id).attr('data-tooltip-id');
        $('.tooltipped').tooltip('remove');
        $('#'+id).attr('data-tooltip','Je n\'aime plus');
        $('.tooltipped').tooltip({delay: 50});


    }else{
        nb_like = parseInt($('#like_'+id).text().substr(0,2))-1;

        $('#'+id).text('thumb_up');
        $.post('/unlike',{id : id},null,'json')
            .done(function (data) {

            })
            .fail(function(xhr, status, error){
                console.log(status, error)
            })
        $('.tooltipped').tooltip('remove');
        $('#'+id).attr('data-tooltip','J\'aime');
        $('.tooltipped').tooltip({delay: 50});
    }
    $('#like_'+id).text(nb_like + " j'aime(s)");
});
