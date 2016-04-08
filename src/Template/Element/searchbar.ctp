<div class="SearchBar form-inline">
    <?= $this->Form->create(null, ['type' => 'get', 'url' => '/']) ?>
    <input id="search" type="text" class="form-control" style="width: 75%" name="search" />
    <?= $this->Form->button(__('Global.Search'), ['class'=>'btn']); ?>
    <?= $this->Form->end() ?>
</div>
<?= $this->Form->create(null, ['url' => ['controller' => 'Homes', 'action' => 'search']]) ?>
<?= $this->Form->input('search', ['label' => false, 'placeholder' => __('Global.Search'), 'templates' => ['inputContainer' => '{{content}}']]); ?>
<?= $this->Form->input(__('Global.Search'), ['type' => 'submit', 'templates' => ['submitContainer' => '{{content}}'], 'class' => 'btn red']); ?>
<?= $this->Form->end(["div" => false]) ?>
