<?php  

$item_name = $_POST['item_name'];

$item_name_length = strlen($item_name);

$database = new SQLite3('db.sqlite3');

if ($item_name_length == 0) {

	echo "<div class=\"alert alert-danger\">Unnamed items can't be added!</div>";
	
} else {
	// SQL to add to DB

	$sql_query = "INSERT INTO todo_items (item_name) VALUES ('$item_name')";
	if ( $database->exec($sql_query) ) {

	// If success
	echo "<div class=\"alert alert-success\">Item $item_name added!</div>";
	} else {
		echo "<div class=\"alert alert-danger\">Something went wrong, item not added!</div>";
	}

}

?>



