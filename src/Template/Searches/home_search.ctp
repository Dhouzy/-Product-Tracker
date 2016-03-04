<div class="form">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Search') ?></legend>
        <?= $this->Form->input('search') ?>
        <?= $this->Form->button(__('Go')); ?>
    </fieldset>
    <?= $this->Form->end() ?>
</div>