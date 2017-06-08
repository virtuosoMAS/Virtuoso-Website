<?php
	# Start the session
	session_start();
	$user_name = $_SESSION['user_name'];
	$user_id = $_SESSION['user_id'];
	if ($user_id == 0) header("Location: index.php");
	$user_email = $_SESSION['user_email'];
	$user_profile_img = $_SESSION['user_profile_image'];
?>
