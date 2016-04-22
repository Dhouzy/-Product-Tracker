<div class="container">
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="login-form modal-content">
                <div class="modal-body">
                    <form class="form" id="form-login">
                        <div class="modal-header text-center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <p id="text">Login</p>
                        </div>
                        <div class="users-form">
                            <?= $this->Flash->render('auth') ?>
                            <?= $this->Form->create() ?>
                            <fieldset>
                                <?= $this->Form->text('username', ['placeholder' => __('Global.Username') . __('SignIn.OrEmail'), 'class' => 'flex-item']) ?>
                                <?= $this->Form->text('password', ['placeholder' => __('Global.Password'), 'class' => 'flex-item']) ?>
                            </fieldset>
                            <?= $this->Form->button(__('Global.SignIn'), ['class' => 'button-form']); ?>
                            <?= $this->Form->end() ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>