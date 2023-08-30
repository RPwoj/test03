$( window ).on( "load", function() {
    if('#gogo') {

        $('#gogo').on('click', function() {
            
            $.ajax({
                type: "GET",
                url: "/get-data", // This should match the route path
                data: {
                    targetUserID: $('#gogo').attr('user-id')
                },
                success: function(response) {
                    // Handle the response from the server
                    // You can update your HTML with the received data
                    console.log(response)
                },
                error: function(error) {
                    console.error("AJAX request error:", error);
                }
            });
        })
    }
  } );