<h3><?= $user->first_name . "&nbsp" . $user->last_name ?></h3>
<h3><?= __('Profile.YourProducts') ?></h3>
<div id="products-list" class="item-list">
    <?php foreach ($user->products as $product) { ?>
       <div class="item hover">
            <a id="<?= $product->article_uid ?>" href="#"><?= $product->name ?></a>
            <div class="tooltip top-tooltip">
                <div><img src="<?= $product->image_link ?>" width="20%" height="20%"/></div>
            </div>
        </div>
    <?php } ?>
</div>
<div id="product-graph">

</div>