<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/11/16
 * Time: 10:03 AM
 */
?>

<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>
    <?= $cakeDescription ?>
</title>
<?= $this->Html->meta('icon') ?>
<?= $this->Html->css('base_cake.css') ?>
<?= $this->Html->css('cake.css') ?>
<?= $this->Html->script('Chart') ?>
<?= $this->Html->script('graphic') ?>
</head>
<body class="home">

    <?php if(isset($graph1Data) && isset($graph2Data)) { ?>

        <div style="width: 80%; left: 10%; display: inline-block; position: absolute; text-align: center;">
            <label class="graphtitle">Product price variation over the time</label>
            <?php if(!empty($graph1Data)) { ?>
                <input id="dataForProductPriceVariationChart" type="hidden" value="<?php echo json_encode($graph1Data); ?>" />
                <canvas style="display: inline-block;" id="productPriceVariationChart" width="700" height="300"></canvas>
                <label class="graphXAxisTitle">Months</label>
            <?php } else { ?>
                <label>No data</label>
            <?php } ?>

            <label class="graphtitle">Product price discount variation over the time</label>
            <?php if(!empty($graph2Data)) { ?>
                <input id="dataForProductPriceDiscountVariationChart" type="hidden" value="<?php echo json_encode($graph2Data); ?>" />
                <canvas style="display: inline-block;" id="productPriceDiscountVariationChart" width="700"
                        height="300"></canvas>
                <label class="graphXAxisTitle">Months</label>
            <?php } else { ?>
                <label>No data</label>
            <?php } ?>
        </div>

    <?php } ?>

</body>
</html>
