<div>

    <div class="item-infos-btn container">
        <a href="#" class="btn red left">Go to product</a>
        <a href="#" class="btn red right">Unfolow</a>
    </div>

    <label>From : </label>
    <input type="text" id="fromDatepicker" />
    <label>To : </label>
    <input type="text" id="toDatepicker" />

    <div id="PriceGraph">
        <?php if((isset($graph1Data) && !empty($graph1Data)) || (isset($graph2Data) && !empty($graph2Data))) { ?>
            <input id="dataForProductPriceVariationChart" type="hidden" value='<?php echo json_encode($graph1Data); ?>' />
            <input id="dataForProductPriceDiscountVariationChart" type="hidden" value='<?php echo json_encode($graph2Data); ?>' />
            <div id="productPriceVariationChart"></div>
        <?php } else { ?>
            <label>No data</label>
        <?php } ?>
    </div>

</div>
