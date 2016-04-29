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
            var searchInitialPage = <?= $page ?>;
            var searchQuery = "<?= addslashes($search) ?>";
        </script>
        <?= $this->element('search_pagination', ['page' => $page, 'maxPage' => $maxPage]); ?>
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
        <?= $this->element('search_pagination', ['page' => $page, 'maxPage' => $maxPage]); ?>
    <?php
    }
    ?>
</fieldset>
<?php endif; ?>
