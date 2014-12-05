function sendEmail(form) {
    $.post("requests/contact-mail.php", form.serialize()).done();
}

$(document).ready(function() {
    $("#sendemail").on('submit', function() {
        
        var that = $(this),
            contents = that.serialize();
        
        $.ajax({
            url: "requests/contact-mail.php",
            dataType: "json",
            type: "post",
            data: contents,
            success: function(data) {
                if(data.success) {
                    $('.successful').remove();
                    $('#sendemail').after('<p class="successful">O e-mail foi enviado com sucesso!</p>');
                }
            }
        });
        
        return false;
    });

});


