<fieldset>
    <h1><?= __('Home.Title') ?></h1>
    <div class="form">
        <?= $this->Form->create() ?>
        <legend><?= __('Global.Search') ?></legend>
        <?= $this->Form->input('search',['label'=>__('Global.Search')]) ?>
        <?= $this->Form->button(__('Global.Submit')); ?>
        <?= $this->Form->end() ?>
    </div>

    <?php
    if(isset($searchResult)) {
        ?>
        <table>
            <thead><tr><th>Name</th><th>Price</th><th>Rating</th><th>Resume</th></tr></thead>
            <tbody>
            <?php
            foreach ($searchResult->amazonItems as $item) {
                ?><tr><td><?= $item->title ?></td><td><?= $item->currentFormattedPrice ?></td><td></td><td><?= $item->description ?></td></tr><?php
            }
            ?>
            </tbody>
        </table>
        <?php
    }
    ?>

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

