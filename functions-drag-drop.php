<?php
// create a function that gets the lists for dragging and dropping
function getDragDropLists($conn, $id = null) {
    $listOptions = "";
    $listSet = "";
    $placeholders = [$id];

    // prepares and executes the query to get the left panel divs
    $query =
    "SELECT chair_id, title
	FROM chair
	WHERE chair_id NOT IN (
	  SELECT chair_id
	  FROM brother_chair
	  WHERE brother_id = ?
	) 
	ORDER BY title";
    $stmt = $conn->prepare($query);
    $stmt->execute($placeholders);

    // loops through each row and adds them to the listOptions variable
    foreach ($stmt as $row) {
        $listOptions .= "<li id='list-item-{$row["chair_id"]}' draggable='true' class='btn btn-warning w-100 mb-1 drag-drop-item'>{$row["title"]}</li>";
    }

    // prepares and executes the query to get the right panel divs
    $query =
    "SELECT chair_id, title
	FROM chair
	WHERE chair_id IN (
	  SELECT chair_id
	  FROM brother_chair
	  WHERE brother_id = ?
	) 
	ORDER BY title";
  	$stmt = $conn->prepare($query);
    $stmt->execute($placeholders);

    // loops through each row and adds them to the listSet variable
    foreach ($stmt as $row) {
        $listSet .= "<li id='list-item-{$row["chair_id"]}' draggable='true' class='btn btn-warning w-100 mb-1 drag-drop-item'>{$row["title"]}</li>";
    }

    // create two divs with the lists created above
    return
    "<p>Drag any chair position to assign to a brother:</p>
    <div style='display: flex;'>
        <div id='left-panel' class='left-panel' style='flex: 1'>
            <p>List of Possible Chair Positions</p>
            <ul id='left-list' class='connectedSortable' style='min-height:10px;'>
                {$listOptions}
            </ul>
        </div>
        <div id='filler-col' class='filler-col drag-drop-col'></div>
        <div id='right-panel' class='right-panel' style='flex: 1'>
            <p>Current Chair Position</p>
            <ul id='right-list' class='connectedSortable' style='min-height:10px;'>
                {$listSet}
            </ul>
        </div>
    </div>";
}
?>