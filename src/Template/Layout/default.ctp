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
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.12.0.min.js"></script>

    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('graphic.css') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('signup.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
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
                echo '<li>' . $this->Html->link(
                        __('Global.SignIn'),
                        ['controller' => 'Users', 'action' => 'login']
                    ) . '</li>';
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
</body>
</html>
