<?php
	//Inserir Pergunta Na Base de Dados
	include_once('db.php');
	require_once 'htmlpurifier-4.9.2-standalone/HTMLPurifier.standalone.php';
	
	$config = HTMLPurifier_Config::createDefault();
	$purifier = new HTMLPurifier($config);
	
	if (isset($_POST["corpo"])) {
		$titulo = mysql_real_escape_string(htmlspecialchars($_POST['titulo']));
		$corpo = mysql_real_escape_string($purifier->purify(my_nl2br($_POST['corpo'])));
		$user_id = $_POST['user_id'];
		$categoria = $_POST['categoria'];
		if (mysql_query("INSERT INTO `Perguntas` (`id`, `user_id`, `data`, `titulo`, `corpo`, `views`, `votos`, `categoria`)
		VALUES (NULL, '{$user_id}', TIMESTAMP( UTC_TIMESTAMP( ), 4800 ), '{$titulo}', '{$corpo}', 0, 0, '{$categoria}');")) {
			header('Location: q_and_a_main.php');
		} else {
			header('Location: q_and_a_main.php');
		}
	}
	function my_nl2br($string) {
		return preg_replace("/\r\n|\r|\n/",'<br/>', $string);
	}
?>
