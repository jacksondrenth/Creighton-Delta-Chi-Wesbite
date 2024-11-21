<?php
/* This function gets a calendar. */
function getCalendar($conn, $year = "", $month = "") {

    // sets the default variables
    $dates = "";
    $dateYear = ($year != "") ? $year : date("Y"); // stores the passed in year or current year
    $dateMonth = ($month != "") ? $month : date("m"); // stores the passed in month or current month
    $date = $dateYear . "-" . $dateMonth . "-01"; // sets the date to the first day of the specified month and year
    $startDay = date("N", strtotime($date)); // sets the starting day of the week for the first day of the month
    $totalDays = cal_days_in_month(CAL_GREGORIAN, $dateMonth, $dateYear); // sets the total days of the specified month and year
    $startBoxes = ($startDay == 7) ? ($totalDays) : ($totalDays + $startDay); // sets the total number of calendar boxes including empty beginning boxes
    $allBoxes = ($startBoxes <= 35) ? 35 : 42; // sets the total number of calendar boxes including empty ending boxes
    $dayCount = 1; // starts the day count at 1

    // loops through the total number of calendar date boxes including empty ones
    for($i = 1; $i <= $allBoxes; $i++) {

        // checks if the calendar boxes should have a date
        if(($i >= $startDay + 1 || $startDay == 7) && $i <= ($startBoxes)) {

            // sets the current date and sets the blank date class
            $currentDate = $dateYear . "-" . $dateMonth . "-" . $dayCount;
            $dateClass = "";

            // prepare the query to get the events of the current date and sets the event count (datetime columns must be cast as a date)
            $query =
            "SELECT e.name as event_name
            FROM event e
			INNER JOIN doe d using(event_id)
            WHERE Cast(DATE(d.DATETIME) AS date) = ?"; // WHERE Cast(event_date AS date) = ?";

            $stmt = $conn->prepare($query);

            // execute the query and store the results
            $stmt->execute([$currentDate]);

            // gets the total number of events
            $eventCount = $stmt->rowCount();

            // checks if one or more events were returned
            if ($eventCount > 0) {

                // sets the date class and total events
                $dateClass = (strtotime($currentDate) == strtotime(date("Y-m-d"))) ? "bg-success text-white" : $dateClass = "bg-primary text-white";
                $s = $eventCount > 1 ? "s" : "";
                $total = "<div class='total-events'>{$eventCount} Event{$s}</div>";

            // checks if the date is today
            } else if (strtotime($currentDate) == strtotime(date("Y-m-d"))) {

                // sets the date class and total events
                $dateClass = "calendar-today";
                $total = "<div class='total-events'>Today</div>";

            // sets the total events to blank for all other dates
            } else {
                $total = "";
            }


            // adds each date to the date variable and increases the count
            $dates .= "<li date='{$currentDate}' class='{$dateClass} calendar-date'><span>{$dayCount}</span>{$total}</li>";
            $dayCount++;

        // sets empty boxes if the calendar box doesn't have a date
        } else {
            $dates .= "<li class='no-date'><span></span></li>";
        }
    }

    // creates a variable that stores the calendar nav bar for moving back a month, changing the month, changing the year, or moving forward a month; then it displays the days and dates on the calendar
    $calendar =

    "<div class='calendar'>
        <span class='d-inline-block'>
            <div class='calendar-nav input-group'>
                <div class='input-group-prepend'><button id='" . date("m", strtotime($date . " - 1 Month")) . "-" . date("Y", strtotime($date . " - 1 Month")) . "' class='previous-month button primary'><i class='fas fa-chevron-left' style='color:#000000'></i></button></div>
                <span><select id='calendar-month' style='height: 45px; border-radius: 3px;'>" . getMonths($dateMonth) . "</select></span>
                <span><select id='calendar-year' style='height: 45px; width: 70px; border-radius: 3px;'>" . getYears($dateYear) . "</select></span>
                <div class='input-group-append'><button id='" . date("m", strtotime($date . " + 1 Month")) . "-" . date("Y", strtotime($date . " + 1 Month")) . "' class='next-month button primary' style='color:#000000'><i class='fas fa-chevron-right'></i></button></div>
            </div>
        </span>
        <hr class='mb-3'>
        <div class='calendar-days'>
            <ul>
            <li>Sun</li>
                <li>Mon</li>
                <li>Tue</li>
                <li>Wed</li>
                <li>Thu</li>
                <li>Fri</li>
                <li>Sat</li>
            </ul>
        </div>
        <div class='calendar-dates'>
            <ul>{$dates}</ul>
        </div>
        <div id='event-list'></div>
        <div class='clear'></div>
    </div>";
    return $calendar;
}

/* This function gets a list of years */
function getYears($year = "") {

    // sets the default options variable
    $options = "";

    // gets the years between today's year plus or minus 5 years
    for ($i = date("Y") - 5; $i <= date("Y") + 5; $i++) {

        // checks for the selected year and returns each year
        $selected = ($i == $year) ? "selected" : "";
        $options .= "<option value='{$i}' {$selected}>{$i}</option>";
    }
    return $options;
}

/* This function gets a list of months. */
function getMonths($month = "") {

    // sets the default options variable
    $options = "";

    // loops through the 12 months
    for ($i = 1; $i <= 12; $i++) {

        // checks for the selected month and returns each month
        $selected = ($i == $month) ? "selected" : "";
        $options .= "<option value='{$i}' {$selected}>" . date("F", mktime(0, 0, 0, $i + 1, 0, 0)) . "</option>";
    }
    return $options;
}

/* This function returns events by date. */
function getCalendarEvents($conn, $date = ""){

    // sets the default variables
    $events = "";

    // gets the passed date or today's date
    $date = $date ? date("Y-m-d", strtotime($date)) : date("Y-m-d");

    // prepare the query to get the events of the selected or current date (datetime columns must be cast as a date)
    $query =
    "SELECT e.event_id, e.name as event_name, l.name as location, TIME(d.DATETIME) as event_time, e.type
    FROM event e
	INNER JOIN DOE d using(event_id)
	INNER JOIN location l using(location_id)
	WHERE Cast(DATE(d.DATETIME) AS date) = ?"; // WHERE Cast(event_date AS date) = ?";

    $stmt = $conn->prepare($query);

    // execute the query and store the results
    $stmt->execute([$date]);

    // checks if one or more rows is returned
    if ($stmt->rowCount() > 0) {

    // loops through all the records and adds each event as a list item
    foreach ($stmt as $row) {
        $events .=
        "<tr>
            <td>{$row["event_name"]}</td>
			<td>{$row["type"]}</td>
            <td>{$row["location"]}</td>
            <td>{$row["event_time"]}</td>
        </tr>";
    }

    // displays existing events
    echo
    "<legend>Events on " . date("l, d M Y", strtotime($date)) . "</legend>
    <table class='table table-striped table-bordered'>
        <thead>
            <tr>
                <th>Title</th>
				<th>Type</th>
                <th>Location</th>
                <th>Time</th>
            </tr>
        </thead>
        {$events}
    </table>";
    }
}
?>