<?php
if(isset($tableOnly) && $tableOnly):
    $this->layout = false;
    echo $this->element('search_results_row', ['amazonItems' => $searchResult->amazonItems]);
else:
?>
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
        <script>
            var searchMaxPage = <?= min(10, $searchResult->numMaxPages) ?>;
            var searchCurrentPage = <?= $page ?>;
            var searchQuery = "<?= addslashes($search) ?>";
        </script>
        <table>
            <thead>
            <tr>
                <th></th>
                <th><?= __('Search.Table.Name') ?></th>
                <th><?= __('Search.Table.Price') ?></th>
            </tr>
            </thead>
            <tbody id="search-results-table-body">
            <?= $this->element('search_results_row', ['amazonItems' => $searchResult->amazonItems]) ?>
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
<?php endif; ?>
