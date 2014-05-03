<?php 
	session_start();
	ob_start();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Poll Page</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
  	<!-- Google hosted javascript -->
  	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  	<!-- Latest compiled and minified JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<div id="container">
		<h3>Add Poll</h3>
		<form action="process.php" method="post">
			<?php 
				if(isset($_SESSION['errors'])) 
				{
					foreach($_SESSION['errors'] as $errors => $message) 
					{
					?>
					<p class="errors"><?=$message ?></p>
					<?php
					unset($_SESSION['errors']);
					}
				}
				?>
			<input type="hidden" name="action" value="add-poll">
			<div class="form-group">
			    <label for="title" id="title">Title</label>
			    <input type="text" class="form-control" name="title" placeholder="Enter poll title">
			</div>
			<div class="form-group">
			    <label for="description">Description</label>
			    <textarea rows="6" class="form-control" name="description" placeholder="Enter the poll description"></textarea>
			</div>
			<div class="form-group">
			    <label for="option01" id="option01">Option 1</label>
			    <input type="text" class="form-control" name="option01" placeholder="Enter first option">
			</div>
			 <div class="form-group">
			    <label for="option02" id="option02">Option 2</label>
			    <input type="text" class="form-control" name="option02" placeholder="Enter second option">
			</div>
			<div class="form-group">
			    <label for="option03" id="option03">Option 3</label>
			    <input type="text" class="form-control" name="option03" placeholder="Enter third option">
			</div>
			 <div class="form-group">
			    <label for="option04" id="option04">Option 4</label>
			    <input type="text" class="form-control" name="option04" placeholder="Enter fourth option">
			</div>
			<div class="form-group">
				<input type="submit" id="Submit" class="btn btn-success btn-lg" value="Add Poll">
			</div>
		</form>
		<form action="process.php" method="post">
			<input type="hidden" name="action" value="cancel-poll">
			<div class="form-group">
				<input type="submit" id="cancel" class="btn btn-primary btn-lg" value="Cancel">
			</div>
		</form>
	</div>	
</body>
</html>