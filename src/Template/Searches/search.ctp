<div class="search form">
    <?= $this->Form->search() ?>
<fieldset>
    <legend><?= __('Add User') ?></legend>
    <?= $this->Form->input('search') ?>
</fieldset>
<?= $this->Form->button(__('Go')); ?>
<?= $this->Form->end() ?>
</div>