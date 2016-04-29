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
                    $("#login-alert").show();
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
                if(response.userSaved){
                    location.reload();
                    $('#signUp-alert').hide();
                }else{
                    console.log(response.userSavedMsg);
                    $("#signUp-alert").show();

                    if (response.userSavedMsg.user != null){
                        console.log(response.userSavedMsg.user);
                    }
                    var test = Object.keys(response.userSavedMsg);
                    for (var i = 0; i < Object.keys(response.userSavedMsg).length; i++){
                        switch (Object.keys(response.userSavedMsg)[i]){
                            case 'user' :
                                $('#signUp-alert').append("<p>" + response.userSavedMsg.user + "</p>");
                                break;
                        }
                    }
                }
                //console.log(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
});