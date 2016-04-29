<nav class="search-pagination">
    <ul class="pagination">
        <?php

        echo "<li class='search-item-previous page-item " . ($page == 1 ? " disabled" : "").  "'>"
            . "<a class='page-link' href='#' onclick='searchGoToPreviousPage(); return false;'><span class='glyphicon glyphicon-triangle-left'></span></a></li>";

        for ($i = 1; $i <= $maxPage; $i++) {
            echo "<li class='search-item-page-$i page-item " . ($page == $i ? " disabled" : "") . "'>"
                . "<a class='page-link' href='#' onclick='searchGoToPage($i); return false;'>$i</a></li>";
        }

        echo "<li class='search-item-next page-item " . ($page == $maxPage ? " disabled" : "") . "'>"
            . "<a class='page-link' href='#' onclick='searchGoToNextPage(); return false;'><span class='glyphicon glyphicon-triangle-right'></span></a></li>";
        ?>
    </ul>
</nav>