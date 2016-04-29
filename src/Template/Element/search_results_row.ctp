<?php foreach ($amazonItems as $item): ?>
    <tr>
        <td class="search-image-cell"><img src="<?= $item->smallImageLink ?>"></td>
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