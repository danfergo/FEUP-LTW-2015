function sendEmail(form) {
    $.post("requests/contact-mail.php", form.serialize()).done();
}

$(document).ready(function() {
    $("#sendemail").on('submit', function() {
        //event.preventDefault();
        //sendEmail($this);
        var that = $(this),
            contents = that.serialize();
        
        $.ajax({
            url: "requests/contact-mail.php",
            dataType: "json",
            type: "post",
            data: contents,
            success: function(data) {
                if(data.success) {
                    $("#sendemail").after("<p>O e-mail foi enviado com sucesso!</p>");
                }
            }
        });
        
        return false;
    });
    //pop up
});


