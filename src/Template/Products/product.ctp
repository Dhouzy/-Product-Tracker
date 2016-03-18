<fieldset>
    <?php if ($this->request->session()->read('Auth.User')) {
        echo $this->Form->create(null, ['url' => 'follow']);
        echo $this->Form->input(null, ['name' => 'uid', 'value' => "$item->uid", 'type' => 'hidden']);
        echo $this->Form->button(__('Product.Follow'));
        echo $this->Form->end();
    } ?>
    <h1><b><?= $product->name ?></b></h1>
    <img src="<?= $product->largeImageLink?>"/>
    <?php foreach ($product->prices as $price) {
        echo $price.'<br>';
    } ?>
</fieldset>