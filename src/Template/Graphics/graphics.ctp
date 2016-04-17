<div>

    <div class="item-infos-btn container">
        <a href="#" class="btn red left">Go to product</a>
        <a href="#" class="btn red right">Unfolow</a>
    </div>

    <ul class="tab">
        <li><a href="#" id="tab-graph-1" class="tablinks" onclick="$(this).openTab(event, 'PriceGraph');event.preventDefault();event.stopPropagation();">Price graph</a></li>
        <li><a href="#" class="tablinks" onclick="$(this).openTab(event, 'RebatePriceGraph');event.preventDefault();event.stopPropagation();">Rebate price graph</a></li>
    </ul>

    <div id="PriceGraph" class="tabcontent">
        <label class="graphtitle">Product price variation over the time</label>
        <?php if(isset($graph1Data) && !empty($graph1Data)) { ?>
            <input id="dataForProductPriceVariationChart" type="hidden" value='<?php echo json_encode($graph1Data); ?>' />
            <canvas style="display: inline; margin-left: 10px;" id="productPriceVariationChart" width="500px" height="350px"></canvas>
            <label style="display: inline; margin-top: 5px;" class="graphXAxisTitle">Months</label>
        <?php } else { ?>
            <label>No data</label>
        <?php } ?>
    </div>

    <div id="RebatePriceGraph" class="tabcontent">
        <label class="graphtitle">Product price discount variation over the time</label>
        <?php if(isset($graph2Data) && !empty($graph2Data)) { ?>
            <input id="dataForProductPriceDiscountVariationChart" type="hidden" value='<?php echo json_encode($graph2Data); ?>' />
            <canvas style="display: inline-block;" id="productPriceDiscountVariationChart" width="500px" height="350px"></canvas>
            <label class="graphXAxisTitle">Months</label>
        <?php } else { ?>
            <label>No data</label>
        <?php } ?>
    </div>

</div>
