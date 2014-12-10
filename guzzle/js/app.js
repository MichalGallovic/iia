(function(){
    $('#github-search').submit(function(event) {
        event.preventDefault();
        var username = $('#username').val();
        $.ajax({
            type: "GET",
            url: "github/" +username
        }).done(function(response){
            dismissCardAnimated();
            setTimeout(function() {
                presentUserCard(response);
            }, 350);
        }).fail(function(error){
            presentError(error);
        });
    });

    function dismissCardAnimated() {
        var children = $('#gitcard-placeholder').children();
        if(children.length != 0) {
            $('#gitcard-placeholder').addClass('bounceOutRight');
        }
    }

    function presentError(data) {
        $('#username').addClass('shake')
            .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
               $('#username').removeClass('shake');
            });
    }

    function presentUserCard(data) {
        $('#gitcard-placeholder').removeClass('bounceOutRight').empty();
        var source = $('#github-card').html();
        var template = Handlebars.compile(source);
        var html = template(data);
        $('#gitcard-placeholder').append(html);
        $('#gitcard-placeholder').addClass('bounceInLeft');
    }
})();