<script>
    var productUid = "<?= $product->article_uid ?>";
</script>
<fieldset>
    <div id="top-button-bar">
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
        ?>
        <form method="post" action="<?= $product->amazon_url?>" target="_blank"></>
        <?php
        if($product->amazon_url) {
            echo $this->Form->button(__('Product.BuyThisProduct'), ['class' => 'btn red']);
        }
        echo $this->Form->end();
    }
    ?>
    </div>
    <h3><?= $product->name ?></h3>
    <div id="main-product-container">
        <?php
        if($product->amazon_url != null && $product->image_link != null){
            echo "<a id='productImageLink' href=\"$product->amazon_url\"><img id=\"productImage\" src=\"$product->image_link\"/></a><br/>";
        }
        else {
            echo '<img id="productImage" src="/img/no_image_available.png" /><br/>';
        }
        ?>

        <div id="tab-container">
            <ul id="tabs" class="nav nav-tabs">
                <li role="presentation" class="active"><a href="#chart" data-toggle="tab"><?= __('Product.Chart')?></a></li>
                <li role="presentation"><a href="#info" data-toggle="tab"><?= __('Product.Info')?></a></li>
                <li role="presentation"><a href="#iframe" data-toggle="tab">Amazon rate</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active"  id="chart">

                </div>
                <div class="tab-pane fade"  id="info">
                    <?php
                    if($product->brand != null)
                        echo __('Product.Brand', $product->brand) . '<br/>';

                    if($product->color != null)
                        echo __('Product.Color', $product->color) . '<br/>';

                    if($product->lengthmm != null && $product->widthmm != null && $product->heightmm != null)
                        echo __('Product.Size', $product->lengthmm, $product->widthmm, $product->heightmm) . '<br/>';

                    if($product->weightmm != null)
                        echo __('Product.Weight', $product->weightmm) . '<br/>';
                    ?>
                </div>
                <div class="tab-pane fade" id="iframe">
                    <?php
                    if($product->review_url != null)
                        echo "<iframe id=\"productIframe\" src=\"$product->review_url\"></iframe><br/>";
                    ?>
                </div>
            </div>
        </div>
    </div>

</fieldset>
