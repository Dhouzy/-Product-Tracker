<form onsubmit="performSearch(this); return false;">
    <input type="text" placeholder="<?= __('Global.Search') ?>" class="form-control" />
<?= $this->Form->input(__('Global.Search'), [
    'type' => 'submit',
    'templates' => ['submitContainer' => '{{content}}'],
    'class' => 'btn red']); ?>
</form>