<?php 
	include_once 'facebook_user_data.php';
?>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Virtuoso</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="shortcut icon" href="images/logo.svg" />
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="bootstrap/css/bootstrap_theme.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<style>
	@font-face { font-family: 'Cinzel Decorative'; src: url('/assets/fonts/CinzelDecorative-Regular.ttf'); }
	.virtuoso {
		font-family: 'Cinzel Decorative', cursive;
		color: #3b5998;
	}
	.fb_button {
		background-color:#3b5998;
		color: white; 
		height: 40px; 
		line-height:40px; 
		padding:0 3px 0 3px;
		border-radius: 1px;
		margin-top: 80px;
	}
	.fb_button > a {
		text-decoration:none;
		color:white;
	}
	.well {
		margin-top: 10%;
		background-color: white; 
		height: 400px;
		border-radius: 5px;
		-moz-box-shadow:    3px 3px 5px 3px #505050;
  		-webkit-box-shadow: 3px 3px 5px 3px #505050;
  		box-shadow:         3px 3px 5px 3px #505050;
	}
	.QA, .Loja {
		height: 200px;
		text-align: center; 
		vertical-align: middle;
		border-radius: 2px;
	}
	.QA:hover, .Loja:hover {
		opacity: 0.5;
		cursor: hand;
		cursor: pointer;
	}
	.QA {background-color: #dfcb64;}
	.Loja {background-color: #55a191;}
	.square_text {
		position: relative;
		top: 40%;
		transform: translateY(-50%); 
		color: white;
	}
	</style>
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
        <li><a href="user_details.php?id=<?php echo $user_id ?>">A minha conta</a></li>
        <li><a href="logout.php">Terminar Sessão</a></li>
        <li><a href="ajuda.php">Ajuda</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>

<div class="container">
	
		<header>
			<h1>Bem Vindo ao <em class="virtuoso" style="color:white">Virtuoso</em>, &nbsp;<?php echo $user_name; ?> !</h1>
			<p>Nesta plataforma, tens à tua disposição uma parte de Q&amp;A onde podes partilhar e tirar partido do conhecimento sobre a música.
			E uma componente de Comércio Eletrónico(Loja) onde é possível comprar e vender instrumentos musicais e outros produtos relacionados com a música.</p>
			<p>Este projeto foi concebido por alunos da Universidade de Aveiro no âmbito da disciplina <em>Modelação e Análise de Sistemas</em>, qualquer 
			dúvida que possua, dirija-se à página de Ajuda, ou contacte o administrador: <a href="mailto:virtuoso_mas@protonmail.ch">virtuoso_mas@protonmail.ch</a>.</p>
		</header>
		<br /><br /><br />
		<a href="loja_main.php"><div class="Loja col-xs-5"><h1 class="square_text">Loja</h1></div></a>
		<div class="col-xs-2"></div>
		<a href="q_and_a_main.php"><div class="QA col-xs-5"><h1 class="square_text">Q&amp;A</h1></div></a>

</div> <!-- /container -->

	<!-- script references -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript">
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
		</script>
	</body>
</html>
