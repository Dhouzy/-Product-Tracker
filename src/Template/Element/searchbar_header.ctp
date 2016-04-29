<li>
    <form onsubmit="performSearch(this); return false;" class="navbar-form navbar-left">
    <div class="input-group navbar-searchbar">
        <input type="text" placeholder="<?= __('Global.Search') ?>" class="form-control" />
        <span class="input-group-btn">
        <?= $this->Form->button('<span class="glyphicon glyphicon-search" aria-hidden="true"></span>',
                            ['type' => 'submit', 'class' => 'btn btn-default', 'escape' => false]); ?>
        </span>
    </div>
    </form>
</li>
