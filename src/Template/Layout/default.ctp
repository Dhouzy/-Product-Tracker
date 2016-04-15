<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
$session = $this->request->session();
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>

    <?= $this->Html->script('notify.js')?>
    <?= $this->Html->script('notify.min.js')?>


    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('graphic.css') ?>
    <?= $this->Html->css('app.css') ?>
    <?= $this->Html->css('signup.css') ?>
    <?= $this->Html->script('tooltip.js') ?>
    <?= $this->Html->script('profile.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>

<div class="container">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="login modal-content">
                <div class="modal-body">
                    <form class="form" id="form-login">
                        <div class="modal-header text-center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <p id="text">Login</p>
                        </div>
                        <div class="users form">
                            <?= $this->Flash->render('auth') ?>
                            <?= $this->Form->create(null, ['id' => 'test']) ?>
                            <fieldset>
                                <!--                                <legend>--><?//= __('SignIn.FormTitle') ?><!--</legend>-->
                                <?= $this->Form->input('username', ['label' =>__('Global.Username').__('SignIn.OrEmail'), 'class' => 'inputLogin', 'id' => 'username']) ?>
                                <?= $this->Form->input('password',['label' =>__('Global.Password'), 'class' => 'inputLogin', 'id' => 'username']) ?>
                            </fieldset>
                            <?= $this->Form->button(__('Global.SignIn'), ['id' => 'login-button']); ?>
                            <?= $this->Form->end() ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>


<nav class="top-bar expanded " data-topbar role="navigation">
    <section class="header navbar navbar-default ">
        <div class="left">
            <h3>
                <?= $this->Html->link('PRODUCT TRACKER', ['controller' => 'Homes', 'action' => 'home']); ?>
            </h3>
        </div>

        <ul class="buttons-header nav navbar-nav ">
            <?php
            if ($session->read('Config.language') == 'fr')
                $switchLanguage = 'en';
            else
                $switchLanguage = 'fr';
            ?>
            <li><a href="/lang?l=<?= $switchLanguage ?>&fromUrl=<?=
                urlencode($this->request->here) ?>"><?= strtoupper($switchLanguage) ?></a></li>
            <?php
            if (!$session->check('Auth.User')) {
                ?><li><a data-toggle="modal" data-target="#myModal">
                <?php echo __('Global.SignIn') ?>
                </a></li>
                <?php
                echo '<li>' . $this->Html->link(
                        __('Global.SignUp'),
                        ['controller' => 'Users', 'action' => 'add']
                    ) . '</li>';
            } else {
                echo '<li>' . $this->Html->link(
                        __('Profile.Title'),
                        ['controller' => 'Users', 'action' => 'profile']) . '</li>';
                echo '<li>' . $this->Html->link(
                        __('Global.SignOut'),
                        ['controller' => 'Users', 'action' => 'logout']
                    ) . '</li>';
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
    </section>
</nav>
<?= $this->Flash->render() ?>
<section class="container clearfix">
    <?= $this->fetch('content') ?>
</section>
<footer>
</footer>
<?= $this->Html->script('http://code.jquery.com/jquery-1.12.0.min.js'); ?>
<?= $this->Html->script('bootstrap.js'); ?>
</body>

<script>
    $( document ).ready(function() {

        $('#form-login').submit(function(event){
            event.preventDefault();

            var form = $(this).serialize();
            $.ajax({
                url: "/users/login",
                type: "post",
                data: form,
                success: function (response) {
                    console.log(response);
                    location.reload();
                    $('#myModal').modal('hide');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
    });
</script>
</html>
