<div class="SearchBar">
    <?= $this->Form->create(null, ['url' => ['controller' => 'Homes', 'action' => 'search']]) ?>
    <?= $this->Form->input('search', ['style' => 'width: 80%;']); ?>
    <?= $this->Form->button(__('Global.Search'), ['class' => 'btn red']); ?>
    <?= $this->Form->end() ?>
</div>
