<fieldset>
    <?php if ($this->request->session()->read('Auth.User')) {
        echo $this->Form->create(null, ['url' => 'follow']);
        echo $this->Form->input(null, ['name' => 'uid', 'value' => "$item->uid", 'type' => 'hidden']);
        echo $this->Form->button(__('Product.Follow'));
        echo $this->Form->end();
    } ?>
    <h1><b><?= $item->name ?></b></h1>
    <img src="<?= $item->largeImageLink?>"/><br/>
    <?php
    if($item->reviewUrl != null)
        echo "<iframe src=\"$item->reviewUrl\"></iframe><br/>";

    if($item->description != null)
        echo __('Product.Description', $item->description) . '<br/>';

    if($item->brand != null)
        echo __('Product.Brand', $item->brand) . '<br/>';

    if($item->color != null)
        echo __('Product.Color', $item->color) . '<br/>';

    if($item->size != null)
        echo __('Product.size', $item->size) . '<br/>';
    ?>
</fieldset>