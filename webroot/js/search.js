
window.onpopstate = function(event){
    searchGoToPage(event.state.page);
}

function performSearch(searchForm){
    var searchQuery = $("input[type=text]", searchForm).val();
    window.location = "/?q=" + encodeURIComponent(searchQuery);
}

function searchGoToPreviousPage(){
    if(searchCurrentPage > 1)
        searchGoToPage(searchCurrentPage - 1);
}

function searchGoToNextPage(){
    if(searchCurrentPage < searchMaxPage)
        searchGoToPage(searchCurrentPage + 1);
}

function searchGoToPage(page){
    if(page == searchCurrentPage)
        return;

    searchCurrentPage = page;

    var strUrl = "/?q=" + encodeURIComponent(searchQuery) + "&p=" + page;

    window.history.pushState({page: page}, "", strUrl);

    $.get(strUrl + "&tableOnly=true", function(data){
        $("#search-results-table tbody").html(data);
    });

    $(".search-pagination .disabled").removeClass("disabled");
    $(".search-item-page-" + page).addClass("disabled");

    if(page == 1) {
        // Does not have previous page
        $(".search-item-previous").addClass("disabled");
    }

    if(page == searchMaxPage) {
        // Does not have last page
        $(".search-item-next").addClass("disabled");
    }
}