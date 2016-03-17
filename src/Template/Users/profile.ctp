<h3><?= __('Profile.Title') ?></h3>
<h3><?= $user->first_name . "&nbsp" . $user->last_name ?></h3>
<h3><?= __('Profile.YourProducts') ?></h3>
<?php foreach ($user->products as $product) {
    echo $this->Html->link($product->name,
            ['controller' => 'Products', 'action' => 'product', '?' => ['uid' => $product->article_uid]]) . '<br>';
} ?>