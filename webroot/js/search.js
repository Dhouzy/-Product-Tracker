
function performSearch(searchForm){
    var searchQuery = $("input[type=text]", searchForm).val();
    window.location = "/home/" + encodeURIComponent(searchQuery);
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
    searchCurrentPage = page;

    var strUrl = "/home/" + encodeURIComponent(searchQuery) + "/" + page;

    window.history.pushState({page: page}, "", strUrl);

    $.get(strUrl + "?tableOnly=true", function(data){
        $("#search-results-table-body").html(data);
    });

    $(".search-inactive-link").removeClass("search-inactive-link");
    $("#search-link-page-" + page).addClass("search-inactive-link");

    if(page == 1) {
        // Does not have previous page
        $("#search-link-previous").addClass("search-inactive-link");
    }

    if(page == searchMaxPage) {
        // Does not have last page
        $("#search-link-next").addClass("search-inactive-link");
    }
}