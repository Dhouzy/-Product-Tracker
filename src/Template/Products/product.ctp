<fieldset>
    <?php if ($this->request->session()->read('Auth.User')) {
        echo $this->Form->button(__('Product.Follow'));
    } ?>
    <h1><b><?= $item->name ?></b></h1>
</fieldset>