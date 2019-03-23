<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$database = new SQLite3('db.sqlite3');

$database->exec('CREATE TABLE IF NOT EXISTS todo_items (item_name varchar(255))');

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
	<title>To Do List</title>

	<link rel="stylesheet" href="./style.css">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

</head>
<body>

	<div class="container-fluid">

		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="page-header">
						<ul class="fly-in-text hiddenul text-center">
							<li>T</li>
							<li>o</li>
							<li></li>
							<li>D</li>
							<li>o</li>
							<li></li>
							<li>L</li>
							<li>i</li>
							<li>s</li>
							<li>t</li>
						</ul>
					<h4 class="text-center subheader"><small>made with Bootstrap3, PHP, AJAX & SQLite3</small></h4>
				</div>
				<div id="currentlist_wrapper">
						<br>
						<div id="current_list" class="scroll scroll-width-thin">
						</div>					
				</div>													
			</div>
			<div class="col-md-4"></div>			
		</div>

		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
					<div id="additem_wrapper">
						<hr>
					<p>
					<form class="form-horizontal">
					  <div class="form-group form-group-lg">
					  	<div class="col-md-8 col-sm-8 col-lg-8 col-xs-8">
					    	<input type="text" class="form-control input-lg" id="item_name" name="item_name"/>
						</div>
						<div class="col-md-4 col-sm-4 col-lg-4 col-xs-4">
						<button class="btn btn-default btn-lg btn-block add_item">Add Item</button>
						</div>
					  </div>
					  
					 </form>
					</p>
						
					<div id="additem_response_message"></div>	
					</div>						
			</div>
			<div class="col-md-4"></div>			
		</div>
	</div>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">

	function loadCurrentList(){
		$.ajax({
			url: "./current_list.php",
			type: "POST",
			data: {},
			success: function(data) {    
	          $("#current_list").html(data);
	        },
	        error: function (xhr, status, error) {
	          $("#current_list").html(xhr.responseText);
	        }
		});
	}

	$(loadCurrentList());

	$(document).on("click", ".add_item", function(e){
		var postData = $(this.form).serialize();
			$.ajax({
				url: "./add_item_handler.php",
				type: "POST",
				data: postData,
				success: function(data) {    
		          $("#additem_response_message").html(data);
		          $('#item_name').val('');
		          loadCurrentList();
		        },
		        error: function (xhr, status, error) {
		          $("#additem_response_message").html(xhr.responseText);
		        }
			});			
			e.preventDefault();
	});

	 $( function() {	                
	                setTimeout(function() {
	                    $('.fly-in-text').removeClass('hiddenul');
	                }, 500);
		});

</script>

</body>
</html>