<div class="users form">
    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('SignIn.FormTitle') ?></legend>
        <?= $this->Form->input('username', ['label' =>__('Global.Username').__('SignIn.OrEmail')]) ?>
        <?= $this->Form->input('password',['label' =>__('Global.Password')]) ?>
    </fieldset>
    <?= $this->Form->button(__('Global.SignIn')); ?>
    <?= $this->Form->end() ?>
</div>