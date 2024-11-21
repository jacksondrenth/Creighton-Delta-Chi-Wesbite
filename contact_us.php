<?php
// connect to the database
require_once("db.php");
$message = $results = "";

$stmt = $conn->query("SELECT title, concat(first_name, ' ', last_name) AS name, class, phone, email
FROM brother
INNER JOIN exec e USING(exec_id)
WHERE exec_id IS NOT null");

// loops through each row of the query
foreach ($stmt as $row) {

  // adds a new row with each cell <td> of data to the content variable
  $results .= 
  "<tr style='color:#000000'>
     <td>{$row["title"]}</td> 
     <td>{$row["name"]}</td>
     <td>{$row["class"]}</td>
	 <td>{$row["phone"]}</td>
	 <td>{$row["email"]}</td>
   </tr>";
}

$results = 
"<table class='table table-bordered table-striped' style='background-color: #f1bd19;'>
   <tr>
     <th>Title</th>
     <th>Name</th>
     <th>Class</th>
	 <th>Phone</th>
	 <th>Email</th>
   </tr>
   {$results}
 </table>";


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
			  <h2>Contact Us</h2>
			 
			</div>

			
			<div class="container" >
  
      <?php echo $results; ?>
  
	
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