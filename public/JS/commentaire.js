/**
 * Created by debian on 07/11/16.
 */

$('.postCommentaire').on("click", function(){
    var id = this.id.substr(8);
    var com = ($(this).parent()).children("#textarea").val();
    if (com != "") {
        ($(this).parent()).children("#textarea").val('');
        $.post('/comments', {id: id, com: com}, null, 'json');
        Materialize.toast('Commentaire envoyé !', 2000, 'rounded blue')
    }
    else
        Materialize.toast('Ajoutez un commentaire !', 2000, 'rounded blue')
});

