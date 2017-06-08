<?php
	include 'facebook_user_data.php';
	include_once('db.php');
	require_once 'htmlpurifier-4.9.2-standalone/HTMLPurifier.standalone.php';

	
	if (!isset($_GET["id"])) { header('Location: http://virtuoso.byethost7.com');}
	$id = htmlspecialchars($_GET["id"]);
	$user_info = mysql_query("SELECT * FROM Utilizadores WHERE user_id='{$id}'");
	if (!$user_info) { header('Location: http://virtuoso.byethost7.com/q_and_a.php');}
	$proprio_perfil = ($id == $user_id);
	$user_info = mysql_fetch_array($user_info);
	$empresa = ($user_info['empresa'] != 0);
	
	$form_action_func = $_POST['func_name'];
	$form_func_arg_id = $_POST['func_arg_id'];
	if (isset($_POST['func_arg_corpo'])) {
		$form_func_arg_corpo = $_POST['func_arg_corpo'];
	} else {
		$form_func_arg_corpo = "";
	}
	if (isset($_POST['func_arg_data'])) {
		$form_func_data = $_POST['func_arg_data'];
	} else {
		$form_func_data = "";
	}
	
	if ($form_action_func == "eliminarQ") {
		eliminarQ( $form_func_arg_id );
	} elseif ($form_action_func == "eliminarA") {
		eliminarA( $form_func_arg_id );
	} elseif ($form_action_func == "editarA") {
		editarA( $form_func_arg_id, $form_func_arg_corpo );
	} elseif ($form_action_func == "adicionarC") {
		adicionarC( $form_func_data, $form_func_arg_corpo, $user_id );
	} elseif ($form_action_func == "definicoes") {
		definicoes($form_func_arg_id, $_POST['link'], $_POST['tipo_conta']);
	} elseif ($form_action_func == "eliminarAnuncio") {
		eliminarAnuncio($form_func_arg_id);
	}
	
	function eliminarAnuncio($anuncio_id) {
		$anuncio_id = mysql_real_escape_string(htmlspecialchars($anuncio_id));
		mysql_query("DELETE FROM Anuncios WHERE id={$anuncio_id}");
	}
	
	function definicoes($user_id, $link, $tipo_conta) {
		if ($link != '') {
			$link = htmlspecialchars($link);
			mysql_query("UPDATE Utilizadores SET link='{$link}'  WHERE user_id={$user_id}");
		} elseif ($tipo_conta == "pessoal") {
			mysql_query("UPDATE Utilizadores SET empresa=0 WHERE user_id={$user_id}");
		} elseif ($tipo_conta == "empresa") {
			mysql_query("UPDATE Utilizadores SET empresa=1 WHERE user_id={$user_id}");
		}
		header("Location: ".$_SERVER[REQUEST_URI]);
	}
	
	function eliminarQ( $q_id ) {
		$q_id = mysql_real_escape_string(htmlspecialchars($q_id));
		mysql_query("DELETE FROM Perguntas WHERE id={$q_id}");
	}
	function eliminarA( $a_id ) {
		$a_id = mysql_real_escape_string(htmlspecialchars($a_id));
		mysql_query("DELETE FROM Respostas WHERE id={$a_id}");
	}
	function editarA( $a_id , $new_resp ) {
		$config = HTMLPurifier_Config::createDefault();
		$purifier = new HTMLPurifier('HTML', 'Doctype', 'HTML 4.01 Transitional');
		
		$a_id = mysql_real_escape_string(htmlspecialchars($a_id));
		$new_resp = mysql_real_escape_string($purifier->purify(addslashes(my_nl2br($new_resp))));
		mysql_query("UPDATE Respostas SET corpo='{$new_resp}' WHERE id={$a_id}");
		header("Location: http://virtuoso.byethost7.com".$_SERVER['REQUEST_URI']);
	}
	
	function adicionarC($data, $local, $user_id) {
		$config = HTMLPurifier_Config::createDefault();
		$purifier = new HTMLPurifier('HTML', 'Doctype', 'HTML 4.01 Transitional');
		$titulo = mysql_real_escape_string($purifier->purify($_POST['func_arg_data_titulo']));
		$data = mysql_real_escape_string($purifier->purify($data));
		$local = mysql_real_escape_string($purifier->purify($local));
		$concertos = mysql_fetch_array(mysql_query("SELECT user_id, concertos FROM Utilizadores WHERE user_id={$user_id}"))["concertos"];
		$concertos = unserialize($concertos);
		if ($concertos) {
			array_push($concertos, $data."-".$titulo."-".$local);
		} else {
			$concertos = array();
			array_push($concertos, $data."-".$titulo."-".$local);
		}
		$concertos = serialize($concertos);
		mysql_query("UPDATE Utilizadores SET concertos='{$concertos}' WHERE user_id={$user_id}");
	}
	function br2nl($string) {
		return preg_replace("/<br\W*?\/>/", "\n", $string);
	}
	function my_nl2br($string) {
		return preg_replace("/\r\n|\r|\n/",'<br/>', $string);
	}
