<div class="SearchBar">
    <?= $this->Form->create(null, [
        'url' => ['controller' => 'Homes', 'action' => 'home', 'search' => $this->Form->search, 'page' => 1]]) ?>
    <?= $this->Form->input("search"); ?>
    <?= $this->Form->button(__('Global.Search'), ['class'=>'btn']); ?>
    <?= $this->Form->end() ?>
</div>
