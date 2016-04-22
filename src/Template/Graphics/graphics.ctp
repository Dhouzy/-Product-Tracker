<div>

    <div class="item-infos-btn container">
        <a href="#" class="btn red left">Go to product</a>
        <a href="#" class="btn red right">Unfolow</a>
    </div>

    <label>From : </label>
    <input type="text" id="fromDatepicker" />
    <label>To : </label>
    <input type="text" id="toDatepicker" />

    <ul class="tab">
        <li><a href="#" id="tab-graph-1" class="tablinks" onclick="$(this).openTab(event, 'PriceGraph');event.preventDefault();event.stopPropagation();">Price graph</a></li>
        <li><a href="#" class="tablinks" onclick="$(this).openTab(event, 'RebatePriceGraph');event.preventDefault();event.stopPropagation();">Rebate price graph</a></li>
    </ul>

    <div id="PriceGraph" class="tabcontent">
        <?php if(isset($graph1Data) && !empty($graph1Data)) { ?>
            <input id="dataForProductPriceVariationChart" type="hidden" value='<?php echo json_encode($graph1Data); ?>' />
            <div id="productPriceVariationChart" width="400px" height="250px"></div>
        <?php } else { ?>
            <label>No data</label>
        <?php } ?>
    </div>

    <div id="RebatePriceGraph" class="tabcontent">
        <?php if(isset($graph2Data) && !empty($graph2Data)) { ?>
            <input id="dataForProductPriceDiscountVariationChart" type="hidden" value='<?php echo json_encode($graph2Data); ?>' />
            <div id="productPriceDiscountVariationChart" width="400px" height="250px"></div>
        <?php } else { ?>
            <label>No data</label>
        <?php } ?>
    </div>

</div>
