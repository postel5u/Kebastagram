$('.btn_follow').on("click", function(){
    var id = this.id.substr(7);
    $.post('/follow', {id: id}, null, 'json');
    Materialize.toast('Vous suivez maintenant cette personne !',2000, 'rounded blue');
});

$('.btn_unfollow').on("click", function(){
    var id = this.id.substr(9);
    $.post('/unfollow', {id: id}, null, 'json');
    Materialize.toast('Vous ne suivez plus cette personne !',2000, 'rounded blue');
});


