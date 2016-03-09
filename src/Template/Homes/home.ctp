<fieldset>
    <h1><?= __('Home.Title') ?></h1>
    <div class="form">
        <?= $this->Form->create(null, ['url' => ['controller' => 'Searches', 'action' => 'search']]) ?>
        <legend><?= __('Global.Search') ?></legend>
        <?= $this->Form->input('search',['label'=>__('Global.Search')]) ?>
        <?= $this->Form->button(__('Global.Submit')); ?>
        <?= $this->Form->end() ?>
    </div>
    <?php $session = $this->request->session()->read('Auth.User'); ?>

    <?php
    if ($session == null) {
    echo $this->Html->link(
            __('Global.SignIn'),
            ['controller' => 'Users', 'action' => 'login'],
            ['class' => 'button']
        );
        echo $this->Html->link(
            __('Global.SignUp'),
            ['controller' => 'Users', 'action' => 'add'],
            ['class' => 'button']
        );
    } else {
        echo '<p>'.__('Home.WhoIsLoggedIn',[$session['id'],$session['username'],$session['email']]).'</p>';
        echo $this->Html->link(
            __('Global.SignOut'),
            ['controller' => 'Users', 'action' => 'logout'],
            ['class' => 'button']
        );
    }
    ?>
</fieldset>



