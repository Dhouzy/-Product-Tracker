<div class="SearchBar">
    <?= $this->Form->create(null, ['type' => 'get', 'url' => '/']) ?>
    <input id="search" type="text" style="width: 80%" name="search" />
    <?= $this->Form->button(__('Global.Search'), ['class'=>'btn']); ?>
    <?= $this->Form->end() ?>
</div>
