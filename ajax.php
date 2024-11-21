<?php
// require both the database connection and the functions page
require_once("db.php");
require_once("functions.php");

// checks if the func variable was posted
if (isset($_POST["func"])){

    // checks the value of the func variable to determine which function should be called
    switch($_POST["func"]) {
        case "getCalendar": echo getCalendar($conn, $_POST["year"], $_POST["month"]); break; // reloads the calendar
        case "getCalendarEvents": echo getCalendarEvents($conn, $_POST["date"]); break; // loads the calendar events
        default: break; // exits the switch for all other cases
    }
}
?>