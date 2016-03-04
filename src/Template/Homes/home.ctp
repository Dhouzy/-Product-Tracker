<fieldset>
    <h1>Home</h1>
    <div class="form">
        <?= $this->Form->create() ?>
        <legend><?= __('Search') ?></legend>
        <?= $this->Form->input('search') ?>
        <?= $this->Form->button(__('Go')); ?>
        <?= $this->Form->end() ?>
    </div>
    <?php $session = $this->request->session()->read('Auth.User'); ?>
    <p>User logged in:<br><?= '<b>Id:</b>'.$session['id'].'<br><b>Username:</b>'.$session['username'].'<br><b>email:</b>'.$session['email'] ?></p>

    <?php
    if ($session == null) {
        echo $this->Html->link(
            'login',
            ['controller' => 'Users', 'action' => 'login'],
            ['class' => 'button']
        );
        echo $this->Html->link(
            'sign up',
            ['controller' => 'Users', 'action' => 'add'],
            ['class' => 'button']
        );
    } else {
        echo $this->Html->link(
            'logout',
            ['controller' => 'Users', 'action' => 'logout'],
            ['class' => 'button']
        );
    }
    ?>
</fieldset>



