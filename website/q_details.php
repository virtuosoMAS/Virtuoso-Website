<?php
	include 'facebook_user_data.php';
	include_once('db.php');
	$ownQuestion = false;
	$id = htmlspecialchars($_GET["id"]);
	if (isset($_POST['func_name'])) {
		$args = explode("-", $_POST['func_name']);
		$resp_id = htmlspecialchars($_POST['resposta_id']);
		if ($args[0] == "correta") {
			if ($args[1] != "0") {
				mysql_query("UPDATE Respostas SET `correta`=0 WHERE `id`='{$resp_id}'");
				mysql_query("UPDATE Perguntas SET `respondida`=0 WHERE `id`='{$id}'");
			}
			else {
				mysql_query("UPDATE Respostas SET `correta`=1 WHERE `id`='{$resp_id}'");
				mysql_query("UPDATE Perguntas SET `respondida`=1 WHERE `id`='{$id}'");
			}
		} elseif ($args[0] == "alterarVotos") {
 			$arg_id = $_POST['func_arg_id'];
			$val = $_POST['func_arg_val'];
			if ($args[1] == "Pergunta")
				mysql_query("UPDATE Perguntas SET `votos`={$val} WHERE `id`={$arg_id}");
			else {
				mysql_query("UPDATE Respostas SET `votos`={$val} WHERE `id`={$arg_id}");
			}
		}
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
		<link rel="stylesheet" href="https://bootswatch.com/superhero/bootstrap.min.css">
		<script type="text/javascript" src="abcjs_basic_3.1.2-min.js"></script>
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
		<style>
		@font-face { font-family: 'Cinzel Decorative'; src: url('/assets/fonts/CinzelDecorative-Regular.ttf'); }
		.virtuoso, h1 {
			font-family: 'Cinzel Decorative', cursive;
		}
		body { 
			padding-bottom: 70px; 
		}
		.navbar {
			margin-bottom: 0px !important;
		}
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
		.separador {
			margin-top: 10%;
			border: 1px solid grey;
			background-color: grey;
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
		#sing_resp {
			margin-top: 5%;
		}
		.abcrendered {
			background: white;
			border-radius: 5px;
			margin-top: 50px;
			margin-bottom: 20px;
		}
		.jumbotron {
			padding-left: 10%;
		}
		.jumbo {
			color: #3b5998;
		}
		.jumbo:hover {
			color: #088da5;
		}
		.glyphicon {
			cursor: pointer;
		}
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
        <li class="active"><a href="q_and_a_main.php">Q&amp;A</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="user_details.php?id=<?php echo $user_id ?>">A minha conta</a></li>
        <li><a href="logout.php">Terminar Sessão</a></li>
        <li><a href="ajuda.php">Ajuda</a></li>
      </ul>
    </div><!--/.nav-collapse background-color: #dfcb64-->
  </div>
</div>

<div class="jumbotron text-left container-fluid" style="background-image: url('images/yellow-header.png');opacity: 0.8;background-attachment: fixed;">
	<h1><a href="q_and_a_main.php" style="text-decoration:none;" class="jumbo">Q&amp;A</a></h1>
</div>
<div class="container">

<ul class="nav nav-tabs navbar-right">
	<?php
	$url = $_SERVER['REQUEST_URI'];
	if (strpos($url, "orderBy") != false) {
		$type = $_GET["orderBy"];
	}
	?>
	<li class="<?php echo ($type == 'DATA DESC' ? 'active' : 'inactive' )?>"><a href="?id=<?php echo $id ?>&orderBy=DATA DESC">Recentes</a></li>
	<li class="<?php echo ($type == 'DATA DESC' ? 'inactive' : 'active' )?>"><a href="?id=<?php echo $id ?>&orderBy=DATA ASC">Antigas</a></li>
</ul>
<hr class="col-xs-12">


<div id="pergunta" class="col-xs-12">

	<?php
	$perguntas = mysql_query("SELECT * FROM Perguntas, Utilizadores 
	WHERE Perguntas.id = '{$id}' AND Utilizadores.user_id = Perguntas.user_id");
	if ($row = mysql_fetch_array($perguntas)) {
		if ($row['user_id'] == $user_id) {$ownQuestion = true;}
	?>

	<div class="user col-xs-4 col-sm-4 col-md-3">
	  <div class="col-xs-12 col-sm-9 col-md-8" ><a href="user_details.php?id=<?php echo $row['user_id'] ?>" style="color: white;"><b><?php echo $row['nome']; ?></b></a></div> <!-- Link para a pág. user -->
	  <div class="hidden-xs col-sm-3 col-md-4"><img class="profile_image" src="<?php echo $row['profile_img']; ?>" /></div>
	  <div class="col-xs-12" style="text-align:center;font-size:25px">
	  <form action="" method="POST" id="VotosUp_<?php echo $id?>">
		<input type="hidden" name="func_name" value="alterarVotos-Pergunta">
		<input type="hidden" name="func_arg_id" value="<?php echo $id?>">
		<input type="hidden" name="func_arg_val" value="<?php echo $row['votos']+1?>">
	  </form>
	   <form action="" method="POST" id="VotosDown_<?php echo $id?>">
		<input type="hidden" name="func_name" value="alterarVotos-Pergunta">
		<input type="hidden" name="func_arg_id" value="<?php echo $id?>">
		<input type="hidden" name="func_arg_val" value="<?php echo $row['votos']-1?>">
	  </form>
	  	<span class="glyphicon glyphicon-chevron-up col-xs-12" aria-hidden="true" onclick="votosUp(<?php echo $row['id'] ?>)"></span>
	  	<span class="votos"><?php echo $row['votos'] ?></span>
	  	<span class="glyphicon glyphicon-chevron-down col-xs-12" aria-hidden="true" onclick="votosDown(<?php echo $row['id'] ?>)"></span>
	  </div>
	</div>
	<div class="col-xs-8 col-sm-8 col-md-9">
		  <p style="font-size: 25px;"><?php echo $row['titulo']; ?></p>
		  <br />
		  <div class="body">
			 <p><?php echo $row['corpo']; ?></p>
		  </div>
		  <div class="data text-right">
			  <?php 
			  $data_split = str_split(str_split($row['data'], 16)[0], 10);
			  echo $data_split[0]." às ".$data_split[1]; 
			  ?>
		  </div>
	</div>
	<?php } else {
		header('Location: q_and_a_main.php');
	} ?>

</div>

<div id="respostas" class="col-xs-12">

	<?php
	include_once('db.php');
	if ($type === 'DATA ASC' || $type === 'DATA DESC') { 
		$respostas = mysql_query("SELECT * FROM Respostas, Utilizadores
		WHERE Respostas.q_id = '{$id}' AND Utilizadores.user_id = Respostas.user_id ORDER BY correta DESC, $type");	
	} else {$respostas = mysql_query("SELECT * FROM Respostas, Utilizadores
			WHERE Respostas.q_id = '{$id}' AND Utilizadores.user_id = Respostas.user_id ORDER BY correta DESC, data ASC");}
	$num_respostas = mysql_num_rows($respostas);
	?>
	<div>
		<br />
		<h4><b><?php echo $num_respostas.($num_respostas == 1 ? " Resposta" : " Respostas")?></b></h4>
		<hr style="margin: 0; border-bottom: 1px dashed;"/>
	</div>
	<?php
	while ($row = mysql_fetch_array($respostas)) {
		$class = ($row['correta']) ? "btn-success" : "btn-default";
	?>
	
	<div id="sing_resp" class="col-xs-12">
		<div class="user col-xs-4 col-sm-4 col-md-3">
			  <div class="col-xs-12 col-sm-8 col-md-8"><a href="user_details.php?id=<?php echo $row['user_id'] ?>" style="color: white;"><b><?php echo $row['nome']; ?></b></a></div> <!-- Link para a pág. user -->
			  <div class="hidden-xs col-sm-4 col-md-4"><img class="profile_image" alt="IMG" src="<?php echo $row['profile_img']; ?>"></div>
			  <?php if ($ownQuestion) { ?>
			  <form action="" method="post">
			  	<button class="<?php echo "btn ".$class." responde" ?>" style="border-radius: 50%;color: white; margin: 10px 0 0 10px;">
			  		<span class="glyphicon glyphicon-ok"></span>
			  	</button>
			  	<input type="hidden" name="resposta_id" value="<?php echo $row['id']?>">
			  	<input type="hidden" name="func_name" value="correta-<?php echo $row['correta']?>">
			  </form>
			  <?php } else {
			  	if ($row['correta']) { ?>
			  		<button class="btn btn-success" style="border-radius: 50%;color: white; margin: 10px 0 0 10px;">
			  			<span class="glyphicon glyphicon-ok"></span>
			  		</button>
			  <?php }
			  }?>
			  <form action="" method="POST" id="VotosUp_<?php echo $row['id'] ?>">
				<input type="hidden" name="func_name" value="alterarVotos">
				<input type="hidden" name="func_arg_id" value="<?php echo $row['id']?>">
				<input type="hidden" name="func_arg_val" value="<?php echo $row['votos']+1?>">
		  	  </form>
	   		  <form action="" method="POST" id="VotosDown_<?php echo $row['id'] ?>">
				<input type="hidden" name="func_name" value="alterarVotos">
				<input type="hidden" name="func_arg_id" value="<?php echo $row['id']?>">
				<input type="hidden" name="func_arg_val" value="<?php echo $row['votos']-1?>">
	  		  </form>
			    <div class="col-xs-12" style="text-align:center;font-size:25px">
	  			<span class="glyphicon glyphicon-chevron-up col-xs-12" aria-hidden="true" onclick="votosUp(<?php echo $row['id'] ?>)"></span>
	  			<span id="votos<?php echo $row['id'] ?>"><?php echo $row['votos'] ?></span>
	  			<span class="glyphicon glyphicon-chevron-down col-xs-12" aria-hidden="true" onclick="votosDown(<?php echo $row['id'] ?>)"></span>
	  </div>
		</div>
		<div class="content col-xs-8 col-sm-8 col-md-9">
			  <div class="body_resp">
				 <p><?php echo $row['corpo'] ?></p>
			  </div>
			  <div class="data text-right">
			  	<?php
					$data_split = str_split(str_split($row['data'], 16)[0], 10);
					echo $data_split[0]." às ".$data_split[1];
				?>
				</div>

		</div>
	</div>

	<?php }?>

</div>

	<hr class="separador col-xs-12"/>
	<div class="responder col-xs-12">
		<h3 class="col-xs-12"><b>Sabes a Resposta?</b></h3>
		<br />
		<form id="pergunta" onsubmit="return validateForm();return false;" action="upload_a.php" method="post" class="col-xs-12">
			<div class="form-group">
				<label for="exampleTextarea"><h4>Mensagem:</h4></label>
    			<textarea class="form-control" name="corpo" id="corpo" placeholder="Descrição da Resposta" rows="10"></textarea>
  			</div>
			<input type="hidden" name="q_id" value=<?php echo $id;?>>
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
			<button type="submit" class="btn btn-primary">Publicar Resposta</button>
			<div id="error" style="display: none;" class="text-danger"><br />A resposta deve contêr pelo menos 20 caracteres!</div>
		</form>
	</div>
</div> <!-- /container -->


	<!-- script references -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript">
				function validateForm() {
					var body = $("#corpo").val();
					if (body.length >= 20) {
						console.log("sucess");
						return true;
					} else {
						$("#error").css("display", "inline");
						console.log("error");
						return false;
					}
				}
				$('.responde').click(function() {
					if ($(this).hasClass('btn-default')) {
				    	$(this).removeClass('btn-default');
				    	$(this).addClass('btn-success');
					} else if ($(this).hasClass('btn-success')) {
						$(this).removeClass('btn-success');
				    	$(this).addClass('btn-default');
					}
				});
				var jaVotou = false;
				$('.glyphicon-chevron-up').click(function() {
					if (!jaVotou) {
						$(this).closest('.votos').html(parseInt($('.votos').html())+1);
					}
					jaVotou = true;
				});
				$('.glyphicon-chevron-down').click(function() {
					if (jaVotou) {
						$(this).closest('.votos').html(parseInt($('.votos').html())-1);
						jaVotou = false;
					}
				});
				function votosUp(id) {
					document.getElementById('VotosUp_'+id).submit();
				}
				function votosDown(id) {
					if (parseInt(document.getElementById('votos'+id).innerHTML) > 0)
						document.getElementById('VotosDown_'+id).submit();
				}
		</script>
		<?php 	
		$per = mysql_fetch_array(mysql_query("SELECT views, data FROM Perguntas WHERE id='{$id}'"));
		$num_views = $per["views"]+1;
		$data = $per["data"];
		if (!mysql_query("UPDATE Perguntas SET views='{$num_views}', data='{$data}' WHERE id='{$id}'")) {
			echo "choriço";
		}
		?>
	</body>
</html>