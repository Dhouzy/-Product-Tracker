<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= $this->Html->meta('icon') ?>

        <title>
            <?= $this->fetch('title') ?>
        </title>

    <?= $this->Html->css('jquery-ui.min.css') ?>
    <?= $this->Html->css('jquery-ui.structure.min.css') ?>
    <?= $this->Html->css('jquery-ui.theme.min.css') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('app.css') ?>
    <?= $this->Html->css('product.css')?>

    </head>
    <body>
        <!--Login Modal-->
        <?= $this->element('login_modal'); ?>
        <!--Sign Up Modal-->
        <?= $this->element('signup_modal'); ?>
        <!--Header navbar-->
        <?= $this->element('navbar'); ?>


        <?= $this->Flash->render() ?>
        <section class="container clearfix">
            <?= $this->fetch('content') ?>
        </section>

        <footer class="footer">
            <div class="container">
                <p><?=__('Footer.Text')?></p>
            </div>
        </footer>
        <?= $this->Html->script('jquery-1.12.3.min.js'); ?>
        <?= $this->Html->script('bootstrap.js'); ?>
        <?= $this->Html->script('bootstrap.min.js'); ?>
        <?= $this->Html->script('notify.js') ?>
        <?= $this->Html->script('notify.min.js') ?>
        <?= $this->Html->script('highcharts.js') ?>
        <?= $this->Html->script('moment.js') ?>
        <?= $this->Html->script('jquery-ui.min.js') ?>
        <?= $this->Html->script('tab.js') ?>
        <?= $this->Html->script('tooltip.js') ?>
        <?= $this->Html->script('graphic.js') ?>
        <?= $this->Html->script('profile.js') ?>
        <?= $this->Html->script('product.js')?>
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
