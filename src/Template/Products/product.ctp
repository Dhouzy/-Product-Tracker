<fieldset>
    <?php if ($isUserLoggedIn){
        if(!$isItemFollowed){
            echo $this->Form->create(null, ['url' => 'follow']);
            echo $this->Form->input(null, ['name' => 'uid', 'value' => "$product->article_uid", 'type' => 'hidden']);
            echo $this->Form->button(__('Product.Follow'), ['class' => 'btn red']);
            echo $this->Form->end();
        }
        else {
            echo $this->Form->create(null, ['url' => 'delete']);
            echo $this->Form->input(null, ['name' => 'id', 'value' => "$product->id", 'type' => 'hidden']);
            echo $this->Form->button(__('Product.Delete'),['class' => 'btn red']);
            echo $this->Form->end();
        }
    }
    ?>
    <h1><b><?= $product->name ?></b></h1>
    <?php
    foreach ($product->prices as $price){
        echo $this->Html->para(null, __('Product.Price',$price->id, $price->date, $price->price, $price->rebate_price));
    }

    if($product->amazon_url != null){
        echo "<a href=\"$product->amazon_url\"><img src=\"$product->image_link\"/></a><br/>";
    }
    if($product->review_url != null)
        echo "<iframe src=\"$product->review_url\"></iframe><br/>";

    if($product->brand != null)
        echo __('Product.Brand', $product->brand) . '<br/>';

    if($product->color != null)
        echo __('Product.Color', $product->color) . '<br/>';

    if($product->lengthmm != null && $product->widthmm != null && $product->heightmm != null)
        echo __('Product.Size', $product->lengthmm, $product->widthmm, $product->heightmm) . '<br/>';

    if($product->weightmm != null)
        echo __('Product.Weight', $product->weightmm) . '<br/>';
    ?>
</fieldset>