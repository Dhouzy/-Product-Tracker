<fieldset>
    <h1><b><?= $product->name ?></b></h1>
    <h4><?= $product->company->name ?></h4>
    <h5><?= __('Product.Rating', $product->rating) ?></h5>
    <p><?= __('Product.Description', $product->description) ?></p>
    <h3><b><?= $product->price->price . '$' ?></b></h3>
    <img src="<?= $product->image_link ?>">
</fieldset>