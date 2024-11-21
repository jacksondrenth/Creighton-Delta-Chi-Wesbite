<?php
// connect to the database
require_once("db.php");
$message = $options = $brothers = "";

$stmt = $conn->query("Select concat(first_name, ' ', last_name) as name, brother_id
from brother
order by last_name");
foreach ($stmt as $row) { 
  $brothers .= "<option value={$row["brother_id"]}>{$row["name"]}</option>";
}

// Check if the form is submitted
if (isset($_POST["submit"])) {
  // Get the form data
  $brotherId = $_POST["brother-id"];
  $firstName = $_POST["first-name"];
  $lastName = $_POST["last-name"];
  $class = $_POST["class"];
  $city = $_POST["city"];
  $state = $_POST["state"];
  $gradYear = $_POST["grad-year"];
  $phone = $_POST["phone"];
  $email = $_POST["email"];
  $photo = $_POST["photo"];

  // Update the brother's information in the database
  $query = "UPDATE BROTHER SET 
               first_name = ?,
               last_name = ?,
               class = ?,
               city = ?,
               state = ?,
               graduation_year = ?,
               phone = ?,
               email = ?,
               photo = ?
             WHERE brother_id = ?";
  $stmt = $conn->prepare($query);
  $result = $stmt->execute([$firstName, $lastName, $class, $city, $state, $gradYear, $phone, $email, $photo, $brotherId]);

  if ($result) {
	echo "<div class='alert alert-success'>Successfully updated the brother <b>$firstName $lastName</b>.</div>";
	echo "<script>console.log('Update successful');</script>";
  } else {
	echo "<div class='alert alert-danger'>Error updating the brother.</div>";
	// Debug: Get the specific error message
	echo "Error: " . $stmt->errorInfo()[2];
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
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script type="text/javascript" src="update-ajax.js"></script>
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
				  <li><a href="update_brother_alum.php">Update Brothers</a></li>



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
			  <h2>Update Brother or Alum</h2>
			</div>

<form id='update-form' method='post'>
			<select name="brother-id" id="ajax-select"><option disabled selected>Select a brother...</option><?php echo $brothers; ?></select>
			<div id="ajax-content"></div>
  </form>
			<?php echo $message; ?>







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