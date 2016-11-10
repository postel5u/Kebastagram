/**
 * Created by debian on 07/11/16.
 */

$('.like').click(function(){

    var id = this.id;
    // requete Ajax en utilisant la variable id

    var text = $('#'+id).text();
    if(text =='thumb_up'){
        $('#'+id).text('thumb_down');
        $.post('/like',{id : id},null,'json')
            .done(function (data) {

            })
            .fail(function(data){

            })

    }else{
        $('#'+id).text('thumb_up');
        $.post('/unlike',{id : id},null,'json')
            .done(function (data) {

            })
            .fail(function(data){
                console.log(data)
            })
    }



});