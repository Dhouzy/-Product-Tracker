$(document).ready(function () {
    'use strict';

    $('#form-login').submit(function (event) {
        event.preventDefault();

        var form = $(this).serialize();
        $.ajax({
            url: "/users/login.json",
            type: "post",
            data: form,
            success: function (responseData) {
                if(responseData.loginSucceeded) {
                    window.location = responseData.redirectUrl;
                    $("#login-alert").hide();
                } else {
                    $("#login-alert").css('display', 'block');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

    $('#form-signup').submit(function (event) {
        event.preventDefault();

        var form = $(this).serialize();
        $.ajax({
            url: "/users/add.json",
            type: "post",
            data: form,
            success: function (response) {
                if(response.userSaved ===true){
                    location.reload();
                    $('#signUp-alert').hide();
                }else{
                    $('#emplacement-alert').empty();
                    for (var i = 0; i < Object.keys(response).length; i++){
                        switch (Object.keys(response)[i]){
                            case 'user' :
                                $('#emplacement-alert').append("<div class='alert text-center'><p>" + response.user + "</p></div>");
                                $('#username').css("display", "table-cell");
                                break;
                            case 'email' :
                                $('#emplacement-alert').append("<div class='alert text-center'><p>" + response.email + "</p></div>");
                                $('#email').css("display", "table-cell");
                                break;
                            case 'password' :
                                $('#emplacement-alert').append("<div class='alert text-center'><p>" + response.password + "</p></div>");
                                $('#password').css("display", "table-cell");
                                break;
                        }
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

    $('#signup-link, #signin-link').on("click", function(){
        $('#emplacement-alert').empty();
        $("#login-alert").css('display', 'none');
        $('.validation ').css("display", "none");

    });
});