<?php 
	session_start();
	ob_start();
	require('new-connection.php');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
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
		<a href="add_poll.php"><button id="add-btn">Add a poll</button></a>
	<?php
		if(isset($_SESSION['errors']))
  		{
    		foreach($_SESSION['errors'] as $error)
    		{ 
	?>
          		<div class="alert alert-warning alert-dismissable">
  					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>	
            		<strong>Error: </strong> <?= $error ?>
          		</div>
	<?php 
			} 
			unset($_SESSION['errors']);
			}
  		//Check and display if the user was created successfully.
  		if(isset($_SESSION['success_message'])) 
    	{
	?>
    		<div class="alert alert-success alert-dismissable">
    			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>	
					<strong>Success: </strong> <?= $_SESSION['success_message'] ?>
	    	</div>
	<?php 
			unset($_SESSION['success_message']);
		} 
	?>
	<?php
		// get all polls from the database
		$polls = fetch_all("SELECT * FROM polls");
		// display each poll individually
		foreach($polls as $poll) 
		{
	?>
		<div class="poll-container">
			<p class="poll-id">Poll Id: <?= $poll['id'] ?></p>
			<h4 class="poll-title"><?= $poll['title'] ?></h4>
			<p class="poll-description"><?= $poll['description']?></p>
			<form class="poll" action="process.php" method="post" >
			<?php
				//get all options from database
				$options = fetch_all("SELECT * FROM poll_options");
			?>
				<input type="hidden" name="action" value="submit-answer">
				<input type="hidden" name="poll_id" value="<?=$poll['id'] ?>">
				<input type="hidden" name="option_id" value="">
			<?php  
				foreach($options as $option)
				{
					// display each option for each poll
					if($option['polls_id'] == $poll['id'])
					{
			?>
						<div class="radio">
							<label>
							<input type="radio" name="option_id" id="option" value="<?= $option['id']?>">
							    <?=$option['name']?>
							</label>
						</div>
			<?php
					}
				}
			?>				
				<div class="form-group">
					<input type="submit" id="submit" class="btn btn-success btn-med" value="Submit Answer">
				</div>
			</form>
			<div class="results">
				<h5>Results</h5>
         		<?php 
         			// Get all poll results for each poll
            		$get_all_results = "SELECT * from poll_results where polls_id = {$poll['id']}";
		        	$results = fetch_all($get_all_results); 
				?>
         			<h4>Poll Taken: <?= count($results) ?> times.</h4>
         		<?php
         			// Create an array to count our values
         			$resultsArray = array();
         			for($i = 0; $i < count($results); $i++)
            		{
				      	$resultsArray[] = $results[$i]['poll_options_id'];
				    }
    				// Results are now added to $resultsArray as individual array items
    				// Now let's count them!
				    $resultsCount = array_count_values($resultsArray);
				    // Go through this newly created array and display our results
				    foreach ($resultsCount as $value => $count)
	            	{
						$query_name = "SELECT name FROM poll_options where id = {$value}";
						$name_result = fetch_record($query_name); 
						$avg = round(100 * ($count / count($results)), 2);
          		?>
						<p><?= $name_result['name'] ?> <?= $avg ?>%</p>
				<?php 
            		}
         		?>
			</div><!-- END RESULTS -->
		</div><!-- END POLLS -->
	<?php
		} // END FOREACH POLL LOOP
	?>
	</div><!-- END CONTAINER -->
</body>
</html>