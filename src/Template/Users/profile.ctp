<h2><?= $user->first_name . "&nbsp" . $user->last_name ?></h2>
<h3><?= __('Profile.YourProducts') ?></h3>
<div id="products-list" class="item-list block">
    <?php foreach ($user->products as $product) { ?>
       <div class="item hover">
            <a id="<?= $product->article_uid ?>" href="#"><?= $product->name ?></a>
            <div class="tooltip top-tooltip">
                <div style="display: inline-block"><img src="<?= $product->image_link ?>"/></div>
                <div style="display: inline-block">
                    <div style="display: block"><?= $product->name ?></div>
                    <div style="display: block">Current price</div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<div id="product-graph" class="block">

</div>