<?php
include 'facebook_user_data.php';
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
		<link href="css/styles.css" rel="stylesheet">
		<style>
		@font-face { font-family: 'Cinzel Decorative'; src: url('/assets/fonts/CinzelDecorative-Regular.ttf'); }
		.virtuoso, h1{
			font-family: 'Cinzel Decorative', cursive;
			color: #3b5998;
		}
		body { 
			padding-bottom: 70px; 
		}
		.navbar {
			margin-bottom: 0px !important;
		}
		.header {
			margin-top: 10%;
		}
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
		.separador {
			border: 1px solid grey;
			background-color: grey;
		}
		footer {
    		position: absolute;
    		width: 100%;
    		bottom: 0;
    		display: inline-block;
		}
		.pesquisa {
			margin-bottom: 10px;
			padding-left: 0px;
			padding-right: 0px;
		}	 
		.input {
			padding-left: 0px;
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
		.square {
			text-align: center;
		}
		.square:hover {
			opacity: 0.6;
		}
		.img_categoria, .chefe {
			border-radius: 5px;
			background-color: white;
			height: 220px;
		}
		.img_categoria:hover, .chefe:hover{
			cursor:pointer;
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
    </div><!--/.nav-collapse -->
  </div>
</div>

<div class="jumbotron text-left container-fluid" style="background-image: url('images/yellow-header.png');opacity: 0.9;background-attachment: fixed;">
	<h1><a href="q_and_a_main.php" style="text-decoration:none;" class="jumbo">Q&amp;A</a></h1>
</div>
<div class="container">
<h2 style="color: lightgrey">Categorias</h2>
<hr class="col-xs-12 separador">
<form action="q_and_a.php" method="post" class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-1 col-lg-3 col-lg-offset-0">
	<input type="hidden" name="filtro" value="teoria">
	<div class="square col-xs-12">
	<h2>Teoria</h2>
	<img src="images/teoria.jpg" class="col-xs-12 chefe">
	</div>
</form>
<form action="q_and_a.php" method="post" class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-1 col-lg-3 col-lg-offset-0">
	<input type="hidden" name="filtro" value="geral">
	<div class="square col-xs-12">
	<h2>Geral</h2>
	<img src="images/geral.jpg" class="col-xs-12 img_categoria">
	</div>
</form>
<form action="q_and_a.php" method="post" class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-1 col-lg-3 col-lg-offset-0">
	<input type="hidden" name="filtro" value="notacao_abc">
	<div class="square col-xs-12">
	<h2>Notação ABC</h2>
	<img src="images/abcnotation.png" class="col-xs-12 img_categoria">
	</div>
</form>
<form action="q_and_a.php" method="post" class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-1 col-lg-3 col-lg-offset-0">
	<input type="hidden" name="filtro" value="tecnico">
	<div class="square col-xs-12">
	<h2>Técnico</h2>
	<img src="images/tecnico.jpg" class="col-xs-12 img_categoria">
	</div>
</form>
	<hr class="separador col-xs-12"/>
	<div class="responder col-xs-12">
		<h3 class="col-xs-12"><b>Tens Alguma Dúvida?</b></h3>
		<br />
		<form id="pergunta" onsubmit="return validateForm();return false;" action="upload_q.php" method="post" class="col-xs-12">
			<div class="form-group">
    		<label for="exampleInputEmail1"><h4>Título:</h4></label>
			<input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título da Pergunta">
  			</div>
			<div class="form-group">
				<label for="exampleTextarea"><h4>Pergunta:</h4></label>
    			<textarea class="form-control" name="corpo" id="corpo" placeholder="Descrição da Pergunta" rows="10"></textarea>
  			</div>
  			<div class="form-group">
  			<h4>Categoria:</h4>
				<label class="radio-inline col-xs-offset-2 col-xs-2"><input type="radio" value="teoria" name="categoria"><h4>&nbsp;Teoria</h4></label>
	  			<label class="radio-inline col-xs-2"><input type="radio" name="categoria" value="geral"><h4>&nbsp;Geral</h4></label>
	  			<label class="radio-inline col-xs-2"><input type="radio" name="categoria" value="notacao_abc"><h4>&nbsp;Notação ABC</h4></label>
	  			<label class="radio-inline col-xs-2"><input type="radio" name="categoria" value="tecnico"><h4>&nbsp;Técnico</h4></label>
			</div>
			<br />
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
			<br />
			<span class="col-xs-12" style="padding-left: 0 !important"><button type="submit" class="btn btn-primary">Publicar Pergunta</button></span>
			<div id="error" style="display: none;" class="text-danger"><br />O Título deve contêr pelo menos 10 caracteres!<br />A pegunta deve contêr pelo menos 20 caracteres!</div>
		</form>
	</div>
</div> <!-- /container -->

	<!-- script references -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript">
				$(document).ready(function() {
					$(".img_categoria").css("height",$(".chefe").height());
				})
				$(window).resize(function() {
					$(".img_categoria").css("height",$(".chefe").height());
				})
				function validateForm() {
					var body = $("#corpo").val();
					var title = $("#titulo").val();
					if (body.length >= 20 && title.length >= 10) {
						console.log("sucess");
						return true;
					} else {
						$("#error").css("display", "inline");
						console.log("error");
						return false;
					}
				}
				$(".square").click(function() {
					$(this).parents("form").submit();
				})
// 				function search() {
// 					var query = $("#termo").val().trim();
// 					if (query.length >= 3) {
// 						windon.location("?q="+query);
// 						return true;
// 					}
// 				}
		</script>
	</body>
</html>
