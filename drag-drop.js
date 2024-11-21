// sends the post request to submit the list
function dragDropUpdate() {

    // creates a blank array
    var list = [];

    // checks for elements that have a class of drag-drop-item
    $(".drag-drop-item").each(function() {

        // checks for list items in the right panel
        if ($(this).closest("div").attr("id") == "right-panel") {

            // adds each list item to the list array
            list.push($(this).attr("id"));
        }
    });

    // checks if no list items were added
    if (list.length === 0) {
        list = "";
    }

    // posts the variables using AJAX
    $.ajax({
        type: "POST",
        url: "ajax-drag-drop.php",
        data: {
            list: list,
            dragDropID: $("#drag-drop-id").val()
        },
        success: function(output) {
            $("#message").html(output);
        }

    });

    // disables the default behavior of the submit button
    return false;
}

// runs after the page is loaded
$(document).ready(function() {
    
    // checks if the drop-down selection changed
    $(document).on("change", "#drag-drop-id", function() {

        // sends the AJAX request
        $.ajax({
            // declares the method
            type: "POST",
            
            // specifies which page to post to
            url: "ajax-drag-drop.php",
            
            // declares the posted variables
            data: {
                
                // send the new value
                dragdrop: $("#drag-drop-id").val()
            },

            // runs after AJAX is complete
            success: function(output) {

                // changes the drag-drop element to include the input from the AJAX request
                $("#drag-drop").html(output);

                // allows drop functionality of drag-drop
                $("#left-list, #right-list").sortable({
                    connectWith: ".connectedSortable",
                    stop: function(event, ui) {
                        $(".connectedSortable").each(function() {
                            result = "";
                            $(this).find("li").each(function(){
                                result += $(this).text() + ",";
                            });
                            $("."+$(this).attr("id")+".list").html(result);
                        });
                    }
                });
            },

            // displays error messages if any
            error: function(xhr, textStatus, errorThrown) {
                console.error("HTTP Error: " + errorThrown + "\nError Message: " + textStatus + "\nError Text: " + xhr.responseText);
            }
        });
    });
});