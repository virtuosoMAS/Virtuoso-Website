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
		<script type="text/javascript" src="abcjs_basic_3.1.2-min.js"></script>
		<link href="css/styles.css" rel="stylesheet">
		<style>
		@font-face { font-family: 'Cinzel Decorative'; src: url('/assets/fonts/CinzelDecorative-Regular.ttf'); }
		.virtuoso, h1 {
			font-family: 'Cinzel Decorative', cursive;
		}
		.navbar {
			margin-bottom: 0px !important;
		}
		body { 
			padding-bottom: 70px; 
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
		.spec {
			margin-bottom: 10px;
		}
		.ver_imagens:hover {
			opacity: 0.4;
			cursor: pointer;
		}
		.ver_imagens {
			height: 100px;
			background-color:grey;
			opacity: 0.9;
			text-align: center;
			vertical-align: middle;
		}
		.carousel-control.left, .carousel-control.right {
   			background-image:none !important;
   			filter:none !important;
   			color: grey;
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
    </div><!--/.nav-collapse background-color: #dfcb64-->
  </div>
</div>

<div class="jumbotron text-left container-fluid" style="background-image: url('images/green_header.png');opacity: 0.8;background-attachment: fixed;">
	<h1><a href="loja_main.php" style="text-decoration:none;" class="jumbo">Loja</a></h1>
</div>
 	<?php
	include_once('db.php');
	$id = htmlspecialchars($_GET["id"]);
	$anuncios = mysql_query("SELECT * FROM Anuncios, Utilizadores 
	WHERE Anuncios.id = '{$id}' AND Utilizadores.user_id = Anuncios.user_id");
	if ($row = mysql_fetch_array($anuncios)) {
	?>
<div class="container">
<div class="anuncio col-xs-12">
	<div class="main_img col-xs-8">
	<?php if ($row['main_img'] == null) {
		$main_img_src = "http://www.pchelthgf.com/main/images/noimage_left.jpg";
	} else {
		$main_img_src = "data:image; base64,".$row['main_img'];
			  } ?>
	<img src="<?php echo $main_img_src ?>" id="main_img" class="img-responsive" width="700">
	<?php $data_split = str_split(str_split($row['data'], 16)[0], 10);?>
	<h3><a href="#anuncio_info"><?php echo $row["titulo"]?></a><br ><small><?php echo $row["localizacao"]?> | Publicado às <?php echo $data_split[1].", ".$data_split[0]?></small></h3>
	</div>
	
	<blockquote class="col-xs-4" style="text-align: center;">
		<h2><?php echo $row["preco"]." €"?></h2><br /><br />
		<img src="<?php echo $row["profile_img"]?>" style="width:100px; height:100px; border-radius:50%;">
		<a href="user_details.php?id=<?php echo $row["user_id"]?>"><h4><?php echo $row["nome"]?></h4></a>
		<br />
		<a href="mailto:<?php echo $row["email"]?>"><button class="btn btn-lg btn-info">Contactar Vendedor</button></a>
		<br /><br />
		<a href="loja_main.php"><button class="btn btn-lg btn-success" style="background: none;border: 2px solid white; color: #8cd2e7">Voltar aos anúncios</button></a>
	</blockquote>
	
	<hr class="separador col-xs-11">
	
	<div class="anuncio_info col-xs-12" id="anuncio_info">
		<?php 
		$especificacoes = unserialize($row["especificacoes"]);
		if ($especificacoes) {?>
		<input id="number_of_specs" type="hidden" style="display:none" value="<?php echo sizeof($especificacoes)?>">
		<h3><u>Especificações</u></h3>
		<div class="especificacoes col-xs-12" style="margin-bottom: 20px">
		<?php 
		$i = 0;
		foreach ($especificacoes as $spec_name => $spec_desc) { ?>
			<div class="spec col-xs-12">
				<div class="col-sm-offset-1 col-xs-12 col-sm-4" id="label_spec<?php echo $i?>" style="background-color: #4b86b4;text-align:center;padding-top:5px;"><?php echo $spec_name?></div>
				<div class="col-xs-12 col-sm-4" id="label_def<?php echo $i?>" style="border: 1px solid #4b86b4;text-align:center;min-height: 30px;padding-top:5px;"><?php echo $spec_desc?></div>	
			</div>
			<br class="col-xs-12">
			<?php $i++;?>
			<?php }?>
		</div>
		<hr class="separador col-xs-11">
		<?php }
		if ($row['descricao'] != '') {
		?>
		<h3><u>Descrição</u></h3>
		<div class="descricao col-xs-11" style="background-color: #5f6d7a; padding: 20px 20px 20px 20px;margin-bottom: 10px;border: 1px dashed black">
			<p><?php echo $row["descricao"] ?></p>
		</div>
		<hr class="separador col-xs-11">
		 <?php
		}
			  $count = 0;
			  $img_array = array();
			  for ($i = 1; $i<=4; $i++) {
			  	if ($row["img_".$i] != null) {
			  		$img_array["img_".$i] = "data:image; base64,".$row['img_'.$i];
			  		$count++;
			  	}
			  } 
			  
			  if ($count > 0 || $row['video'] != '') { ?>
		<h3><u>Multimédia</u></h3>
		<div class="multimedia col-xs-11" style="margin-top: 1%;padding: 20px 20px 20px 20px; border: 1px dashed black; background-color: #717d89; color: white">
			<?php if ($count > 0) { ?>
			         <div id="Carousel" class="carousel slide" data-interval="false" data-ride="carousel">
							  <!-- Indicators -->
							  <?php if ($count != 1) { ?>
							  <ol class="carousel-indicators">
							  <?php
							  for ($i = 0; $i < sizeof($img_array); $i++) {
							  		echo '<li data-target="#Carousel" class="'.($i == 0 ? "active" : "").'" data-slide-to="'.$i.'"></li>';
							  }
							  ?>
							  </ol>
							  <?php } ?>
						  
							  <!-- Wrapper for slides -->
							  <div class="carousel-inner">
							  <?php 
							  $i = "active";
							  foreach ($img_array as $img_name => $img_src) { ?>
								  <div class="item <?php echo $i; $i = "";?>">
								  <img width="100%" style="	height:700px" src="<?php echo $img_src ?>" alt="<?php echo $img_name ?>">
								  </div>
							  <?php } ?>
							  </div>
							  <!-- Left and right controls -->
							  <?php if ($count != 1) { ?>
							  <a class="left carousel-control" href="#Carousel" role="button" data-slide="prev">
							  <span class="glyphicon glyphicon-chevron-left"></span>
							  <span class="sr-only">Anterior</span>
							  </a>
							  <a class="right carousel-control" href="#Carousel" role="button" data-slide="next">
							  <span class="glyphicon glyphicon-chevron-right"></span>
							  <span class="sr-only">Seguinte</span>
							  </a>
							  <?php } ?>
						  </div>

				<?php } 
			if ($row['video'] != '') {
			?>		
			<div class="embed-responsive embed-responsive-16by9 col-xs-offset-1 col-xs-10" style="margin-top: 20px;margin-bottom: 20px">
	  			<iframe class="embed-responsive-item youtube" src="<?php echo $row['video'] ?>"></iframe>
			</div>
			<?php }} ?>
		</div>
	</div>


</div>
</div> <!-- /container -->
	<?php } else {header('Location: loja_main.php');}?>

	<!-- script references -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript">
				$(window).resize(function() {
					$("blockquote").css("min-height",$("#main_img").height());
				})
				$(window).ready(function() {					
					$("blockquote").css("min-height",$("#main_img").height());
					var Nspecs = $("#number_of_specs").val();
					for (var i = 0; i < Nspecs ; i++) {
						$("#label_spec"+i).css("min-height", $("#label_def"+i).height()+7);
					}
					var id = $(".youtube").attr('src').split('watch?v=')[1];
					$(".youtube").attr('src', 'http://www.youtube.com/embed/'+id);
				})
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
				    	$(this).addClass('btn-success');	// UPDATE SQL
					} else if ($(this).hasClass('btn-success')) {
						$(this).removeClass('btn-success');
				    	$(this).addClass('btn-default');
					}
				});
		</script>
		<?php 	
// 		$per = mysql_fetch_array(mysql_query("SELECT views, data FROM Perguntas WHERE id='{$id}'"));
// 		$num_views = $per["views"]+1;
// 		$data = $per["data"];
// 		if (!mysql_query("UPDATE Perguntas SET views='{$num_views}', data='{$data}' WHERE id='{$id}'")) {
// 			echo "choriço";
// 		}
		?>
	</body>
</html>