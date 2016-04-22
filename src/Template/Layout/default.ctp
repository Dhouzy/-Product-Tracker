<?php $session = $this->request->session(); ?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= $this->Html->meta('icon') ?>

        <title>
            <?= $this->fetch('title') ?>
        </title>

        <?= $this->Html->css('bootstrap.min.css') ?>
        <?= $this->Html->css('app.css') ?>

    </head>
    <body>
        <!--Login Modal-->
        <?= $this->element('login_modal'); ?>
        <!--Sign Up Modal-->
        <?= $this->element('signup_modal'); ?>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button"
                            class="navbar-toggle collapsed"
                            data-toggle="collapse"
                            data-target="#collapsed-header"
                            aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></span> PRODUCT TRACKER',
                                          ['controller' => 'Homes', 'action' => 'home'],
                                          ['class' => 'navbar-brand', 'escape' => false]); ?>
                </div>

                <div class="collapse navbar-collapse" id="collapsed-header">
                    <ul class="nav navbar-nav navbar-right">
                        <?= !isset($doNotShowSearchBarInHeader) || !$doNotShowSearchBarInHeader ? $this->element('searchbar_header') : '' ?>
                        <li>
                            <?= $this->element('language_toggle'); ?>
                        </li>
                        <?= $session->check('Auth.User') ? $this->element('loggedin_header_opt') : $this->element('loggedout_header_opt') ?>
                    </ul>

                </div>
            </div>
        </nav>
        <?= $this->Flash->render() ?>
        <section class="container clearfix">
            <?= $this->fetch('content') ?>
        </section>
        <footer></footer>
        <?= $this->Html->script('jquery-1.12.3.min.js'); ?>
        <?= $this->Html->script('bootstrap.js'); ?>
        <?= $this->Html->script('notify.js') ?>
        <?= $this->Html->script('notify.min.js') ?>
        <?= $this->Html->script('Chart.js') ?>
        <?= $this->Html->script('tab.js') ?>
        <?= $this->Html->script('tooltip.js') ?>
        <?= $this->Html->script('graphic.js') ?>
        <?= $this->Html->script('profile.js') ?>
    </body>

    <script>
        $(document).ready(function () {
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
            })
        });
    </script>
</html>
