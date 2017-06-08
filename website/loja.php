<?php
		include 'facebook_user_data.php';
?>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Virtuoso | Loja</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="shortcut icon" href="images/logo.svg" />
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="bootstrap/css/bootstrap_theme.min.css">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
		<style>
		@font-face { font-family: 'Cinzel Decorative'; src: url('/assets/fonts/CinzelDecorative-Regular.ttf'); }
		.virtuoso, h1{
			font-family: 'Cinzel Decorative', cursive;
			color: #3b5998;
		}
		.navbar {
			margin-bottom: 0px !important;
		}
		body { 
			padding-bottom: 70px; 
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
			margin-top: 10%;
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

<div class="container">
<?php 	
$filtro = $_POST["filtro"];
if ($filtro != 'guitarra' && $filtro != 'piano' && $filtro != 'saxofone' && $filtro != 'outro') {
	$filtro = "";
} else {
	$filtro_name = $filtro;
	$filtro = "WHERE categoria='".$filtro."'";
}
?>
<div class="pesquisa col-xs-12">
	<form method="post" action="loja.php">
		  <div class="form-group col-xs-12 col-md-10 input">
		    <input type="text" class="form-control" name="query" id="query" value="<?php echo $_POST["query"] ?>">
		    <input type="hidden" name="filtro" value="<?php echo $filtro_name?>">
		  </div>
		  <button type="submit"class="btn btn-warning col-md-2">Pesquisar</button>
	</form>
</div>
<ul class="nav nav-tabs navbar-left">
	<button class="btn btn-info" onclick="location='criar_anuncio.php'">Criar Anúncio</button>
</ul>


<div class="anuncios">
	<ul class=" nav nav-tabs navbar-right">
		<?php 
		$q = $_POST["query"];
		if (isset($q)) { ?> 
		<li id="todas"><a>Todas</a></li>
		<?php }?>
	</ul>
	<form action="" method="POST" id="todas_li">
			<input type="hidden" name="filtro" value="<?php echo $filtro_name ?>">
	</form>
	<hr class="col-xs-12">
   <?php
	include_once('db.php');
	if (isset($q)) {
		$q = explode(" ", $q);
		$sql = "SUM(";
		for ($i = 0; $i < sizeof($q); $i++ ) {
			$termo = mysql_real_escape_string(htmlspecialchars($q[$i]));
			$len = strlen($termo);
			if ($i == sizeof($q) - 1) {
				$sql .= "((LENGTH( titulo ) - LENGTH( REPLACE( UPPER(titulo) , UPPER('{$termo}'), '' ) ) ) /{$len}))";
			} else {
				if ($len <= 1) {continue;}
				$sql .= "((LENGTH( titulo ) - LENGTH( REPLACE( UPPER(titulo) , UPPER('{$termo}'), '' ) ) ) /{$len})+";
			}
		}
		$anuncios = mysql_query("SELECT ({$sql}) AS Occurrences, id, user_id, data, titulo, main_img
		FROM Anuncios ".$filtro." GROUP BY id HAVING Occurrences > 0 ORDER BY Occurrences DESC");
		$num_resultados = mysql_num_rows($anuncios);
	} else {
		$anuncios = mysql_query("SELECT `id`,`user_id`, `titulo`,`data`, `main_img` FROM Anuncios ".$filtro." ORDER BY DATA DESC");
	}
	if ($row = mysql_fetch_array($anuncios)) {
		$temp_resultados_str =  $num_resultados == 1 ? "resultado" : "resultados";
		if (isset($q)) {echo "<h3 class='col-xs-12'>".$num_resultados." ".$temp_resultados_str."</h3><hr class='col-xs-12'>";}
		while ($row) {
   ?>
<div class="card card-outline-primary mb-3 text-center col-xs-12">
  <div class="card-block hidden-xs col-sm-3 info_card text-center">
		  <?php if ($row['main_img'] == null) {
		  	echo '<img src="http://www.pchelthgf.com/main/images/noimage_left.jpg" class="col-xs-12 img-responsive" style="max-height: 140px;">';
		  } else {
		  	echo '<img src="data:image; base64,'.$row['main_img'].'" class="col-xs-12 img-responsive" style="max-height: 160px;">';
		  }?>
  </div>
  
  <div class="card-block col-xs-9">
    <blockquote class="card-blockquote text-left" style="height: 140px;">
      <h4><a style="color:white" href="anuncio_details.php?id=<?php echo $row['id']; ?>"><?php echo $row['titulo']?></a></h4>
	  <div class="text-right">
  		  <small style="color: #6497b1;">
  		  por 
  		  <?php 
  		  		$user = mysql_fetch_row(mysql_query("SELECT `nome` FROM Utilizadores WHERE user_id={$row['user_id']}"));
  		  		echo "<a href='user_details.php?id=".$row['user_id']."'>".$user[0]."</a> , ";
  		  		$data_split = str_split(str_split($row['data'], 16)[0], 10);
				echo $data_split[0]." às ".$data_split[1];
 		  ?>
		  </small>
  	  </div>
	</blockquote>
  </div>
</div>
 <hr class="col-xs-12">
	<?php $row = mysql_fetch_array($anuncios); }}
	  if (isset($q) && $num_resultados == 0) {echo "<br /> <h3 class='col-xs-12'>A sua pesquisa não obteve resultados.</h3>";}?>	
</div>

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
				$("#todas").click(function() {
					$("#todas_li").submit();
				})
		</script>
	</body>
</html>
