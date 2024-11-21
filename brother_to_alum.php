<?php
// connect to the database
require_once("db.php");
$message = $brothers = "";

$stmt = $conn->query("SELECT concat(first_name, ' ', last_name) as name, brother_id, alum_id
FROM brother
WHERE alum_id IS null
ORDER by last_name");
foreach ($stmt as $row) { 
  $brothers .= "<option value={$row["brother_id"]}>{$row["name"]}</option>";
}
if (isset($_POST["submit"])) {
  $state = isset($_POST["state"]) ? $_POST["state"] : null;
  $query = "INSERT INTO ALUM (job_title, work_organization, current_city, current_state)
VALUES (?,?,?,?)";

  $stmt = $conn->prepare($query);
  $stmt->execute([ $_POST["city"], $state, $_POST["job"], $_POST["org"]]);
  //   get id of alum we inserted
  $alumID = $conn ->lastInsertId();

  //   update the brother to have the alum id
  $query = "
 UPDATE brother
  SET alum_id = ?
  WHERE brother_id = ?
  ";
  $stmt = $conn->prepare($query);
  $stmt->execute([ $alumID, $_POST["brother-id"]]);

  $message = "<div class='alert alert-success'> Brother has been changed to Alum status, Alum_ID: {$alumID}</div>";
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
				  <li><a href="remove_brother.php">Remove Brother</a></li>
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
			  <h2>Brother to Alumni</h2>
			  <p><b>This page serves as a way to easily make a brother into an alumni.</b></p>
			</div>


			<div class="container">
			  <form method="post" class="mb-3">
				<select name="brother-id" id="ajax-select"><option disabled selected>Select a brother...</option><?php echo $brothers; ?></select>

				<div>Current City:</div>
				<p class='font-weight-bold'><input placeholder='' type='text' name='city' required></p>
				<div>Current State:</div>
				<p class='font-weight-bold'> <select name="state" id="state">
				  <option disabled selected>Select a State...</option>
				  <option value="AL">Alabama</option>
				  <option value="AK">Alaska</option>
				  <option value="AZ">Arizona</option>
				  <option value="AR">Arkansas</option>
				  <option value="CA">California</option>
				  <option value="CO">Colorado</option>
				  <option value="CT">Connecticut</option>
				  <option value="DE">Delaware</option>
				  <option value="DC">District Of Columbia</option>
				  <option value="FL">Florida</option>
				  <option value="GA">Georgia</option>
				  <option value="HI">Hawaii</option>
				  <option value="ID">Idaho</option>
				  <option value="IL">Illinois</option>
				  <option value="IN">Indiana</option>
				  <option value="IA">Iowa</option>
				  <option value="KS">Kansas</option>
				  <option value="KY">Kentucky</option>
				  <option value="LA">Louisiana</option>
				  <option value="ME">Maine</option>
				  <option value="MD">Maryland</option>
				  <option value="MA">Massachusetts</option>
				  <option value="MI">Michigan</option>
				  <option value="MN">Minnesota</option>
				  <option value="MS">Mississippi</option>
				  <option value="MO">Missouri</option>
				  <option value="MT">Montana</option>
				  <option value="NE">Nebraska</option>
				  <option value="NV">Nevada</option>
				  <option value="NH">New Hampshire</option>
				  <option value="NJ">New Jersey</option>
				  <option value="NM">New Mexico</option>
				  <option value="NY">New York</option>
				  <option value="NC">North Carolina</option>
				  <option value="ND">North Dakota</option>
				  <option value="OH">Ohio</option>
				  <option value="OK">Oklahoma</option>
				  <option value="OR">Oregon</option>
				  <option value="PA">Pennsylvania</option>
				  <option value="RI">Rhode Island</option>
				  <option value="SC">South Carolina</option>
				  <option value="SD">South Dakota</option>
				  <option value="TN">Tennessee</option>
				  <option value="TX">Texas</option>
				  <option value="UT">Utah</option>
				  <option value="VT">Vermont</option>
				  <option value="VA">Virginia</option>
				  <option value="WA">Washington</option>
				  <option value="WV">West Virginia</option>
				  <option value="WI">Wisconsin</option>
				  <option value="WY">Wyoming</option>
				  </select></p>
				<div>Current Job Title:</div>
				<p class='font-weight-bold'><input placeholder='' type='text' name='job' ></p>
				<div>Current Organization They Are Working For:</div>
				<p class='font-weight-bold'><input placeholder='' type='text' name='org' ></p>

				<button name='submit' class="button-primary">Change</button>
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