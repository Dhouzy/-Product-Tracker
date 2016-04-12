<fieldset>
    <div class="users form signup_form">
        <?= $this->Form->create($user) ?>

        <legend><?= __('Global.SignUp') ?></legend>

        <div class="flex-container">
            <?= $this->Form->text('username', ['placeholder' => __('Global.Username'), 'class' => 'flex-item']) ?>
            <?= $this->Form->email('email', ['placeholder' => __('Global.Email'),'class' => 'flex-item']) ?>
            <?= $this->Form->password('password', ['placeholder' => __('Global.Password'),'class' => 'flex-item']) ?>
            <?= $this->Form->text('first_name', ['placeholder' => __('Global.FirstName'),'class' => 'flex-item']) ?>
            <?= $this->Form->text('last_name', ['placeholder' => __('Global.LastName'),'class' => 'flex-item']) ?>
            <?= $this->Form->text('phone', ['placeholder' => __('Global.Phone'),'class' => 'flex-item']) ?>
            <?= $this->Form->text('street_number', ['placeholder' => __('Global.StreetNumber'),'class' => 'flex-item']) ?>
            <?= $this->Form->text('street', ['placeholder' => __('Global.Street'),'class' => 'flex-item']) ?>
            <?= $this->Form->text('city', ['placeholder' => __('Global.City'),'class' => 'flex-item']) ?>
            <?= $this->Form->text('province', ['placeholder' => __('Global.Province'),'class' => 'flex-item']) ?>
            <?= $this->Form->text('country', ['placeholder' => __('Global.Country'),'class' => 'flex-item']) ?>
        </div>
        <?= $this->Form->button(__('Global.Submit'), ['class' => 'btn red']); ?>
        <?= $this->Form->end() ?>
    </div>
</fieldset>