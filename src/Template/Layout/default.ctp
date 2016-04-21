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

        <header class="header navbar navbar-default ">
            <div class="left">
                <h3>
                    <?= $this->Html->link('PRODUCT TRACKER', ['controller' => 'Homes', 'action' => 'home']); ?>
                </h3>
            </div>

            <ul class="buttons-header nav navbar-nav ">
                
                <li>
                    <?= $this->element('language_toggle'); ?>
                </li>
                <?php
                    if (!$session->check('Auth.User')) {
                        ?>
                        <li>
                            <a data-toggle="modal" data-target="#login-modal">
                                <?php echo __('Global.SignIn') ?>
                            </a>
                        </li>

                        <li>
                            <a data-toggle="modal" data-target="#signUp-modal">
                                <?php echo __('Global.SignUp') ?>
                            </a>
                        </li>
                        <?php
                    }
                    else {
                        echo '<li>' . $this->Html->link(__('Profile.Title'), ['controller' => 'Users', 'action' => 'profile']) . '</li>';
                        echo '<li>' . $this->Html->link(__('Global.SignOut'), ['controller' => 'Users', 'action' => 'logout']) . '</li>';
                    }
                ?>
            </ul>
            <div class="middle">
                <?php
                    if (!isset($doNotShowSearchBarInHeader) || !$doNotShowSearchBarInHeader) {
                        echo $this->element('searchbar');
                    }
                ?>
            </div>
        </header>
        <?= $this->Flash->render() ?>
        <section class="container clearfix">
            <?= $this->fetch('content') ?>
        </section>
        <footer>
            <section class="bo">
                <div>text</div>
            </section>
        </footer>
        <?= $this->Html->script('jquery-1.12.3.min.js'); ?>
        <?= $this->Html->script('notify.js') ?>
        <?= $this->Html->script('notify.min.js') ?>
        <?= $this->Html->script('bootstrap.js'); ?>
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
                    url: "/users/login",
                    type: "post",
                    data: form,
                    success: function (response) {
                        console.log(response);
                        location.reload();
                        $('#login-modal').modal('hide');
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
