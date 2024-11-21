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
				  <li><a href="brother_to_alum.php">Brother to Alum</a></li>
				  <li><a href="add_brother.php">Brother Addition</a></li>
				  <li><a href="add_alumni.php">Alumni Addition</a></li>
				  <li><a href="events_creation.php">Events Creation</a></li>
				  <li><a href="chair_management.php">Chair/Exec Management</a></li>
				  <li><a href="chair_management.php">Update Brothers</a></li>
				  
				  
				</ul>
			  </div>
			</li>
		  </ul>
		</nav>
	  </header>

	  <!-- Banner -->
	  <article id="main">
		<header>
		  <h2>About Us</h2>
			  <p><b>“We, the members of The Delta Chi Fraternity, believing that great advantages are to be derived from a brotherhood of college and university men, appreciating that close association may promote friendship, develop character, advance justice, and assist in the acquisition of a sound education, do ordain and establish this Constitution.” -Delta Chi Preamble</b></p>
		  <ul class="actions special">
			<li><a href="contact_us.php" class="button primary">Contact Us</a></li>
		  </ul>
		</header>
	  

	  <!-- One -->
	  <section id="one" class="wrapper style1 special">
		<header class="major">
		  <div class="inner">

			<div>
			  <h2>Our Values</h2>
			  
			</div>

		  </div>
		</header>


	  </section>


	  <!-- Two -->
	  <section id="two" class="wrapper alt style2">
		<section class="spotlight">
		  <div class="image"><img src="images/mega_fam.jpg" alt="" /></div><div class="content">
		  <h2>-Promote Friendship-</h2>
		  <p>Delta Chi exists to promote friendship in its members. The friendships formed during your undergraduate years are relationships that will last far beyond graduation. Delta Chi was founded on the principle of bringing together men of similar interests to work towards a common good. This doesn’t mean that men in a particular chapter are just clones of one another, but rather that the common bond of personal development through brotherhood can motivate a group of men to accomplish great things. This close association of college and university men produces life-long friends.

			Many of our members tell stories in which the groomsmen who stood next to them at their weddings were fraternity brothers. Reunions bring men from various generations to tears of laughter at the retelling of old stories. The experience of seeing your own son initiated into Delta Chi decades after you were can bring generations closer together through the shared experience of our Ritual.

			There is a silly stereotype that fraternity men just buy their friends. One of the best responses to this stereotype is that, “If I paid for my friends by joining my fraternity, then I surely did not pay enough for the caliber of friends I received.” </p>
		  </div>
		</section>
		<section class="spotlight">
		  <div class="image"><img src="images/chartering.jpg" alt="" /></div><div class="content">
		  <h2>-Develop Character-</h2>
		  <p>Character is good sportsmanship. Character is academic success and integrity. Character is holding yourself and others to a higher standard. Character is doing the right thing. The character of a man is the greatest measure of his potential. In Delta Chi, character is a core value and the cornerstone of the Fraternity.

			Challenging yourself to take a leadership role, to chair a committee, to be the point guard for the intramural basketball team, to tutor a younger member in Calculus, or to simply be a member who lives according to the values of the Ritual and the Eleven Basic Expectations all work to help develop your individual character.</p>
		  </div>
		</section>
		<section class="spotlight">
		  <div class="image"><img src="images/service.jpg" alt="" /></div><div class="content">
		  <h2>-Advance Justive-</h2>
		  <p>Originally founded as a law fraternity, Delta Chi still holds as its cardinal principle: the perpetuation of justice in society. A Delta Chi is always concerned with doing the right thing, even when it might not be the popular thing to do. This is an everyday value that all men should practice and a value that, as a member of Delta Chi, you will be expected to live.</p>
		  </div>
		</section>
		<section class="spotlight">
		  <div class="image"><img src="images/family_photo.jpg" alt="" /></div><div class="content">
		  <h2>-Acquistion of a Sound Education-</h2>
		  <p>The reason you chose to go to college was to get an education. Delta Chi will help you make that happen. Going from high school to college is a stressful life change, and whatever you can do to make it less stressful, the better. To increase the odds of becoming academically successful, Delta Chi can provide you with a support network around your college experience. This can be in the form of study groups, note files, mentoring by upperclassmen, and advice from the chapter’s faculty advisor. There is a reason that fraternity men have a higher graduation rate than men who choose not to join a fraternity. Success breeds success.

			In addition to the undergraduate services, the Delta Chi Educational Foundation provides members with scholarship opportunities based on academic success and campus involvement. If you’re looking for academic support and success, Delta Chi can provide that. Delta Chi exists to assist in the acquisition of a sound education for its members.</p>
		  </div>
		</section>
	  </section>


	  </article>
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