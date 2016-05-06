<div>

    <div class="item-infos-btn">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <?php echo $this->Html->link(
                __('Graph.GoToProduct'),
                array(
                'controller'=>'Products',
                'action'=>'product',
                $productId
                ), array('class'=>'btn red center', 'escape'=>false));
                ?>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>

    <div id="DatePicker">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-5">
                <div class="input-group">
                    <span class="input-group-addon"><?= __('Graph.From') ?></span>
                    <input type="text" id="FromDate" class="form-control"/>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="input-group">
                    <span class="input-group-addon"><?= __('Graph.To') ?></span>
                    <input type="text" id="ToDate" class="form-control"/>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>
    <div id="PriceGraph">
        <?php if ((isset($graph1Data) && !empty($graph1Data)) || (isset($graph2Data) && !empty($graph2Data))) { ?>
            <input id="DataForProductPriceVariationChart" type="hidden"
                   value='<?php echo json_encode($graph1Data); ?>'/>
            <input id="DataForProductPriceDiscountVariationChart" type="hidden"
                   value='<?php echo json_encode($graph2Data); ?>'/>
            <div id="ProductPriceVariationChart"></div>
        <?php } else { ?>
            <label>No data</label>
        <?php } ?>
    </div>



    <!-- Translation for graphs data titles -->
    <input id="graph-title" type="hidden" value="<?= __('Graph.ProductPriceVariation') ?>">
    <input id="graph-yaxis-title" type="hidden" value="<?= __('Graph.PriceYAxisTitle') ?>">
    <input id="price-title" type="hidden" value="<?= __('Graph.Price') ?>">
    <input id="discount-price-title" type="hidden" value="<?= __('Graph.DiscountPrice') ?>">

    <!-- Translation for the dates in highcharts -->
    <input id="highcharts-months" type="hidden" value="<?= __('Highcharts.Months') ?>">
    <input id="highcharts-short-months" type="hidden" value="<?= __('Highcharts.ShortMonths') ?>">
    <input id="highcharts-days" type="hidden" value="<?= __('Highcharts.Days') ?>">
    <input id="highcharts-decimal-point" type="hidden" value="<?= __('Highcharts.DecimalPoint') ?>">
    <input id="highcharts-date-format" type="hidden" value="<?= __('Highcharts.DateFormat') ?>">

    <!-- Translation for the datepickers -->
    <input id="datepicker-months" type="hidden" value="<?= __('Datepicker.Months') ?>">
    <input id="datepicker-days-min" type="hidden" value="<?= __('Datepicker.DaysMin') ?>">


