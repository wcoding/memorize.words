$(document).ready(function() {

    $('.list-word input').focus(function() {
        $(this).keyup(function() {
            var isCorrect = $(this).attr('id');
            if(isCorrect === $(this).val()) {
                $(this).css({color: 'green'});
            } else {
                $(this).css({color: 'red'});
            }
        });
    });
    
    $('.list-word button').click(function() {
        ion.sound.play($(this).attr('data'));
    });

});
