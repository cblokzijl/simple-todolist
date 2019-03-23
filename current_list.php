
<?php

$database = new SQLite3('db.sqlite3');

$sql_query = "SELECT rowid,* FROM todo_items";

?>

<p>
<div class="table-responsive">          
  <table class="table table-hover">
    <thead>
    </thead>
    <tbody>
    	<?php
    		$result = $database->query($sql_query);
    		while ($row = $result->fetchArray()) {
    			$row = (Object) $row;
    			echo "<tr id=\"tablerow". $row->rowid ."\"><td>". $row->item_name . "</td>
    			<td id=\"deletecell\"><form> 
			<input type=\"hidden\" name=\"db_rowid\" value=\"". $row->rowid ."\"/>
			<button class=\"btn btn-sm btn-danger delete_item pull-right\" title=\"Delete item\"> <span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span> </button>
			</form></td></tr>";
    		}
    	?>
    </tbody>
  </table>
  </div>
</p>

<script type="text/javascript">
			$(document).on("click",".delete_item", function(e) {
		    postData = $(this.form).serialize();
		    var ID = $(this.form).find('input[name="db_rowid"]').val();
		    if( confirm("Are you sure to delete this to-do list item?")){
			    	$.ajax({
			      type: "POST",
			        url: "./delete_item_handler.php",
			        data: postData,
			        success: function(data) {    
			          $("#tablerow" + ID).html(data);
			        },
			        error: function (xhr, status, error) {
			          $("#tablerow" + ID).html(xhr.responseText);
			        }
			      }); 
			   }
			    e.preventDefault();
			});
</script>
