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
        <?= $this->Html->css('font-awesome.min.css') ?>
        <?= $this->Html->css('app.css') ?>

        <script type="application/javascript">
            <?= $this->element('js_global_strings'); ?>
        </script>

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
            <?=__('Footer.Text')?>
        </footer>
        <!--Load librairies first-->
        <?= $this->Html->script('jquery-1.12.3.min.js'); ?>
        <?= $this->Html->script('bootstrap.min.js'); ?>
        <?= $this->Html->script('jquery-ui.min.js') ?>
        <?= $this->Html->script('highcharts.js') ?>
        <?= $this->Html->script('notify.min.js') ?>

        <!--Custom stuff-->
        <?= $this->Html->script('navbar_modal.js'); ?>
        <?= $this->Html->script('moment.js') ?>
        <?= $this->Html->script('search.js') ?>
        <?= $this->Html->script('tooltip.js') ?>
        <?= $this->Html->script('graphic.js') ?>
        <?= $this->Html->script('profile.js') ?>
        <?= $this->Html->script('product.js') ?>
    </body>
</html>
