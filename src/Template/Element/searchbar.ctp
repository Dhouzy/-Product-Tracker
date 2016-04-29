<form id="home-search-form" onsubmit="performSearch(this); return false;">
    <div class="input-group">
        <input type="text" placeholder="<?= __('Global.Search') ?>" class="form-control" />
        <span class="input-group-btn">
        <?= $this->Form->button('<span class="glyphicon glyphicon-search" aria-hidden="true"></span>',
            ['type' => 'submit', 'class' => 'btn btn-default', 'escape' => false]); ?>
        </span>
    </div>
</form>
<?php <<<'A'
<input type="text" placeholder="<?= __('Global.Search') ?>" class="form-control" />
<?= $this->Form->input(__('Global.Search'), [
    'type' => 'submit',
    'templates' => ['submitContainer' => '{{content}}'],
    'class' => 'btn red']);
A;
?>