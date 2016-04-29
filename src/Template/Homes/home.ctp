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
        $maxPage = min(5, $searchResult->numMaxPages);
        ?>
        <script>
            var searchMaxPage = <?= $maxPage ?>;
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

        echo "<a id='search-link-previous' " . ($page == 1 ? "class='search-inactive-link' " : "")
            . "href='#' onclick='searchGoToPreviousPage(); return false;'>&lt;&lt;</a>";

        for ($i = 1; $i <= $maxPage; $i++) {
            echo "<a id='search-link-page-$i' " . ($page == $i ? "class='search-inactive-link' " : "")
                . "href='#' onclick='searchGoToPage($i); return false;'>$i</a>";
        }

        echo "<a id='search-link-next' " . ($page == $maxPage ? "class='search-inactive-link' " : "")
                . "href='#' onclick='searchGoToNextPage(); return false;'>&gt;&gt;</a>";
    }
    ?>
</fieldset>
<?php endif; ?>
