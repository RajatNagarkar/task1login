document.querySelector('#submit-login').addEventListener('click',function(event){
    event.preventDefault();
    formData = new FormData();
    formData.append('user',$('input[name=username]').val());
    formData.append('pass',$('input[name=pass]').val());
    if($('input[name=full_name]').val() != undefined){
        formData.append('full_name', $('input[name=full_name]').val());
        formData.append('conf-pass', $('input[name=conf-pass]').val());
    }
    $.ajax({
        url: 'php/login.php',
        method: 'post',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function(output, status){
            // window.location.replace('http://localhost/login%20Task1/hello');
            // alert(output);
            // console.log(output);
            if(output == 'ExA0404'){
                $('.feedback').text('Invalid Username or Password!');
                $('.wrapper').css('animation-name','invalid');
                $('input').css('border-color','red');
                $('.input-label').css('color','red');
                
                // $('.inp-field').css('margin-bottom','40px');
                // alert('Invalid Username or Password!');
            }
            else if(output == 'ExU34A6'){
                $('.feedback').text('Username (Min Length: 6)');
                $('.wrapper').css('animation-name','invalid');
                $('input[name=username]').css('border-color','red');
                $('label[for=username]').css('color','red');
            }
            else if(output == 'T4xP404'){
                $('.feedback').text('Password (Min Length: 6)');
                $('.wrapper').css('animation-name','invalid');
                $('input[name=pass]').css('border-color','red');
                $('label[for=password]').css('color','red');
            }
            else if(output == 'T4xP508'){
                $('.feedback').text('Passwords do not match!');
                $('.wrapper').css('animation-name','invalid');
                $('input[name=pass]').css('border-color','red');
                $('label[for=password]').css('color','red');
                $('input[name=conf-pass]').css('border-color','red');
                $('label[for=conf-pass]').css('color','red');
            }
            else if(output == 'SrT48200'){
                window.location.replace('http://localhost/login%20Task1/');
            }
            else{
                window.location.replace('http://localhost/login%20Task1/hello');
            }
        },
        error: function(error, stat){
            alert(error + '---' + stat);
        }
    });
    $('.wrapper').css('animation-name','');
});
$(document).ready(function(){
    $('#sign-up').click(function(){
        $('.title').text('Sign Up');
        $('.name-field').attr('class','inp-field name-field field');
        $('.name-field').html('<input id="inp-name" required/><label for="name">Name</label>');
        $('#inp-name').attr({
            'type': 'text',
            'name': 'full_name',
        });
        $('.conf-pass-field').attr('class','inp-field conf-pass-field field');
        $('.conf-pass-field').html('<input id="inp-pass" required /><label for="conf-pass">Confirm Password</label>');
        $('#inp-pass').attr({
            'type': 'password',
            'name': 'conf-pass'
        });
        $('.submit').attr('id','submit-signup')
        $('.sign-up').css('display','none');
        $('.log-in').css('display','block');
        // $('.signup-link').text('Already a member?');
        // $('.signup-link').append('<a id="log-in"> Login Here</a>');
    });
    $('#log-in').click(function(){
        $('.name-field').empty();
        $('.name-field').attr('class','name-field');
        $('.conf-pass-field').empty();
        $('.conf-pass-field').attr('class','conf-pass-field');
        $('.log-in').css('display','none');
        $('.submit').attr('id','log-in')
        $('.sign-up').css('display','block');
    });
})