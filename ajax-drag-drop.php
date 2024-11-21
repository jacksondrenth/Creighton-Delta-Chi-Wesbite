<?php
require_once('db.php');
require_once('functions-drag-drop.php');
// check if the list array was posted
if (isset($_POST["list"])) {

  // sets the default variables and gets the POST values
  $list = $_POST["list"];
  $listSet = array();
  $dragDropID = $_POST["dragDropID"];
  $in = "";

  // check if no list items were included in the list
  if (!empty($list)) {

	// add each list item to the list array
	foreach($list as $listItem) {

	  // gets just the list item text without list-item- and adds it to the list array
	  $listItem = str_replace("list-item-", "", $listItem);
	  $listSet[] = $listItem;

	  // prepare the query to insert the list item for the specific drag drop ID (e.g., employee ID) while ignoring entries with the same primary key
	  $query =
		"INSERT IGNORE INTO brother_chair (brother_id, chair_id)
VALUES (?, ?)";
	  $stmt = $conn->prepare($query);

	  // execute the query and store the results
	  $stmt->execute([$dragDropID, $listItem]);
	}
	$in = str_repeat("?,", count($list) - 1) . "?";
  }

  if (!empty($list)) {
  
  // prepare the query to delete all list items for the given drag drop ID (e.g., employee ID) that were not part of the list set
  $query =
	"DELETE FROM brother_chair
WHERE brother_id = ?
AND chair_id NOT IN ({$in})";
  $stmt = $conn->prepare($query);

  // add drag drop ID (e.g., employee ID) to the beginning of list set array preparing for the positional placeholders
  array_unshift($listSet, $dragDropID);

  // execute the query and store the results
  $stmt->execute($listSet);
  } else {
    // prepare the query to delete all list items for the given drag drop ID (e.g., employee ID) when the list is empty
    $query =
        "DELETE FROM brother_chair
        WHERE brother_id = ?";
    $stmt = $conn->prepare($query);

    // execute the query with the drag drop ID (e.g., employee ID)
    $stmt->execute([$dragDropID]);
}
  $query = "select concat(first_name, ' ', last_name) as name
          from brother
          where brother_id = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$dragDropID]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
echo "<b>{$result["name"]}'s chair has been updated!</b>";
}

if (isset($_POST["dragdrop"])) {
  echo getDragDropLists($conn, $_POST["dragdrop"]);
}
?>

