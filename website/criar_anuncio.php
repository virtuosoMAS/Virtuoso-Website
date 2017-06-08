<?php
	include_once 'facebook_user_data.php';
	include 'db.php';
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
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<style>
	body, html {
		max-width:100%;
	}
		@font-face { font-family: 'Cinzel Decorative'; src: url('/assets/fonts/CinzelDecorative-Regular.ttf'); }
	.virtuoso {
		font-family: 'Cinzel Decorative', cursive;
		color: #3b5998;
	}
	.board {
		margin-top: 0px !important;
		padding: 10px 30px 50px 10px;
		background-color: #d6d6d6;
		color: black;
	}
	.navbar {
		margin-bottom: 0px !important;
	}
	.form-group {
		margin: 30px 0 30px 0;
	}
	.imagem, .main_imagem {
		padding-top: 20px;
		text-align: center;
		background-color: grey;
		border: 1px dashed black;
		height: 120px;
		color: #3b5998;
		background-color: white;
		margin: 1px 4px 1px 1px;
		border-radius: 3px;
	}
	.main_imagem {
		height: 241px;
	}
	.main_imagem > a > .glyphicon {
		font-size: 80px;
	}
	.glyphicon {
		font-size: 40px;
		color: grey;
	}
	label {
		text-align: left;
		font-size: 17px;
	}
	.left {
		padding-right: 50px;
	}
	#picture1, #picture2, #picture3, #picture4, #main_picture {
    	display:none;
    }
    a:hover {
    	cursor: pointer;
    }
    ::-moz-placeholder {  
   		font-style: italic; 
	}
	.spec {
		margin-bottom: 10px;
	}
	.spec_title {
		background-color: #4b86b4;
		text-align:center;
		padding-top:5px;
	}
	.spec_desc {
		border: 1px solid #4b86b4;
		text-align:center;
		min-height: 30px;
		padding-top:5px;
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

<div class="container-fluid board">
<form action="upload_anuncio.php" onsubmit="return validateForm();" method="post" class="form-horizontal" enctype="multipart/form-data" id="form_anuncio">
	<div class="left col-xs-6">
	<div class="form-group">
	<?php if (isset($_GET["categoria"])) { 
  	$categoria = mysql_real_escape_string(htmlspecialchars($_GET["categoria"]));
  	$specs = mysql_query("SELECT * FROM Especificacoes WHERE instrumento='{$categoria}'");
	} else {
		$specs = false;
	}?>
			<label for="categoria" class="control-label col-xs-2">Categoria:</label>
			<div class="col-xs-10">
	  			<div class="dropdown">
	 			<button class="btn btn-info btn-block dropdown-toggle" type="button" data-toggle="dropdown">
	 			<?php if ($specs) {
					echo $categoria."&nbsp;";
	 				echo "<input type='hidden' name='categoria' id='categoria' value='$categoria'>";
	 			} else {
					echo "<input type='hidden' name='categoria' id='categoria' value='outro'>";
					echo "Selecione uma categoria";}?>
	  			<span class="caret" style="text-align:right"></span></button>
	  			<ul class="dropdown-menu col-xs-12">
	   	 			<li><a href="?categoria=guitarra">Guitarra</a></li>
	    			<li><a href="?categoria=piano">Piano</a></li>
	    			<li><a href="?categoria=saxofone">Saxofone</a></li>
	    			<li><a href="?categoria=outro">Outro</a></li>
	  			</ul>
	  			</div>
			</div>
  	</div>
	<div class="form-group">
    		<label class="control-label col-xs-2" for="titulo">Título:</label>
    		<div class="col-xs-10">
				<input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título do Anúncio">
				<div id="erro_titulo" style="display: none;" class="text-danger"><br />O Título deve contêr pelo menos 5 caracteres!</div>
			</div>
  	</div>

  	<?php if ($specs && $categoria != "outro") {?>
   	<div class="form-group">
 			<label for="especificacoes" style="text-align:left; margin-bottom: 10px;" class="control-label col-xs-12">Especificações:</label>
 			<div class="input-group col-xs-offset-2 col-xs-10">
			<?php
 			//$i = 0;
 			$specs = mysql_fetch_array($specs);
 			$specs = explode(",", $specs["specs"]);
 			foreach ($specs as $spec_name) { ?>
 			<div class="col-xs-12" style="margin-bottom: 10px;">
  				<span class="label label-success col-xs-4" id="spec"><h5><?php echo trim($spec_name)?></h5></span>
  				<input type="text" class="form-control col-xs-8" name="<?php echo trim($spec_name)?>" id="<?php echo trim($spec_name)?>">
  			</div>
<!-- 				<div class="spec col-xs-12"> -->
					<!-- <div class="col-sm-offset-1 col-xs-12 col-sm-4 spec_title"><?php //echo $spec_name?></div>
<!-- 					<div class="col-xs-12 col-sm-4 spec_desc"> -->
					<!-- 	<input type="text" class="form-control col-xs-12" name="<?php //echo $spec_name?>">
<!-- 					</div>	 -->
<!-- 				</div> -->
			<?php //$i++; 
 			}?>
 			</div>
   	</div>	 
   	<?php }?>
	<div class="form-group">
  		<label for="descricao" class="control-label col-xs-2">Descrição:</label>
  		<div class="col-xs-10">
    		<textarea class="form-control" name="descricao" id="descricao" placeholder="Descrição do instrumento" rows="10"></textarea>
    	</div>
  	</div>
	</div>
	
	<div class="right col-xs-6">
		<div class="form-group">
			<div class="main_imagem col-xs-5" style="text-align: center">
				<input type="file" name="main_picture" id="main_picture" class="upload_main_imagem" size="50">
				<a id="upload_link_main"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
				<h4>Fotografia Principal</h4></a>
				<small id="imageHelper" class="form-text text-muted">(Na página dos resultados, é esta a imagem que aparece)</small>
			</div>
			<div class="imagem col-xs-3">
				<input type="file" name="picture1" id="picture1" class="upload_imagem" size="50">
				<a id="upload_link_1"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
				<h5>Fotografia</h5></a>
			</div>
			<div class="imagem col-xs-3">
				<input type="file" name="picture2" id="picture2" class="upload_imagem" size="50">
				<a id="upload_link_2"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
				<h5>Fotografia</h5></a>
			</div>
			<div class="imagem col-xs-3">
				<input type="file" name="picture3" id="picture3" class="upload_imagem" size="50">
				<a id="upload_link_3"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
				<h5>Fotografia</h5></a>
			</div>
			<div class="imagem col-xs-3">
				<input type="file" name="picture4" id="picture4" class="upload_imagem" size="50">
				<a id="upload_link_4"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
				<h5>Fotografia</h5></a>
			</div>
		</div>
		<div class="form-group">
			<label for="video" class="control-label col-xs-2" style="text-align: left;">Vídeo:</label>
			<div class="col-xs-9">
				<input type="text" class="form-control" name="video" id="video" placeholder="Ex: https://www.youtube.com/watch?v=mBxxQtp5NKU">
			</div>
		</div>
		<div class="form-group">
			<label for="localizacao" class="control-label col-xs-2" style="text-align: left;">Localização:</label>
			<div class="col-xs-9">
				<input type="text" class="form-control" name="localizacao" id="localizacao" placeholder="Ex: Lisboa, Porto, Faro, etc.">
			</div>
		</div>
		<label for="preco" class="control-label col-xs-3" style="text-align: left;">Preço:</label>
		<div class="input-group col-xs-8">
  				<input type="text" class="form-control" style="text-align: right;" name="preco" id="preco">
  				<span class="input-group-addon">€</span>
  				<div class="input-group col-xs-12">
	  				<select class="form-control" name="tipo_de_venda" id="tipo_de_venda">
		    			<option>Negociável</option>
		    			<option>Preço Fixo</option>
		    			<option>Maior Oferta</option>
		  			</select>
		  		</div>
		</div>
		<div id="erro_preco" style="display: none;" class="text-danger"><br />O Preço deve contêr apenas dígitos</div>
		<div class="form-group">
			<label for="condicao" class="control-label col-xs-2" style="text-align: left;">Condição:</label>
			<div class="col-xs-9">
	  			<select class="form-control" name="condicao" id="condicao">
		    		<option>Novo</option>
		   			<option value="Semi-Novo" >Semi-Novo</option>
		   			<option selected="selected">Usado</option>
				</select>
			</div>
		</div>
		
		<div class="form-group">
  		<label for="otherinfo" class="control-label col-xs-2" style="text-align: left;">Outras Informações:</label>
  		<div class="col-xs-9">
    		<textarea class="form-control" name="otherinfo" id="otherinfo" rows="10"></textarea>
    	</div>
  	</div>
		<br />
			<input  type="hidden" name="user_id" value="<?php echo $user_id; ?>">
			<button type="submit" class="btn btn-primary">Publicar Anúncio</button>
			<button type="button" onclick="window.location = window.location.href;" class="btn btn-danger">Limpar Dados</button>
	</div>
</form>

</div> <!-- /container -->



	<!-- script references -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/js/upload_image.js"></script>
		<script type="text/javascript">
				function validateForm() {
					var Valido = true;
					$("#erro_titulo").css("display", "none");
					$("#erro_preco").css("display", "none");
					
					var body = $("#preco").val().trim();
					var title = $("#titulo").val().trim();
					
					if (isNaN(body) || body.length == 0) {
						$("#erro_preco").css("display", "inline");
						Valido = false;
					}
					if (title.length < 5) {
						$("#erro_titulo").css("display", "inline");
						Valido = false;
					}
					return Valido;
				}
				$(function(){
					$("#upload_link_main").on('click', function(e){
					    e.preventDefault();
					    $("#main_picture:hidden").trigger('click');
					});
					$("#upload_link_1").on('click', function(e){
					    e.preventDefault();
					    $("#picture1:hidden").trigger('click');
					});
					$("#upload_link_2").on('click', function(e){
					    e.preventDefault();
					    $("#picture2:hidden").trigger('click');
					});
					$("#upload_link_3").on('click', function(e){
					    e.preventDefault();
					    $("#picture3:hidden").trigger('click');
					});
					$("#upload_link_4").on('click', function(e){
					    e.preventDefault();
					    $("#picture4:hidden").trigger('click');
					});
				});
		</script>
	</body>
</html>
