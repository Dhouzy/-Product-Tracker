<fieldset>
    <h1><b><?= $product->name ?></b></h1>
    <h4><?= $product->companyName ?></h4>
    <h5>Rating: <?= $product->rating ?></h5>
    <p>Description: <?= $product->description ?></p>
    <h3><b><?= $product->price . '$' ?></b></h3>
    <img src="<?= $product->imageLink ?>">
</fieldset>