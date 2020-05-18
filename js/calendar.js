$(function() {
    root = '../../';
    var requests;

    $.ajax({
        type: 'get',
        url: `${root}php/app/FetchActinoRequests.php`,
        success: function(response) {
          requests = response;
          console.log(requests);
        }
    });
})