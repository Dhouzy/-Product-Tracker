<li>
    <?= $this->Form->create(null, ['url' => ['controller' => 'Homes', 'action' => 'search'], 'class' => 'navbar-form navbar-left']) ?>
    <div class="input-group navbar-searchbar">
        <?= $this->Form->input('search',
                               ['label' => false,
                                'placeholder' => __('Global.Search'),
                                'class' => 'form-control',
                                'templates' => ['inputContainer' => '{{content}}']]); ?>
        <span class="input-group-btn">
    <?= $this->Form->button('<span class="glyphicon glyphicon-search" aria-hidden="true"></span>',
                            ['type' => 'submit', 'class' => 'btn btn-default', 'escape' => false]); ?>
    </span>
    </div>
    <?= $this->Form->end() ?>
</li>
