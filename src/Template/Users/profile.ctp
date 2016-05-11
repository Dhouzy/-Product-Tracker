<h2><?= $user->first_name . "&nbsp" . $user->last_name ?></h2>
<h3><?= __('Profile.YourProducts') ?></h3>

<div id="profile-data-container">
    <div id="products-list">
        <?php foreach ($user->products as $product) { ?>
           <div class="item hover">
                <a id="<?= $product->article_uid ?>" href="#"><?= $product->name ?></a>
                <div class="tooltip top-tooltip" style="width: 400px;">
                    <?php if(empty($product->image_link)) { ?>
                        <div style="display: inline-block"><img src="/img/no_image_available.png" width="110px" height="110px"/></div>
                    <?php } else { ?>
                        <div style="display: inline-block"><img src="<?= $product->image_link ?>" width="110px" height="140px"/></div>
                    <?php } ?>
                    <div style="display: inline-block; margin-left: 20px">
                        <div class="title-tooltip"><?= $product->name ?></div>
                        <div class="price-tooltip"><?= __('Profile.CurrentPrice') ?> $<?= $product->mostRecentPrice ?></div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div id="product-graph">
        <div id="NoItemClickContainer">
            <p id="NoItemClickText"><?= __('Profile.NeedToClickOnAProduct') ?></p>
        </div>
    </div>
</div>