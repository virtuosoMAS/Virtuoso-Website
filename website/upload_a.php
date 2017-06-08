<?php
	//Inserir Resposta Na Base de Dados
	include_once('db.php');
	require_once 'htmlpurifier-4.9.2-standalone/HTMLPurifier.standalone.php';
	
	$config = HTMLPurifier_Config::createDefault();
	$purifier = new HTMLPurifier($config);
	
	if (isset($_POST["corpo"])) {
		$corpo = mysql_real_escape_string($purifier->purify(my_nl2br($_POST['corpo'])));
		$q_id = $_POST['q_id'];
		$user_id = $_POST['user_id'];
		if (mysql_query("INSERT INTO `Respostas` (`id`, `q_id`, `user_id`, `data`, `corpo`)
				VALUES (NULL, '{$q_id}', '{$user_id}', TIMESTAMP( UTC_TIMESTAMP( ), 4800 ), '{$corpo}');")) {
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		} else {
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		exit();
	}
	
	function my_nl2br($string) {
		return preg_replace("/\r\n|\r|\n/",'<br/>', $string);
	}
?>