<?php
require_once("db.php");


// checks if the POST variable is set
if (isset($_POST["ajaxID"])) {

  // sets the schema PHP variable
  $ajaxID = $_POST["ajaxID"];

  // gets the information of the employee
  $query =
  "SELECT *
  FROM brother
  WHERE brother_id = ?";
  $stmt = $conn->prepare($query);

  // executes the query
  $stmt->execute([$ajaxID]);

  // gets the first (and only) row of the results
  $row = $stmt->fetch();

  echo
  " 

  <div>First Name:</div>
  <p class='font-weight-bold'><input placeholder='First Name' type='text' name='first-name' value='{$row["first_name"]}' required></p>
  <div>Last Name:</div>
  <p class='font-weight-bold'><input placeholder='Last Name' type='text' name='last-name' value='{$row["last_name"]}' required></p>
  <div>Class:</div>
  <p class='font-weight-bold'><input placeholder='class' type='text' name='class' value='{$row["class"]}'></p>
  <div>City:</div>
  <p class='font-weight-bold'><input placeholder='city' type='text' name='city' value='{$row["city"]}'></p>
  <div>State:</div>
  <p class='font-weight-bold'><input placeholder='state' type='text' name='state' value='{$row["state"]}'></p>
  <div>Graduation Year:</div>
  <p class='font-weight-bold'><input placeholder='grad year' type='text' name='grad-year' value='{$row["graduation_year"]}'></p>
  <div>Phone:</div>
  <p class='font-weight-bold'><input placeholder='phone' type='text' name='phone' value='{$row["phone"]}'></p>
  <div>Email:</div>
  <p class='font-weight-bold'><input placeholder='email' type='text' name='email' value='{$row["email"]}'></p>
  <div>Photo Link:</div>
  <p class='font-weight-bold'><input placeholder='photo' type='text' name='photo' value='{$row["photo"]}'></p>
  <button name='submit' class='button-primary'>Update!</button>

  ";
}
?>