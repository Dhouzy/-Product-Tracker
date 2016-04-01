<fieldset>
    <?php if ($this->request->session()->read('Auth.User')) {
        echo $this->Form->create(null, ['url' => 'follow']);
        echo $this->Form->input(null, ['name' => 'uid', 'value' => "$product->article_uid", 'type' => 'hidden']);
        echo $this->Form->button(__('Product.Follow'), ['class' => 'btn red']);
        echo $this->Form->end();
    } ?>
    <h1><b><?= $product->name ?></b></h1>
    <img src="<?= $product->largeImageLink?>"/>
    <?php foreach ($product->prices as $price) {
        echo $price->price.'<br>';
    } ?>
    <img src="<?= $item->largeImageLink?>"/><br/>
    <?php
    if($item->reviewUrl != null)
        echo "<iframe src=\"$item->reviewUrl\"></iframe><br/>";

    if($item->brand != null)
        echo __('Product.Brand', $item->brand) . '<br/>';

    if($item->color != null)
        echo __('Product.Color', $item->color) . '<br/>';

    if($item->size != null) {
        echo __('Product.Size', $item->size);

        if($item->sizeFromDimensions)
            echo '&nbsp;' . __('Product.Size.Unit');

        echo '<br/>';
    }

    if($item->size != null)
        echo __('Product.Weight', $item->weight) . '&nbsp;' . __('Product.Weight.Unit') . '<br/>';
    ?>
</fieldset>