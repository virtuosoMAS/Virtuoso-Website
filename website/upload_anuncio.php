<?php
	include_once('db.php');
	require_once 'htmlpurifier-4.9.2-standalone/HTMLPurifier.standalone.php';
	$config = HTMLPurifier_Config::createDefault();
	$config->set('HTML.Allowed', 'p,b,a[href],i');
	$config->set('HTML.AllowedAttributes', 'a.href');
	$purifier = new HTMLPurifier($config);
	
	if (isset($_POST["titulo"])) {
		// upload da imagem
		$main_picture = "";
		$picture1 = "";
		$picture2 = "";
		$picture3 = "";
		$picture3 = "";

		$main_name = $_FILES["main_picture"]["tmp_name"];
		$pic1_name = $_FILES["picture1"]["tmp_name"];
		$pic2_name = $_FILES["picture2"]["tmp_name"];
		$pic3_name = $_FILES["picture3"]["tmp_name"];
		$pic4_name = $_FILES["picture4"]["tmp_name"];

		$main_content = base64_encode(file_get_contents(addslashes($main_name)));
		$pic1_content = base64_encode(file_get_contents(addslashes($pic1_name)));
		$pic2_content = base64_encode(file_get_contents(addslashes($pic2_name)));
		$pic3_content = base64_encode(file_get_contents(addslashes($pic3_name)));
		$pic4_content = base64_encode(file_get_contents(addslashes($pic4_name)));

		//-------------------------------------------------------------------------
		$user_id = my_nl2br($_POST["user_id"]);
		$titulo = my_nl2br($_POST["titulo"]);
		$categoria = my_nl2br($_POST["categoria"]);
		$descricao = $purifier->purify(my_nl2br($_POST["descricao"]));
		$video = $purifier->purify(my_nl2br($_POST["video"]));
		
		$especificacoes = array();
		$specs = mysql_fetch_array(mysql_query("SELECT * FROM Especificacoes WHERE instrumento='{$categoria}'"));
		$specs = explode(",", $specs["specs"]);
		foreach ($specs as $spec_name) {
			$temp = $purifier->purify($_POST[trim($spec_name)]);
			if (strlen($temp)> 0)
				$especificacoes[trim($spec_name)] = $temp;
		}
		$especificacoes = serialize($especificacoes);
		$localizacao = my_nl2br($_POST["localizacao"]);
		$preco = my_nl2br($_POST["preco"]);
		$tipo_de_venda = my_nl2br($_POST["tipo_de_venda"]);
		$condicao = my_nl2br($_POST["condicao"]);
		$otherinfo = $purifier->purify(my_nl2br($_POST["otherinfo"]));
		
		$sql_query = "INSERT INTO `Anuncios` (`id`, `user_id`, `titulo`, `data`, `categoria`, `descricao`, `especificacoes`, `main_img`,
 				`img_1`, `img_2`, `img_3`, `img_4`, `localizacao`, `preco`, `tipo_de_venda`, `condicao`, `otherinfo`, `empresa`, `video`) 
				VALUES ('', '{$user_id}', '{$titulo}',  TIMESTAMP( UTC_TIMESTAMP( ), 4800 ), '{$categoria}', '{$descricao}', '{$especificacoes}', '{$main_content}', '{$pic1_content}', 
				'{$pic2_content}', '{$pic3_content}', '{$pic4_content}', '{$localizacao}', '{$preco}', '{$tipo_de_venda}', '{$condicao}', '{$otherinfo}', 0, '{$video}')";
		
 		if (mysql_query($sql_query)) {
 			header('Location: loja_main.php');
 		} else {
 			header('Location: criar_anuncio.php');
 		}
	}
	
	function my_nl2br($string) {
		return preg_replace("/\r\n|\r|\n/",'<br/>', $string);
	}
?>
