<?php foreach ($amazonItems as $item): ?>
    <tr>
        <td class="search-image-cell">
            <?= $this->Html->link($this->Html->image($item->smallImageLink), [
                'controller' => 'Products',
                'action' => 'product',
                'uid' => $item->uid], ['escape' => false]);
            ?></td>
        <td class="search-link-cell">
            <?= $this->Html->link($item->name, [
                'controller' => 'Products',
                'action' => 'product',
                'uid' => $item->uid]);
            ?>
        </td>
        <td class="search-price-cell"><?= $item->currentFormattedPrice ?></td>
    </tr>
<?php endforeach; ?>