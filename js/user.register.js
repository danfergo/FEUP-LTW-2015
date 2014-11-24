function userRegister(form) {
   $.post( "requests/user/register.php",form.serialize()).done(function(data) {
        alert("Data Loaded: " + data);
    });
}

function userLogin(form){
    $.post("requests/user/login.php", form.serialize()).done(function(data){
        alert(data);
    });
}



$("#user-register").on('submit', function(event) {
    event.preventDefault();
    userRegister($(this));
});

$("#user-login").on('submit',function(event){
    event.preventDefault();
    userLogin($(this));
});
