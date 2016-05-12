<script>
    var productUid = "<?= $product->article_uid ?>";
</script>
<?php $this->Html->script('product.js', ['block' => 'scriptBottom']); ?>
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
                <li role="presentation" class="active"><a href="#chart" data-toggle="tab"><?= __('Product.Chart') ?></a></li>
                <li role="presentation"><a href="#info" data-toggle="tab"><?= __('Product.Info') ?></a></li>
                <li role="presentation"><a href="#iframe" data-toggle="tab"><?= __('Product.AmazonReviews') ?></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active"  id="chart">

                </div>
                <div class="tab-pane fade"  id="info">
                    <table>
                    <?php
                    if($product->brand != null)
                        echo '<tr><td>' . __('Product.Brand') . '</td><td>' . $product->brand . '</td></tr>';

                    if($product->color != null)
                        echo '<tr><td>' .  __('Product.Color') . '</td><td>' . $product->color . '</td></tr>';

                    if($product->lengthmm != null && $product->widthmm != null && $product->heightmm != null)
                        echo '<tr><td>' .  __('Product.Size') . '</td><td>' . $product->lengthmm ." mm x " . $product->widthmm ." mm x ". $product->heightmm . " mm". '</td></tr>';

                    if($product->weightmm != null)
                        echo '<tr><td>' .  __('Product.Weight', $product->weightmm) . '</td><td>' . $product->weighmm . '</td></tr>';
                    ?>
                    </table>
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
