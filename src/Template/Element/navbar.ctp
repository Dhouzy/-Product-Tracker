<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button"
                    class="navbar-toggle collapsed"
                    data-toggle="collapse"
                    data-target="#collapsed-header"
                    aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?= $this->Html->link('<span class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></span> PRODUCT TRACKER',
                                  ['controller' => 'Homes', 'action' => 'home'],
                                  ['class' => 'navbar-brand', 'escape' => false]); ?>
        </div>

        <div class="collapse navbar-collapse" id="collapsed-header">
            <ul class="nav navbar-nav navbar-right">
                <?= !isset($doNotShowSearchBarInHeader) || !$doNotShowSearchBarInHeader ? $this->element('searchbar_header') : '' ?>
                <li>
                    <?= $this->element('language_toggle'); ?>
                </li>
                <?php $session = $this->request->session(); ?>
                <?= $session->check('Auth.User')
                    ? $this->element('loggedin_header_opt', ['username' => $this->request->session()->read('Auth.User')['username']])
                    : $this->element('loggedout_header_opt') ?>
            </ul>

        </div>
    </div>
</nav>