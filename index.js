$(document).ready(function(){
    $('.btn').click(function(){
        let data = $('input[name=plan]').val()
        $('.plans').append('<li class="task">'+data+'</li>');
    });
    $('input').text('');
});