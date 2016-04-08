<fieldset>
    <?php if ($isUserLoggedIn && !$isItemFollowed) {
        echo $this->Form->create(null, ['url' => 'follow']);
        echo $this->Form->input(null, ['name' => 'uid', 'value' => "$product->article_uid", 'type' => 'hidden']);
        echo $this->Form->button(__('Product.Follow'), ['class' => 'btn red']);
        echo $this->Form->end();
    } ?>
    <h1><b><?= $product->name ?></b></h1>
    <img src="<?= $product->largeImageLink?>"/>
    <?php
    foreach ($product->prices as $price) {
        echo $price->price.'<br>';
    }

    if($item->amazonUrl != null){
        echo "<a href=\"$item->amazonUrl\"><img src=\"$item->largeImageLink\"/></a><br/>";
    }
    if($item->reviewUrl != null)
        echo "<iframe src=\"$item->reviewUrl\"></iframe><br/>";

    if($item->brand != null)
        echo __('Product.Brand', $item->brand) . '<br/>';

    if($item->color != null)
        echo __('Product.Color', $item->color) . '<br/>';

    if($item->length != null && $item->width != null && $item->height != null)
        echo __('Product.Size', $item->length, $item->width, $item->height) . '<br/>';

    if($item->weight != null)
        echo __('Product.Weight', $item->weight) . '<br/>';
    ?>
</fieldset>