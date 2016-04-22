<?php foreach ($amazonItems as $item): ?>
    <tr>
        <td><img src="<?= $item->smallImageLink ?>"></td>
        <td>
            <?= $this->Html->link($item->name, [
                'controller' => 'Products',
                'action' => 'product',
                'uid' => $item->uid]);
            ?>
        </td>
        <td><?= $item->currentFormattedPrice ?></td>
    </tr>
<?php endforeach; ?>