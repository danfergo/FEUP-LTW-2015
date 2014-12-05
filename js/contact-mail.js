function sendEmail(form) {
    $.post("requests/contact-mail.php", form.serialize());
}

$(document).ready(function() {
    $("#sendemail").on('submit', function(event) {
        event.preventDefault();
    });
});


