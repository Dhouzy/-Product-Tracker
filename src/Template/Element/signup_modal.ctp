<div class="modal fade" id="signup-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p><?= __('Global.SignUp') ?></p>
            </div>
            <div class="modal-body">
                <form id="form-signup">
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><span class="fa fa-fw fa-user"></span></span>
                        <?= $this->Form->text('username', ['placeholder' => __('Global.Username'), 'class' => 'form-control']) ?>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><span class="fa fa-fw fa-envelope"></span></span>
                        <?= $this->Form->email('email', ['placeholder' => __('Global.Email'), 'class' => 'form-control']) ?>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><span class="fa fa-fw fa-key"></span></span>
                        <?= $this->Form->password('password', ['placeholder' => __('Global.Password'), 'class' => 'form-control']) ?>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><span class="fa fa-fw fa-user"></span></span>
                        <?= $this->Form->text('first_name', ['placeholder' => __('Global.FirstName'), 'class' => 'form-control']) ?>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><span class="fa fa-fw fa-user"></span></span>
                        <?= $this->Form->text('last_name', ['placeholder' => __('Global.LastName'), 'class' => 'form-control']) ?>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><span class="fa fa-fw fa-phone"></span></span>
                        <?= $this->Form->text('phone', ['placeholder' => __('Global.Phone'), 'class' => 'form-control']) ?>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><span class="fa fa-fw fa-map-marker"></span></span>
                        <?= $this->Form->text('street_number', ['placeholder' => __('Global.StreetNumber'), 'class' => 'form-control']) ?>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><span class="fa fa-fw fa-map-marker"></span></span>
                        <?= $this->Form->text('street', ['placeholder' => __('Global.Street'), 'class' => 'form-control']) ?>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><span class="fa fa-fw fa-map-signs"></span></span>
                        <?= $this->Form->text('city', ['placeholder' => __('Global.City'), 'class' => 'form-control']) ?>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><span class="fa fa-fw fa-map"></span></span>
                        <?= $this->Form->text('province', ['placeholder' => __('Global.Province'), 'class' => 'form-control']) ?>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><span class="fa fa-fw fa-map"></span></span>
                        <?= $this->Form->text('country', ['placeholder' => __('Global.Country'), 'class' => 'form-control']) ?>
                    </div>
                    <button type="submit" class="btn btn-default">
                        <span class="fa fa-fw fa-check"></span><?=__('Global.SignUp')?>
                    </button>
                </form>
<!--                <div id="login-alert" class="alert text-center">-->
<!--                    <p><span class="fa fa-fw fa-exclamation-triangle"></span>Votre identifiant et/ou votre mot de passe-->
<!--                        est faux.</p>-->
<!--                </div>-->

                <div id="signUp-alert" class="alert alert-danger" style="display: none; text-align: center">
                    <!--                <p>--><?//=__('Login.Error')?><!--</p>-->
                    <p><span class="fa fa-fw fa-exclamation-triangle"></span></p>
                </div>

            </div>
        </div>
    </div>
</div>
