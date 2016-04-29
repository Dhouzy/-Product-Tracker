<div>

    <div class="item-infos-btn center">
        <?php
        echo $this->Form->create(null, ['url' => ['controller' => 'Products', 'action' => 'product', 'uid' => $productId]]);
        echo $this->Form->button(__('Graph.GoToProduct'), ['class' => 'btn red']);
        echo $this->Form->end();
        ?>
    </div>

    <div id="DatePicker" class="center">
        <div class="row">
            <div class="col-lg-6">
                <div class="input-group">
                    <span class="input-group-addon"><?= __('Graph.From') ?></span>
                    <input type="text" id="FromDate" class="form-control"/>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <span class="input-group-addon"><?= __('Graph.To') ?></span>
                    <input type="text" id="ToDate" class="form-control"/>
                </div>
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

    </div>

    <!-- Translation for graphs data titles -->
    <input id="graph-title" type="hidden" value="<?= __('Graph.ProductPriceVariation') ?>">
    <input id="graph-yaxis-title" type="hidden" value="<?= __('Graph.PriceYAxisTitle') ?>">
    <input id="price-title" type="hidden" value="<?= __('Graph.Price') ?>">
    <input id="discount-price-title" type="hidden" value="<?= __('Graph.DiscountPrice') ?>">
