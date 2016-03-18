<fieldset>
    <h1><?= __('Home.Title') ?></h1>
    <?php $loggedUser = $this->request->session()->read('Auth.User');
    if ($loggedUser != null) {
        echo '<p>' . __('Home.WhoIsLoggedIn', [$loggedUser['id'], $loggedUser['username'], $loggedUser['email']]) . '</p>';
    }
    ?>
    <div class="form">
        <legend><?= __('Global.Search') ?></legend>
        <?= $this->element('searchbar') ?>
    </div>

    <?php
    if (isset($searchResult)) {
        ?>
        <table>
            <thead>
            <tr>
                <th><?= __('Search.Table.Name') ?></th>
                <th><?= __('Search.Table.Price') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($searchResult->amazonItems as $item): ?>
                <tr>
                <td><a href="/product/<?= $item->uid ?>"><?= $item->name ?></a></td>
                <td><?= $item->currentFormattedPrice ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        $maxPage = min(10, $searchResult->numMaxPages);
        if ($currentPage == 1)
            echo "&lt;&lt;&nbsp;";
        else
            echo "<a href='?search=$searchKeywordsEncoded&p=" . ($currentPage - 1) . "'>&lt;&lt;</a>&nbsp;";

        for ($i = 1; $i <= $maxPage; $i++) {
            if ($currentPage == $i)
                echo "$i&nbsp;";
            else
                echo "<a href='?search=$searchKeywordsEncoded&p=$i'>$i</a>&nbsp;";
        }

        if ($currentPage == $maxPage)
            echo "&gt;&gt;&nbsp;";
        else
            echo "<a href='?search=$searchKeywordsEncoded&p=" . ($currentPage + 1) . "'>&gt;&gt;</a>&nbsp;";
    }
    ?>
</fieldset>

