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
                } else {
                    window.alert("<?= __('SignIn.Failure') ?>");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

    $('#form-SignUp').submit(function (event) {
        event.preventDefault();

        var form = $(this).serialize();
        $.ajax({
            url: "/users/add",
            type: "post",
            data: form,
            success: function (response) {
                console.log(response);
                location.reload();
                $('#signUp-modal').modal('hide');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
});