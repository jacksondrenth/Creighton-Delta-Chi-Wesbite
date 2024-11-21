<?php
// connect to the database
require_once("db.php");
$message = $results = "";

try {
    $stmt = $conn->query("SELECT b.brother_id, b.first_name, b.last_name, b.class, b.city, b.state, b.photo, b.email, b.phone,
                          GROUP_CONCAT(m.name SEPARATOR ', ') AS majors
                          FROM brother b
                          LEFT JOIN major_student ms ON b.brother_id = ms.brother_id
                          LEFT JOIN major m ON ms.major_id = m.major_id
                          GROUP BY b.brother_id
                          ORDER BY 
                            CASE 
                                WHEN b.class = 'Founding' THEN 0
                                WHEN b.class REGEXP '^[A-Z]$' THEN 1
                                WHEN b.class REGEXP '^[A-Z][A-Z]$' THEN 2
                                WHEN b.class REGEXP '^[A-Z][A-Z][A-Z]$' THEN 3
                                ELSE 4
                            END,
                            CASE
                                WHEN b.class = 'Founding' THEN 0
                                WHEN b.class = 'Alpha' THEN 1
                                WHEN b.class = 'Beta' THEN 2
                                WHEN b.class = 'Gamma' THEN 3
                                WHEN b.class = 'Delta' THEN 4
                                WHEN b.class = 'Epsilon' THEN 5
                                WHEN b.class = 'Zeta' THEN 6
                                WHEN b.class = 'Eta' THEN 7
                                WHEN b.class = 'Theta' THEN 8
                                WHEN b.class = 'Iota' THEN 9
                                WHEN b.class = 'Kappa' THEN 10
                                WHEN b.class = 'Lambda' THEN 11
                                WHEN b.class = 'Mu' THEN 12
                                WHEN b.class = 'Nu' THEN 13
                                WHEN b.class = 'Xi' THEN 14
                                WHEN b.class = 'Omicron' THEN 15
                                WHEN b.class = 'Pi' THEN 16
                                WHEN b.class = 'Rho' THEN 17
                                WHEN b.class = 'Sigma' THEN 18
                                WHEN b.class = 'Tau' THEN 19
                                WHEN b.class = 'Upsilon' THEN 20
                                WHEN b.class = 'Phi' THEN 21
                                WHEN b.class = 'Chi' THEN 22
                                WHEN b.class = 'Psi' THEN 23
                                WHEN b.class = 'Omega' THEN 24
                                ELSE 25
                            END,
                            b.last_name, b.first_name");

    $currentClass = '';
    // loops through each row of the query
    foreach ($stmt as $row) {
        // If the class has changed, add a new header row
        if ($row["class"] != $currentClass) {
            $results .= "<tr><th colspan='8' style='background-color: #d4af37; color: white;'>" . htmlspecialchars($row["class"]) . " Class</th></tr>";
            $currentClass = $row["class"];
        }
        
        // Format phone number
        $phone = $row["phone"] ? "(" . substr($row["phone"], 0, 3) . ") " . substr($row["phone"], 3, 3) . "-" . substr($row["phone"], 6) : "N/A";
        
        // adds a new row with each cell <td> of data to the content variable
        $results .= 
        "<tr style='color:#000000'>
           <td><img src='" . htmlspecialchars($row["photo"]) . "' alt='Photo of " . htmlspecialchars($row["first_name"]) . " " . htmlspecialchars($row["last_name"]) . "' class='photo'></td>
           <td>" . htmlspecialchars($row["first_name"]) . " " . htmlspecialchars($row["last_name"]) . "</td>
           <td>" . htmlspecialchars($row["class"]) . "</td>
           <td>" . htmlspecialchars($row["city"]) . "</td>
           <td>" . htmlspecialchars($row["state"]) . "</td>
           <td>" . htmlspecialchars($row["majors"]) . "</td>
           <td>" . htmlspecialchars($row["email"]) . "</td>
           <td>" . $phone . "</td>
         </tr>";
    }

    $results = 
    "<table class='table table-bordered table-striped' style='background-color: #f1bd19;'>
       <tr>
         <th>Photo</th>
         <th>Name</th>
         <th>Class</th>
         <th>City</th>
         <th>State</th>
         <th>Major(s)</th>
         <th>Email</th>
         <th>Phone</th>
       </tr>
       {$results}
     </table>";

} catch(PDOException $e) {
    $message = "Query failed: " . $e->getMessage();
}
?>

<!DOCTYPE HTML>
<html>
  <head>
    <title>Creighton Delta Chi - Brothers</title>
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
    <style>
      .photo {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
      }
      .table td, .table th {
        vertical-align: middle;
      }
    </style>
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
                  
                  <!-- hidden -->
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
              <h2>Brothers</h2>
              <p><b>This page serves to show all brothers that have been in the Creighton Chapter.</b></p>
            </div>
            
            <div class="container-fluid">
              <?php 
              if ($message) {
                  echo "<p>$message</p>";
              } else {
                  echo $results; 
              }
              ?>
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