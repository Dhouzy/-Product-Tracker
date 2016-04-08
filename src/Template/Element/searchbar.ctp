<?= $this->Form->create(null, ['url' => ['controller' => 'Homes', 'action' => 'search']]) ?>
<?= $this->Form->input('search', ['label' => false, 'placeholder' => __('Global.Search'), 'templates' => ['inputContainer' => '{{content}}']]); ?>
<?= $this->Form->input(__('Global.Search'), ['type' => 'submit', 'templates' => ['submitContainer' => '{{content}}'], 'class' => 'btn red']); ?>
<?= $this->Form->end(["div" => false]) ?>
