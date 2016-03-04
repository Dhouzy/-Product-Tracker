<div class="users form">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('email') ?>
        <?= $this->Form->input('password') ?>
        <?= $this->Form->input('first_name') ?>
        <?= $this->Form->input('last_name') ?>
        <?= $this->Form->input('phone') ?>
        <?= $this->Form->input('street_number') ?>
        <?= $this->Form->input('street') ?>
        <?= $this->Form->input('city') ?>
        <?= $this->Form->input('province') ?>
        <?= $this->Form->input('country') ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')); ?>
    <?= $this->Form->end() ?>
</div>