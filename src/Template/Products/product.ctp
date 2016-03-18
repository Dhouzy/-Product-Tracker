<fieldset>
    <?php if ($this->request->session()->read('Auth.User')) {
        echo $this->Form->button(__('Product.Follow'));
    } ?>
    <h1><b><?= $product->name ?></b></h1>
    <?php foreach ($product->prices as $price) {
        echo $price.'<br>';
    } ?>
</fieldset>