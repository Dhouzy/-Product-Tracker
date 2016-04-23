
function performSearch(searchForm){
    var searchQuery = $("input[type=text]", searchForm).val();
    window.location = "/home/" + encodeURIComponent(searchQuery);
}

function searchGoToPage(page){
    var strUrl = "/home/" + encodeURIComponent(searchQuery) + "/" + page;

    window.history.pushState({page: page}, "", strUrl);

    $.get(strUrl + "?tableOnly=true", function(data){
        $("#search-results-table-body").html(data);
    });
}