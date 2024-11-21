// checks if the calendar year is changed and reloads the calendar
$(document).on("change", "#calendar-year", function() {
    getCalendar("calendar", $("#calendar-year").val(), $("#calendar-month").val());
});

// checks if the calendar month is changed and reloads the calendar
$(document).on("change", "#calendar-month", function() {
    getCalendar("calendar", $("#calendar-year").val(), $("#calendar-month").val());
});

// checks if the previous or next calendar month button is clicked
$(document).on("click", ".previous-month, .next-month", function() {
    var month = $(this).attr("id").split("-")[0];
    var year = $(this).attr("id").split("-")[1];
    getCalendar("calendar", year, month);
});

// checks if a calendar date is clicked and opens the events or add event dialog
$(document).on("click", ".calendar-date", function() {
    $("#event-list").html("<div id='ajaxloader'></div>");
    date = $(this).attr("date");
    $.ajax({
    type:"POST",
    url:"ajax.php",
    data: {
        func: "getCalendarEvents",
        date: date,
    },
    success:function(html){
        $("#event-list").html(html);
    }
    });
});

// calls an ajax function to load/reload the calendar based on the pass year and month
function getCalendar(targetDiv, year, month) {
    $.ajax({
        type:"POST",
        url:"ajax.php",
        data: {
            func: "getCalendar",
            year: year,
            month: month
        },
        success: function(html) {
            $("#" + targetDiv).html(html);
        }
    });
}