<fieldset>
    <?php $loggedUser = $this->request->session()->read('Auth.User');
    if ($loggedUser != null) {
        echo '<p>' . __('Home.WhoIsLoggedIn', [$loggedUser['id'], $loggedUser['username'], $loggedUser['email']]) . '</p>';
    }
    ?>
    <div class="form">
        <?= $this->element('searchbar') ?>
    </div>

    <?php
    if (isset($searchResult)) {
        ?>
        <table>
            <thead>
            <tr>
                <th></th>
                <th><?= __('Search.Table.Name') ?></th>
                <th><?= __('Search.Table.Price') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($searchResult->amazonItems as $item): ?>
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
            </tbody>
        </table>
        <?php
        $maxPage = min(10, $searchResult->numMaxPages);
        if ($page == 1)
            echo "&lt;&lt;&nbsp;";
        else
            echo $this->Html->link('<< ', [
                'controller' => 'Homes',
                'action' => 'home',
                'search' => $search,
                'page' => $page - 1]);

        for ($i = 1; $i <= $maxPage; $i++) {
            if ($page == $i)
                echo "$i&nbsp;";
            else
                echo $this->Html->link("$i ", [
                    'controller' => 'Homes',
                    'action' => 'home',
                    'search' => $search,
                    'page' => $i]);
        }

        if ($page == $maxPage)
            echo "&gt;&gt;&nbsp;";
        else
            echo $this->Html->link(" >>", [
                'controller' => 'Homes',
                'action' => 'home',
                'search' => $search,
                'page' => $page + 1]);
    }
    ?>
</fieldset>

