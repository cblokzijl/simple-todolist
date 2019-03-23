<?php  

$item_id = $_POST['db_rowid'];

$database = new SQLite3('db.sqlite3');

$sql_query = "DELETE FROM todo_items WHERE rowid = $item_id";

if ( $database->exec($sql_query) ) {

	// If success return an alert
	echo "<div class=\"alert alert-danger\">Item succesfully deleted!</div>";
} else {
	// If failed return an alert
	echo "<div class=\"alert alert-danger\">Something went wrong, item not deleted!</div>" . $database->e;
}



?>



