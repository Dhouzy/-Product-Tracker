<div class="SearchBar form-inline">
    <?= $this->Form->create(null, ['type' => 'get', 'url' => '/']) ?>
    <input id="search" type="text" class="form-control" style="width: 75%" name="search" />
    <?= $this->Form->button(__('Global.Search'), ['class'=>'btn']); ?>
    <?= $this->Form->end() ?>
</div>
