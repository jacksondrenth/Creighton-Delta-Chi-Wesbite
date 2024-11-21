<?php
// connect to the database
require_once("db.php");

// import the functions page (see functions tab)
require_once("functions.php");

// get the calendar
$calendar = getCalendar($conn);
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
				  <li><a href="brothers.php">All Brothers</a></li>
				  <li><a href="brother_to_alum.php">Brother to Alum</a></li>
				  <li><a href="add_brother.php">Brother Addition</a></li>
				  <li><a href="remove_brother.php">Remove Brother</a></li>
				  <li><a href="events_creation.php">Events Creation</a></li>
				  <li><a href="chair_management.php">Chair/Exec Management</a></li>
				  <li><a href="update_brother_alum.php">Update Brothers</a></li>

				  
				  
				</ul>
			  </div>
			</li>
		  </ul>
		</nav>
	  </header>

	  <!-- Banner -->
	  <section id="banner">
		<div class="inner">
		  <h2>Delta Chi</h2>
		  <p><b>Born Proud. Raised Proud.</b><br>
			<strong>The Creighton Chapter.</strong><br>
			<b>Follow us on <a href="https://www.instagram.com/creightondeltachi?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">Instagram</a>.</b></p>
		  <ul class="actions special">
			<li><a href="about_us.php" class="button primary">About Us</a></li>
		  </ul>
		</div>
		<a href="#one" class="more scrolly"><b>Upcoming Events</b></a>
	  </section>

	  <!-- One -->
	  <section id="one" class="wrapper style1 special">
		<div class="inner">
		  <header class="major">
			
			
			
<!-- 		Calendar	 -->
			<h2>Upcoming Events!</h2>
			
			<div id='calendar'><?php echo $calendar; ?></div>
        <div id='event-list'></div>
			
			
			
			
		  </header>
		  
		</div>
	  </section>

	  <!-- Three -->
	  <section id="three" class="wrapper style3 special">
		<div class="inner">
		  <header class="major">
			<h2>Why Join Delta Chi?</h2>
			<p>At Delta Chi, you have the opportunity to become the man you were meant to be. Delta Chi believes in developing the whole person and helping our men become better people, not just better Delta Chis, who are committed to making an impact on the world around them. We cultivate inclusive environments for any person who self-identifies as a man, who reflects and lives our values of promoting friendship, developing character, advancing justice, and assisting in the acquisition of a sound education. It’s through these values that our members become men of action and grow to become the best version of themselves while living, leading, and growing each day with integrity. </p>
		  </header>
		  <ul class="features">
			<li class="icon fa-paper-plane">
			  <h3>Arcu accumsan</h3>
			  <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
			</li>
			<li class="icon solid fa-laptop">
			  <h3>Ac Augue Eget</h3>
			  <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
			</li>
			<li class="icon solid fa-code">
			  <h3>Mus Scelerisque</h3>
			  <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
			</li>
			<li class="icon solid fa-headphones-alt">
			  <h3>Mauris Imperdiet</h3>
			  <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
			</li>
			<li class="icon fa-heart">
			  <h3>Aenean Primis</h3>
			  <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
			</li>
			<li class="icon fa-flag">
			  <h3>Tortor Ut</h3>
			  <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
			</li>
		  </ul>
		</div>
	  </section>

	  <!-- CTA -->
	  <section id="cta" class="wrapper style4">
		<div class="inner">
		  <header>
			<h2>Arcue ut vel commodo</h2>
			<p>Aliquam ut ex ut augue consectetur interdum endrerit imperdiet amet eleifend fringilla.</p>
		  </header>
		  <ul class="actions stacked">
			<li><a href="#" class="button fit primary">Activate</a></li>
			<li><a href="#" class="button fit">Learn More</a></li>
		  </ul>
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