function isRegistered(obj, token, msg)
{
    obj.removeClass('border-danger');
    var status=false;
    $.ajax({
        type: 'POST',
        url: 'main.php',
        data: {token: token, query: 'is-registered'},
        success: function(response){
            // console.log(response);
            if(response!=false)
            {
                $('#signup-alert').text(msg);
                $('#signup-alert').show();
                status=true;
            }
        }
    });

    return status;
}

$(document).on('submit', '#signup-form', function(e){
    e.preventDefault();

    var btn=$('#signup-btn')
    btn.attr('disabled', true);
    btn.text('Creating Account');

    var name=$('input[name="name"]').val().trim();
    var email=$('input[name="email"]').val().trim().toLowerCase();
    var password=$('input[name="password"]').val();

    if(!isRegistered($('input[name="email"]'), email, 'Email already registerd'))
    {
        $.ajax({
            type: 'POST',
            url: 'register.php',
            data: {name: name, email: email, password: password},
            success: function(response)
            {
                console.log(response);
                if(response==true)
                    window.location.href='home.php';
                else
                {
                    $('#signup-alert').text('Unable to send verification mail');
                    $('#signup-alert').show();
                    btn.attr('disabled', false);
                    btn.text('Create Account');
                }
            }
        });
    }
});

$(function() {
    $('#WAButton').floatingWhatsApp({
    phone: '+917979077520', //WhatsApp Business phone number International format-
    //Get it with Toky at https://toky.co/en/features/whatsapp.
    headerTitle: 'Welcome to the Goodbook!', //Popup Title
    popupMessage: 'Hello, how can we help you?', //Popup Message
    showPopup: true, //Enables popup display
    buttonImage: '<img src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/whatsapp.svg" />', //Button Image
    //headerColor: 'crimson', //Custom header color
    //backgroundColor: 'crimson', //Custom background button color
    position: "right"    
  });
});