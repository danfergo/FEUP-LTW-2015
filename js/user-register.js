function userRegister(form) {
    $.post("requests/user/register.php", form.serialize()).done(function(data) {
        alert(data);
    });
}

function userLogin(form) {
    $.post("requests/user/login.php", form.serialize()).done(function(data) {
        if (typeof data === 'object' && data.hasOwnProperty('userid')) {
            location.reload();
        } else {
            alert(data);
        }
    });
}


$(document).ready(function() {
    $("#user-register").on('submit', function(event) {
        event.preventDefault();
        userRegister($(this));
    });

    $("#user-login").on('submit', function(event) {
        event.preventDefault();
        userLogin($(this));
    });
}); 