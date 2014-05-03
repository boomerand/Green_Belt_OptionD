<?php
session_start();
ob_start();
require('new-connection.php');

if(isset($_POST['action']) && $_POST['action'] == 'add-poll') 
{
	add_poll($_POST);
}
if(isset($_POST['action']) && $_POST['action'] == 'cancel-poll') 
{
	cancel_poll($_POST);
}
if(isset($_POST['action']) && $_POST['action'] == 'submit-answer') 
{
	submit_answer($_POST);
}

function add_poll($post)
{
	$_SESSION['errors'] = array();
	// -------------------- BEGIN VALIDATIONS --------------------- //
	if(empty($post['title']))
	{
		$_SESSION['errors'][] = "Enter a title for the poll.";
	}
	if(empty($post['description'])) 
	{
		$_SESSION['errors'][] = "Enter the poll description/question.";
	}
	if ((empty($post['option01'])) || (empty($post['option02'])) || (empty($post['option03'])) || (empty($post['option04'])))
	{
		$_SESSION['errors'][] = "Please fill out 4 options.";
	}
	// -------------------- END VALIDATIONS ----------------------- //
	if (count($_SESSION['errors']) > 0)
	{
		header("Location: add_poll.php");
	}
	else 
	{
		$title = escape_this_string($post['title']);
		$description = escape_this_string($post['description']);
		$option01 = escape_this_string($post['option01']);
		$option02 = escape_this_string($post['option02']);
		$option03 = escape_this_string($post['option03']);
		$option04 = escape_this_string($post['option04']);
		$title_query = "INSERT INTO polls (title, description, created_at, updated_at) VALUE ('{$title}', '{$description}', NOW(), NOW())";
		$poll_id = run_mysql_query($title_query);
		$option01_query = "INSERT INTO poll_options (name, polls_id, created_at, updated_at) VALUES ('{$option01}', '{$poll_id}', NOW(), NOW())";
		$first_option = run_mysql_query($option01_query);
		$option02_query = "INSERT INTO poll_options (name, polls_id, created_at, updated_at) VALUES ('{$option02}', '{$poll_id}', NOW(), NOW())";
		$second_option = run_mysql_query($option02_query);
		$option03_query = "INSERT INTO poll_options (name, polls_id, created_at, updated_at) VALUES ('{$option03}', '{$poll_id}', NOW(), NOW())";
		$third_option = run_mysql_query($option03_query);
		$option04_query = "INSERT INTO poll_options (name, polls_id, created_at, updated_at) VALUES ('{$option04}', '{$poll_id}', NOW(), NOW())";
		$fourth_option = run_mysql_query($option04_query);
		header("Location: poll.php");
	}
}

function cancel_poll($post)
{
	header("Location: poll.php");
	die();
}

function submit_answer($post)
{
	if(empty($post['option_id']))
	{
		$_SESSION['errors'][] = "Please pick a poll option";
		header('location: poll.php');
		exit();
	}
	else
	{
		$add_result_query = "INSERT INTO poll_results(poll_options_id, polls_id, created_at, updated_at) VALUES ('{$post['option_id']}', '{$post['poll_id']}', NOW(), NOW())";
		run_mysql_query($add_result_query);
		$_SESSION['success_message'] = "Thank you for your answer!";
		header("Location: poll.php");
		die();
	}
}
?>