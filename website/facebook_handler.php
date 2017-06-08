<?php 
	include_once('db.php');
	session_start();
	$nome = $_POST["nome"];
	$id = $_POST["user_id"];
	$email = $_POST["email"];
	$img = $_POST["profile_img"];

	
	$_SESSION['user_name'] = $nome;
	$_SESSION['user_id'] = $id;
	$_SESSION['user_email'] = $email;
	$_SESSION['user_profile_image'] = $img;
	
	if (mysql_fetch_row(mysql_query("SELECT COUNT(`user_id`) FROM `Utilizadores` WHERE `user_id` =".$id))[0] > 0) {
		mysql_query("UPDATE `Utilizadores` SET `nome` = '{$nome}',`email` = '{$email}',`profile_img` = '{$img}' WHERE `user_id` ='{$id}'");
	} else {
		mysql_query("INSERT INTO `Utilizadores` (`user_id`, `nome`, `email`, `profile_img`) VALUES ('{$id}', '{$nome}', '{$email}', '{$img}')");
	}
	header("Location: welcome.php");
?>
