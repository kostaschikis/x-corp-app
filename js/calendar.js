$(function() {
    root = '../../';
    let actinoRequests = {};

    $.ajax({
        type: 'get',
        url: `${root}php/app/FetchActinoRequests.php`,
        dataType: "json",
        success: function(response) {
          actinoRequests = response;
        }
    })
    .done(function() {
      console.log(actinoRequests);
      // Insert code to fill calendar here...
    })
})