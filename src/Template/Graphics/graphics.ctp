<div style="width: 80%; left: 10%; display: inline-block; position: absolute; text-align: center;">

    <ul class="tab">
        <li><a href="#" class="tablinks" onclick="$(this).openTab(event, 'PriceGraph')">Price graph</a></li>
        <li><a href="#" class="tablinks" onclick="$(this).openTab(event, 'RebatePriceGraph')">Rebate price graph</a></li>
    </ul>

    <div id="PriceGraph" class="tabcontent">
        <label class="graphtitle">Product price variation over the time</label>
        <?php if(isset($graph1Data) && !empty($graph1Data)) { ?>
            <input id="dataForProductPriceVariationChart" type="hidden" value='<?php echo json_encode($graph1Data); ?>' />
            <canvas style="display: inline-block;" id="productPriceVariationChart" width="700" height="300"></canvas>
            <label class="graphXAxisTitle">Months</label>
        <?php } else { ?>
            <label>No data</label>
        <?php } ?>
    </div>

    <div id="RebatePriceGraph" class="tabcontent">
        <label class="graphtitle">Product price discount variation over the time</label>
        <?php if(isset($graph2Data) && !empty($graph2Data)) { ?>
            <input id="dataForProductPriceDiscountVariationChart" type="hidden" value='<?php echo json_encode($graph2Data); ?>' />
            <canvas style="display: inline-block;" id="productPriceDiscountVariationChart" width="700"
                    height="300"></canvas>
            <label class="graphXAxisTitle">Months</label>
        <?php } else { ?>
            <label>No data</label>
        <?php } ?>
    </div>

</div>
