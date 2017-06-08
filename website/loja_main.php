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
			margin-top: 5%;
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
		.glyphicon:hover {
			cursor:pointer;
			opacity: 0.6;
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
        <li class="active"><a href="loja_main.php">Loja</a></li>
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

<div class="jumbotron text-left container-fluid" style="background-image: url('images/green_header.png'); opacity: 0.9;background-attachment: fixed;">
	<h1><a href="loja_main.php" style="text-decoration:none;" class="jumbo">Loja</a></h1>
</div>
<?php 
include 'db.php';
$anuncios = mysql_query("SELECT `id`,`user_id`, `titulo`,`data`, `main_img`, `empresa` FROM Anuncios ORDER BY DATA DESC");
$i = 0;
while ($row = mysql_fetch_array($anuncios)) {
	$empresa = mysql_fetch_array(mysql_query("SELECT `empresa` FROM Utilizadores WHERE `user_id`={$row['user_id']}"))[0];
	if ($empresa != 0) {
		if ($i == 0) {
			$anuncio1 = $row;
			$i++;
		} elseif ($i == 1) {
			$anuncio2 = $row;
			$i++;
		} elseif ($i == 2) {
			$anuncio3 = $row;
			$i++;
		}
	}
}
?>
<div class="container">
<div class="sugestoes">
	<h2 style="color: lightgrey">Sugestões e Destaques</h2>
	<br />
	<div id="anuncio1" class="card card-outline-primary mb-3 text-center col-xs-12">
	  <div class="card-block hidden-xs col-sm-3 info_card text-center">
			  <?php if ($anuncio1['main_img'] == null) {
			  	echo '<img src="http://www.pchelthgf.com/main/images/noimage_left.jpg" class="col-xs-12 img-responsive" style="max-height: 140px;">';
			  } else {
			  	echo '<img src="data:image; base64,'.$anuncio1['main_img'].'" class="col-xs-12 img-responsive" style="max-height: 140px;">';
			  }?>
	  </div>
	  
	  <div class="card-block col-xs-9">
	    <blockquote class="card-blockquote text-left" style="height: 140px;">
	      <h4><a style="color:white" href="anuncio_details.php?id=<?php echo $anuncio1['id']; ?>"><?php echo $anuncio1['titulo']?></a></h4>
		  <div class="text-right">
	  		  <small style="color: #6497b1;">
	  		  por 
	  		  <?php 
	  		  		$user = mysql_fetch_row(mysql_query("SELECT `nome` FROM Utilizadores WHERE user_id={$anuncio1['user_id']}"));
	  		  		echo "<a href='user_details.php?id=".$anuncio1['user_id']."'>".$user[0]."</a> , ";
	  		  		$data_split = str_split(str_split($anuncio1['data'], 16)[0], 10);
					echo $data_split[0]." às ".$data_split[1];
	 		  ?>
			  </small>
	  	  </div>
		</blockquote>
	  </div>
	</div>
	<div id="anuncio2" style="display:none" class="card card-outline-primary mb-3 text-center col-xs-12">
	  <div class="card-block hidden-xs col-sm-3 info_card text-center">
			  <?php if ($anuncio2['main_img'] == null) {
			  	echo '<img src="http://www.pchelthgf.com/main/images/noimage_left.jpg" class="col-xs-12 img-responsive" style="max-height: 140px;">';
			  } else {
			  	echo '<img src="data:image; base64,'.$anuncio2['main_img'].'" class="col-xs-12 img-responsive" style="max-height: 140px;">';
			  }?>
	  </div>
	  
	  <div class="card-block col-xs-9">
	    <blockquote class="card-blockquote text-left" style="height: 140px;">
	      <h4><a style="color:white" href="anuncio_details.php?id=<?php echo $anuncio2['id']; ?>"><?php echo $anuncio2['titulo']?></a></h4>
		  <div class="text-right">
	  		  <small style="color: #6497b1;">
	  		  por 
	  		  <?php 
	  		  		$user = mysql_fetch_row(mysql_query("SELECT `nome` FROM Utilizadores WHERE user_id={$anuncio2['user_id']}"));
	  		  		echo "<a href='user_details.php?id=".$anuncio2['user_id']."'>".$user[0]."</a> , ";
	  		  		$data_split = str_split(str_split($anuncio2['data'], 16)[0], 10);
					echo $data_split[0]." às ".$data_split[1];
	 		  ?>
			  </small>
	  	  </div>
		</blockquote>
	  </div>
	</div>
	
	<div id="anuncio3" style="display:none" class="card card-outline-primary mb-3 text-center col-xs-12">
	  <div class="card-block hidden-xs col-sm-3 info_card text-center">
			  <?php if ($anuncio3['main_img'] == null) {
			  	echo '<img src="http://www.pchelthgf.com/main/images/noimage_left.jpg" class="col-xs-12 img-responsive" style="max-height: 140px;">';
			  } else {
			  	echo '<img src="data:image; base64,'.$anuncio3['main_img'].'" class="col-xs-12 img-responsive" style="max-height: 140px;">';
			  }?>
	  </div>
	  
	  <div class="card-block col-xs-9">
	    <blockquote class="card-blockquote text-left" style="height: 140px;">
	      <h4><a style="color:white" href="anuncio_details.php?id=<?php echo $anuncio3['id']; ?>"><?php echo $anuncio3['titulo']?></a></h4>
		  <div class="text-right">
	  		  <small style="color: #6497b1;">
	  		  por 
	  		  <?php 
	  		  		$user = mysql_fetch_row(mysql_query("SELECT `nome` FROM Utilizadores WHERE user_id={$anuncio3['user_id']}"));
	  		  		echo "<a href='user_details.php?id=".$anuncio3['user_id']."'>".$user[0]."</a> , ";
	  		  		$data_split = str_split(str_split($anuncio3['data'], 16)[0], 10);
					echo $data_split[0]." às ".$data_split[1];
	 		  ?>
			  </small>
	  	  </div>
		</blockquote>
	  </div>
	</div>
	<hr class="col-xs-12">
	<div class="controls col-xs-12" style="font-size:40px">
		<div class="col-xs-6" style="text-align: left">
			<span class="glyphicon glyphicon-chevron-left"></span>
		</div>
		<div class="col-xs-6" style="text-align: right">
			<span class="glyphicon glyphicon-chevron-right"></span>
		</div>
	</div>
</div>

<hr class="col-xs-12 separador" style="margin-bottom: 50px;">
	<h2 style="color: lightgrey">Categorias</h2>
	<br />
<form action="loja.php" method="post" class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-1 col-lg-3 col-lg-offset-0">
	<input type="hidden" name="filtro" value="guitarra">
	<div class="square col-xs-12">
	<h2>Guitarras</h2>
	<img src="images/guitarra.jpg" class="col-xs-12 chefe">
	</div>
</form>
<form action="loja.php" method="post" class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-1 col-lg-3 col-lg-offset-0">
	<input type="hidden" name="filtro" value="piano">
	<div class="square col-xs-12">
	<h2>Pianos</h2>
	<img src="images/piano.jpg" class="col-xs-12 img_categoria">
	</div>
</form>
<form action="loja.php" method="post" class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-1 col-lg-3 col-lg-offset-0">
	<input type="hidden" name="filtro" value="saxofone">
	<div class="square col-xs-12">
	<h2>Saxofones</h2>
	<img src="images/sax.jpg" class="col-xs-12 img_categoria">
	</div>
</form>
<form action="loja.php" method="post" class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-1 col-lg-3 col-lg-offset-0">
	<input type="hidden" name="filtro" value="outro">
	<div class="square col-xs-12">
	<h2>Outros</h2>
	<img src="images/outro.jpg" class="col-xs-12 img_categoria">
	</div>
</form>

</div> <!-- /container -->

	<!-- script references -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript">
				$(document).ready(function() {
					$(".img_categoria").css("height",$(".chefe").height());
					var anuncios = ["#anuncio1", "#anuncio2", "#anuncio3"];
					var i = 0;
					$(".glyphicon-chevron-left").click(function() {
							if (i == 0) {
								$(anuncios[i]).fadeOut("slow").css("display", "none");
								i = 2;
								$(anuncios[i]).fadeIn("slow").css("display", "block");
							} else {
								$(anuncios[i]).fadeOut("slow").css("display", "none");
								i--;
								$(anuncios[i]).fadeIn("slow").css("display", "block");
							}
					})
					$(".glyphicon-chevron-right").click(function() {
							if (i == 2) {
								$(anuncios[i]).fadeOut("slow").css("display", "none");
								i = 0;
								$(anuncios[i]).fadeIn("slow").css("display", "block");
							} else {
								$(anuncios[i]).fadeOut("slow").css("display", "none");
								i++;
								$(anuncios[i]).fadeIn("slow").css("display", "block");
							}
					})
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
		</script>
	</body>
</html>
