<fieldset>
    <div class="users form">
        <?= $this->Form->create($user) ?>

        <legend><?= __('Global.SignUp') ?></legend>
        <?= $this->Form->input('username', ['label' => __('Global.Username')]) ?>
        <?= $this->Form->input('email', ['label' => __('Global.Email')]) ?>
        <?= $this->Form->input('password', ['label' => __('Global.Password')]) ?>
        <?= $this->Form->input('first_name', ['label' => __('Global.FirstName')]) ?>
        <?= $this->Form->input('last_name', ['label' => __('Global.LastName')]) ?>
        <?= $this->Form->input('phone', ['label' => __('Global.Phone')]) ?>
        <?= $this->Form->input('street_number', ['label' => __('Global.StreetNumber')]) ?>
        <?= $this->Form->input('street', ['label' => __('Global.Street')]) ?>
        <?= $this->Form->input('city', ['label' => __('Global.City')]) ?>
        <?= $this->Form->input('province', ['label' => __('Global.Province')]) ?>
        <?= $this->Form->input('country', ['label' => __('Global.Country')]) ?>

        <?= $this->Form->button(__('Global.Submit')); ?>
        <?= $this->Form->end() ?>
    </div>
</fieldset>