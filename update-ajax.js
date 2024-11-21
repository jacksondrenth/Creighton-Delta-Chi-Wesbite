// checks whether a drop-down with the ID of ajax-select was changed
$(document).on("change", "#ajax-select", function(e) {

    // grabs the chosen value of the drop-down with the ID of empID
    var ajaxID = $(this).val();

    // calls a php page called ajax.php using an AJAX request and the selected value as part of the POST request
    // the output from the call to the other page is then stored in the div as mentioned above
    $.ajax({
        type: "POST",       // this tells what type of ajax call (method) is used
        url: "update-ajax.php",    // this should be the URL of the ajax file
        data: {
            ajaxID: ajaxID  // this is one of the elements passed to the next page
            /* You can add additional parameters by adding a comma after each line except the last:
            val1: "additional value 1",
            val2: "additional value 2" */
        },

        // on a successful ajax request, return what PHP echoes and store it in the variable called output
        success: function(output) {

            // put the output inside the ajax-content div
            $("#ajax-content").html(output);
        },

        // if you want to capture errors you can do the following
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " "+ thrownError);
        }
    });
});
