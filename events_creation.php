<?php
// connect to the database
require_once("db.php");

$message = $brothers = $events = "";

// Fetch brothers
$stmt = $conn->query("SELECT concat(first_name, ' ', last_name) as name, brother_id, alum_id FROM brother WHERE alum_id IS null");
foreach ($stmt as $row) { 
  $brothers .= "<option value={$row["brother_id"]}>{$row["name"]}</option>";
}

// Handle form submission
if (isset($_POST['submit'])) {
    $brother_id = $_POST['brother-id'];
    $event_type = $_POST['event-type'];
    $event_name = $_POST['event-name'];
    $event_date = $_POST['event-date'];
    $event_time = $_POST['event-time'];
    $event_location = $_POST['event-location'];

    try {
        // Begin transaction
        $conn->beginTransaction();
	  
	  // Insert into location table
        $insert_event = $conn->prepare("INSERT INTO location (name) VALUES (:event_location)");
        $insert_event->execute([':event_location' => $event_location]);
        $location_id = $conn->lastInsertId();

        // Insert into EVENT table
        $insert_event = $conn->prepare("INSERT INTO event (type, name) VALUES (:event_type, :event_name)");
        $insert_event->execute([':event_type' => $event_type, ':event_name' => $event_name]);
        $event_id = $conn->lastInsertId();

        // Insert into DOE table
        $datetime = $event_date . ' ' . $event_time;
        $insert_doe = $conn->prepare("INSERT INTO doe (event_id, DATETIME, location_id) VALUES (:event_id, :datetime, :event_location)");
        $insert_doe->execute([':event_id' => $event_id, ':datetime' => $datetime, ':event_location' => $location_id]);

        // Insert into HOST table
        $insert_host = $conn->prepare("INSERT INTO host (brother_id, event_id) VALUES (:brother_id, :event_id)");
        $insert_host->execute([':brother_id' => $brother_id, ':event_id' => $event_id]);

        // Commit transaction
        $conn->commit();

        $message = "Event created successfully!";
    } catch (Exception $e) {
        // Rollback transaction in case of error
        $conn->rollBack();
        $message = "Error: Could not execute queries. " . $e->getMessage();
    }
}
?>

<!DOCTYPE HTML>
<!--
 Spectral by HTML5 UP
 html5up.net | @ajlkn
 Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <title>Creighton Delta Chi</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="main_cal.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript" src="calendar.js"></script>
</head>
<body class="landing is-preload">

	<!-- Page Wrapper -->
	<div id="page-wrapper">

	  <!-- Header -->
	  <header id="header" class="alt">
		<h1><a href="home.php">Delta Chi</a></h1>
		<nav id="nav">
		  <ul>
			<li class="special">
			  <a href="#menu" class="menuToggle"><span>Menu</span></a>
			  <div id="menu">
				<ul>
				  <li><a href="home.php">Home</a></li>
				  <li><a href="about_us.php">About Us</a></li>
				  <li><a href="contact_us.php">Contact Us</a></li>
				  <li><a href="alumni_registration.php">Creighton Alumni Registration</a></li>
				  <li><a href="login.php">Login</a></li>
				  <li><a href="map.php">Map of Brothers</a></li>

				  <!-- 			hidden	   -->
				  <li><a href="brother_to_alum.php">Brother to Alum</a></li>
				  <li><a href="add_brother.php">Brother Addition</a></li>
				  <li><a href="add_alumni.php">Alumni Addition</a></li>
				  <li><a href="events_creation.php">Events Creation</a></li>
				  <li><a href="chair_management.php">Chair/Exec Management</a></li>


				</ul>
			  </div>
			</li>
		  </ul>
		</nav>
	  </header>

    <!-- One -->
    <section id="one" class="wrapper style1 special">
        <div class="inner">
            <header class="major">
                <div>
                    <h2>Events Creator</h2>
                    <p><b>This page serves as a way to insert events into the database.</b></p>
                </div>
                <div class="container">
                    <form method="post" class="mb-3">
                        <div class="form-group">
                            <label>Brother In Charge of Event: </label>
                            <select id="ajax-select" name="brother-id"><?php echo $brothers; ?></select>
                        </div>
                        <div class="form-group">
                            <label>Type of Event: </label>
                            <input class="form-control" type="text" name="event-type" placeholder="Type of event...">
                        </div>
                        <div class="form-group">
                            <label>Name of Event: </label>
                            <input class="form-control" type="text" name="event-name" placeholder="Name of event...">
                        </div>
                        <div class="form-group">
                            <label>Date of Event: </label>
                            <input class="form-control" type="date" name="event-date">
                        </div>
                        <div class="form-group">
                            <label>Time of Event: </label>
                            <input class="form-control" type="time" name="event-time">
                        </div>
                        <div class="form-group">
                            <label>Location of Event: </label>
                            <input class="form-control" type="text" name="event-location" placeholder="Location of event...">
                        </div>
                        <button class="btn btn-primary" name="submit">Submit</button>
                    </form>
                    <?php echo $message; ?>
                </div>
            </header>
        </div>
    </section>
<!-- Footer -->
	  <footer id="footer">
		<ul class="icons">
		  <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
		  <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
		  <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
		  <li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
		  <li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
		</ul>
		<ul class="copyright">
		  <li>© Untitled</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
		</ul>
	  </footer>

	</div>

	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.scrollex.min.js"></script>
	<script src="assets/js/jquery.scrolly.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>

  </body>
</html>