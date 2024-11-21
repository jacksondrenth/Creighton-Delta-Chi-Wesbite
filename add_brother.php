<?php
// connect to the database
require_once("db.php");
$message = $update = "";

// Array of Greek letters
$greekLetters = array(
  'Alpha', 'Beta', 'Gamma', 'Delta', 'Epsilon', 'Zeta', 'Eta', 'Theta',
  'Iota', 'Kappa', 'Lambda', 'Mu', 'Nu', 'Xi', 'Omicron', 'Pi',
  'Rho', 'Sigma', 'Tau', 'Upsilon', 'Phi', 'Chi', 'Psi', 'Omega'
);

// Array to store the combined list
$combinedList = array();

// Add Greek letters in order to the combined list
foreach ($greekLetters as $letter) {
  $combinedList[] = $letter;
}

// Add extra set combining each letter with every other letter to the combined list
foreach ($greekLetters as $letter1) {
  foreach ($greekLetters as $letter2) {
	$combinedList[] = $letter1 . ' ' . $letter2;
  }
}
if (isset($_POST["submit"])) {

  // File upload handling
  $uploadDir = 'uploads/'; // Make sure this directory exists and is writable
  $photoPath = null;

  if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
	$fileName = basename($_FILES["photo"]["name"]);
	$targetFilePath = $uploadDir . $fileName;
	$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

	// Allow certain file formats
	$allowTypes = array('jpg', 'png', 'jpeg', 'gif');
	if (in_array($fileType, $allowTypes)) {
	  // Upload file to server
	  if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
		$photoPath = $targetFilePath;
	  } else {
		$message .= "<div class='alert alert-danger'>Sorry, there was an error uploading your file.</div>";
	  }
	} else {
	  $message .= "<div class='alert alert-danger'>Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.</div>";
	}
  }

  $phone = $_POST["phone"];
  if (empty($phone)) {
	$phone = null; // Set phone to null if it's empty
  }
  $class = isset($_POST["class"]) ? $_POST["class"] : null;
  $grad_year = isset($_POST["grad-year"]) ? $_POST["grad-year"] : null;
  $state = isset($_POST["state"]) ? $_POST["state"] : null;

  $query = "SELECT first_name, last_name
  FROM brother
  where first_name = ? and last_name = ?";
  $stmt = $conn->prepare($query);
  $stmt->execute([ $_POST["first-name"], $_POST["last-name"]]);
  //   check if exists
  if ($stmt->rowCount() > 0) {
	$message .= "<div class='alert alert-danger'> Brother <b>{$_POST["first-name"]} {$_POST["last-name"]}</b> is already in the database.</div>";
	// runs if the order doesn't exist
  } else {
	// Modify your INSERT query to use $photoPath instead of $_POST["photo"]
	$stmt = $conn->prepare("INSERT INTO BROTHER (first_name, last_name, class, city, state, graduation_year, phone, email, photo) 
    VALUES (?,?,?,?,?,?,?,?,?)");
	$stmt->execute([$_POST["first-name"], $_POST["last-name"], $class, $_POST["city"], $state, $grad_year, $phone, $_POST["email"], $photoPath]);

	$message .= "<div class='alert alert-success'>Successfully inserted the brother <b>{$_POST["first-name"]} {$_POST["last-name"]}</b>.</div>";
  }
};

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
			  <h2>Add Brother</h2>
			  <p><b>This serves as a way to add newly intiated brothers into the database.</b></p>
			</div>


			<div class="container">
			  <form method="post" class="mb-3" enctype="multipart/form-data">
				<div class="form-group">
				  <label>First Name: </label>
				  <input class="form-control" type="text" name="first-name">
				</div>
				<div class="form-group">
				  <label>Last Name: </label>
				  <input class="form-control" type="text" name="last-name">
				</div>
				<div class="form-group">
				  <label>Class: </label>
				  <select name="class"> 
					<option disabled selected>Select a Greek Letter...</option>
					<?php
					foreach ($combinedList as $item) {
					  echo '<option value="' . $item . '">' . $item . '</option>';
					}
					?>
				  </select>
				</div>
				<div class="form-group">
				  <label>City: </label>
				  <input class="form-control" type="text" name="city">
				</div>
				<div class="form-group">
				  <label>State: </label>
				  <select name="state" id="state">
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
				  </select>
				</div>
				<div class="form-group">
				  <label>Graduation Year: </label>
				  <input class="form-control" type="text" name="grad-year">
				</div>
				<div class="form-group">
				  <label>Phone: </label>
				  <input class="form-control" type="text" name="phone">
				</div>
				<div class="form-group">
				  <label>Email: </label>
				  <input class="form-control" type="text" name="email">
				</div>
				<div class="form-group">
				  <label for="photo">Upload composite photo:</label>
				  <div class="custom-file">
					<input type="file" class="custom-file-input" id="photo" name="photo" accept="image/*">
					<label class="custom-file-label" for="photo">Choose file</label>
				  </div>
				</div>

				<button class="button-primary" style="background-color:#f1bd19" name="submit">Submit</button>

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
	<script>
// Add this script at the end of your HTML, just before the closing </body> tag
document.querySelector('.custom-file-input').addEventListener('change', function(e) {
  var fileName = e.target.files[0].name;
  var nextSibling = e.target.nextElementSibling;
  nextSibling.innerText = fileName;
});
</script>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.scrollex.min.js"></script>
	<script src="assets/js/jquery.scrolly.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>

  </body>
</html>