<div>

    <div class="item-infos-btn container">
        <?php
            echo $this->Form->create(null, ['url' => ['controller' => 'Products', 'action' => 'product', 'uid' => $productId]]);
            echo $this->Form->button("Go to product", ['class' => 'btn red left']);
            echo $this->Form->end();
        ?>
        <?php
            echo $this->Form->create(null, ['url' => ['controller' => 'Products', 'action' => 'deleteFollowing', 'uid' => $productId]]);
            echo $this->Form->button("Unfolow", ['class' => 'btn red right']);
            echo $this->Form->end();
        ?>
    </div>

    <div id="DatePicker" class="center">
        <label id="LabelFromDatepicker">From : </label>
        <input type="text" id="FromDate" />
        <label id="LabelToDatepicker">To : </label>
        <input type="text" id="ToDate" />
    </div>

    <div id="PriceGraph">
        <?php if((isset($graph1Data) && !empty($graph1Data)) || (isset($graph2Data) && !empty($graph2Data))) { ?>
            <input id="DataForProductPriceVariationChart" type="hidden" value='<?php echo json_encode($graph1Data); ?>' />
            <input id="DataForProductPriceDiscountVariationChart" type="hidden" value='<?php echo json_encode($graph2Data); ?>' />
            <div id="ProductPriceVariationChart"></div>
        <?php } else { ?>
            <label>No data</label>
        <?php } ?>
    </div>

</div>
