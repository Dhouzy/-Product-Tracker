<?php
if(isset($tableOnly) && $tableOnly):
    $this->layout = false;
    echo $this->element('search_results_row', ['amazonItems' => $searchResult->amazonItems]);
else:
?>
<fieldset>
    <?php $loggedUser = $this->request->session()->read('Auth.User');
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
        <table id="search-results-table">
            <thead>
            <tr>
                <th></th>
                <th><?= __('Search.Table.Name') ?></th>
                <th><?= __('Search.Table.Price') ?></th>
            </tr>
            </thead>
            <tbody>
            <?= $this->element('search_results_row', ['amazonItems' => $searchResult->amazonItems]) ?>
            </tbody>
        </table>
        <nav id="search-pagination">
            <ul class="pagination">
            <?php

            echo "<li id='search-item-previous' class='page-item " . ($page == 1 ? " disabled" : "").  "'>"
                . "<a class='page-link' href='#' onclick='searchGoToPreviousPage(); return false;'><span class='glyphicon glyphicon-triangle-left'></span></a></li>";

            for ($i = 1; $i <= $maxPage; $i++) {
                echo "<li id='search-item-page-$i' class='page-item " . ($page == $i ? " disabled" : "") . "'>"
                    . "<a class='page-link' href='#' onclick='searchGoToPage($i); return false;'>$i</a></li>";
            }

            echo "<li id='search-item-next' class='page-item " . ($page == $maxPage ? " disabled" : "") . "'>"
                . "<a class='page-link' href='#' onclick='searchGoToNextPage(); return false;'><span class='glyphicon glyphicon-triangle-right'></span></a></li>";
            ?>
            </ul>
        </nav>
    <?php
    }
    ?>
</fieldset>
<?php endif; ?>
