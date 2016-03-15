<?= $this->Form->create(null, ['type' => 'get', 'class' => 'left', 'style' => 'width: 50%']) ?>
<input id="search" type="text" style="width: 100%" name="search" />
<?= $this->Form->button(__('Global.Search')); ?>
<?= $this->Form->end() ?>