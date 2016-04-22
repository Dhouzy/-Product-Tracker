<div class="container">
    <div class="modal fade" id="signUp-modal" tabindex="-1" role="dialog" aria-labelledby="modalLoginLabel">
        <div class="modal-dialog" role="document">
            <?= $this->Flash->render() ?>
            <div class="signup-form modal-content">
                <div class="modal-body">
                    <form class="form" id="form-SignUp">
                        <div class="modal-header text-center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <p id="text">Login</p>
                        </div>
                        <div class="users form">
                            <?= $this->Flash->render('auth') ?>
                            <?= $this->Form->create() ?>
                            <fieldset>
                                <?= $this->Form->text('username', ['placeholder' => __('Global.Username'), 'class' => 'flex-item']) ?>
                                <?= $this->Form->email('email', ['placeholder' => __('Global.Email'), 'class' => 'flex-item']) ?>
                                <?= $this->Form->password('password', ['placeholder' => __('Global.Password'), 'class' => 'flex-item']) ?>
                                <?= $this->Form->text('first_name', ['placeholder' => __('Global.FirstName'), 'class' => 'flex-item']) ?>
                                <?= $this->Form->text('last_name', ['placeholder' => __('Global.LastName'), 'class' => 'flex-item']) ?>
                                <?= $this->Form->text('phone', ['placeholder' => __('Global.Phone'), 'class' => 'flex-item']) ?>
                                <?= $this->Form->text('street_number', ['placeholder' => __('Global.StreetNumber'), 'class' => 'flex-item']) ?>
                                <?= $this->Form->text('street', ['placeholder' => __('Global.Street'), 'class' => 'flex-item']) ?>
                                <?= $this->Form->text('city', ['placeholder' => __('Global.City'), 'class' => 'flex-item']) ?>
                                <?= $this->Form->text('province', ['placeholder' => __('Global.Province'), 'class' => 'flex-item']) ?>
                                <?= $this->Form->text('country', ['placeholder' => __('Global.Country'), 'class' => 'flex-item']) ?>
                            </fieldset>
                            <?= $this->Form->button(__('Global.SignIn'), ['class' => 'button-form']); ?>
                            <?= $this->Form->end() ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>