?>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Virtuoso | Q&amp;A</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="shortcut icon" href="images/logo.svg" />
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="bootstrap/css/bootstrap_theme.min.css">
		<link rel="stylesheet" href="assets/jquery-ui/jquery-ui.min.css">
		<link rel="stylesheet" href="assets/jquery-ui/jquery-ui.theme.min.css">	
		<link rel="stylesheet" media="all" type="text/css" href="assets/jquery-ui/jquery-ui-timepicker-addon.css">	
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
		<style>
		@font-face { font-family: 'Cinzel Decorative'; src: url('/assets/fonts/CinzelDecorative-Regular.ttf'); }
		.virtuoso {
			font-family: 'Cinzel Decorative', cursive;
			color: #3b5998;
		}
		body { 
			padding-bottom: 70px; 
		}
		.concertos {
			min-height: 310px;
			background-color: white;
			border-radius: 5px;
		}
		/* Perguntas */
			.square {
			margin-top: 1%;
		}
		.data {
			padding: 0 5% 1% 0;
			font-size: 15px;
			color: gray;
		}
		.info_card {
			vertical-align: middle;
		}
		.num {
			font-weight: bold;
			font-size: 17px;
		}
		/* end Perguntas */
		/* Respostas */
		.profile_image {
			width: 50px;
			height: 50px;
			border-radius: 50%;
		}
		.data {
			padding: 0 5% 1% 0;
			font-size: 15px;
			color: gray;
		}
		.body, .body_resp {
			min-height: 150px;
			text-align: justify;
		}
		.body_resp {
			padding: 0 2% 0 0;
		}
		.content {
			border-bottom: 1px solid grey;
		}
		.glyphicon:hover, a:hover {
			cursor: hand;
			cursor: pointer;
		}
		#sing_resp {
			/*margin-top: 5%;*/
		}
		textarea {
			min-height: 350px;
		}
		/*end Respostas */
		</style>
	</head>
<body>

<div class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="welcome.php"><span class="virtuoso" style="color: white">Virtuoso</span></a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="loja_main.php">Loja</a></li>
        <li><a href="q_and_a_main.php">Q&amp;A</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class=<?php echo ($proprio_perfil ? "active" : "" )?>><a href="user_details.php?id=<?php echo $user_id ?>">A minha conta</a></li>
        <li><a href="logout.php">Terminar Sessão</a></li>
        <li><a href="ajuda.php">Ajuda</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>

<div class="container">
<?php
if ($empresa) {
	include 'user_details_empresa.php';
} else {
	include 'user_details_user.php';
}
?>
</div> <!-- /container -->

	<!-- script references -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/jquery-ui/jquery-ui.min.js"></script>
		<script src="assets/jquery-ui/jquery-ui-timepicker-addon-i18n.min.js"></script>
		<script src="assets/jquery-ui/jquery-ui-timepicker-addon.js"></script>
		<script src="assets/jquery-ui/jquery-ui-sliderAccess.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			$('frame').css('width', $('.modal-dialog').width()+'px');
			$('#dateTime_picker').datetimepicker({
				timeFormat: "HH:mm",
				dateFormat: "dd/mm/yy"
			});
		</script>
	</body>
</html>