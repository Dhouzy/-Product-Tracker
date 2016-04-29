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
                if(!response.userSaved){

                }else{
                    location.reload();
                    $('#signup-modal').modal('hide');
                }
                //console.log(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
});