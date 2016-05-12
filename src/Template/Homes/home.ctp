<?php
    if (isset($tableOnly) && $tableOnly):
        $this->layout = false;
        echo $this->element('search_results_row', ['amazonItems' => $searchResult->amazonItems]);
    else:
        $loggedUser = $this->request->session()->read('Auth.User');
        if (isset($searchResult)) :
            $maxPage = min(5, $searchResult->numMaxPages); ?>
            <div class="form">
                <?= $this->element('searchbar') ?>
            </div>
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
            <?php
            echo $this->element('search_pagination', ['page' => $page, 'maxPage' => $maxPage]);

        else :
            $this->Html->script('home_carousel.js', ['block' => 'scriptBottom']);

            echo '<div class="home-carousel">';
            foreach ($products as $product) {
                echo '<div class="home-carousel-image">';
                echo $this->Html->image($product->image_link,
                                        ['url' => ['controller' => 'Products',
                                                   'action' => 'product',
                                                   'uid' => $product->article_uid]]);
                echo '</div>';
            }
            echo '</div>';
        endif;
    endif;
?>
