<div class="modal fade" id="login-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form id="form-login">
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><span class="fa fa-fw fa-user"></span></span>
                        <input name="username"
                               type="text"
                               class="form-control"
                               placeholder="<?= __('Global.Username') . __('SignIn.OrEmail') ?>">
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon  fa-fw"><span class="fa fa-fw fa-unlock"></span></span>
                        <input name="password" type="password" class="form-control"
                               placeholder="<?= __('Global.Password') ?>">
                    </div>
                    <button class="btn btn-default" type="submit">
                        <span class="fa fa-fw fa-check"></span><?=__('Global.SignIn')?>
                    </button>
                </form>
                <div id="login-alert" class="alert not-visible">
                    <p><span class="fa fa-fw fa-exclamation-triangle"></span><?= __('Flash.BadLogin') ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
