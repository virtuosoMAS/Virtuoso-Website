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
		<style>
		@font-face { font-family: 'Cinzel Decorative'; src: url('/assets/fonts/CinzelDecorative-Regular.ttf'); }
		.virtuoso {
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
		.code_example {
			padding: 20px 0 20px 20px;
			color: black;
			background-color:white;
			border-radius: 5px;
			margin-bottom: 30px;
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
        <li><a href="q_and_a_main.php">Q&amp;A</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="user_details.php?id=<?php echo $user_id ?>">A minha conta</a></li>
        <li><a href="logout.php">Terminar Sessão</a></li>
        <li class="active"><a href="ajuda.php">Ajuda</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>

<div class="jumbotron text-left container-fluid" style="background-image: url('images/blue_header.png'); opacity: 0.9;background-attachment: fixed;">
	<h1><a href="ajuda.php" style="text-decoration:none;" class="jumbo virtuoso">Ajuda</a></h1>
</div>
<div class="container">
<div id="sobre" class="col-xs-12" style="margin-bottom: 50px;">
<h1 style="color: lightblue;">Sobre</h1>
<p>Este projeto foi concebido por alunos da Universidade de Aveiro no âmbito da disciplina <em>Modelação e Análise de Sistemas</em>, esta plataforma é apenas
de esposição e como tal não garantimos a veracidade de nenhum anúncio ou conta que aqui esteja presente. Qualquer utilizador é livre para publicar anúncios, 
perguntas e/ou respostas, no entanto contamos com a sua responsabilidade e bom senso para o contéudo que irá publicar, pois não nos iremos responsabilizar por ele.
Qualquer dúvida que possua, contacte o administrador: <a href="mailto:virtuoso_mas@protonmail.ch">virtuoso_mas@protonmail.ch</a></p>
<hr class="col-xs-12">
</div>

<div id="html" class="col-xs-12">
	<h1 style="color: lightblue">HTML</h1>
	<p>É permitido publicar código HTML para formatar o texto que publica na plataforma Virtuoso, e por isso, apresentammos um tutorial simples
	sobre HTML básico.</p>
	<p>Um documento HTML é composto por tags, as quais possuem um nome e aparecem entre os sinais &lt; e &gt;, como por exemplo, 
	em &lt;a&gt; e &lt;h1&gt;.Temos também que algumas tags precisam de ser abertas e fechadas, como em &lt;h1&gt;&lt;/h1&gt;.</p>
	<hr class="col-xs-12">
	<div class="seccao col-xs-offset-1 col-xs-10">
		<h3 style="color: lightblue">Cabeçalhos</h3>
		<hr class="col-xs-12">
		<p>Cabeçalhos são normalmente utilizados para identificar títulos e seções, e possuem aparência diferenciada do restante do texto. 
		No HTML há seis níveis de cabeçalhos/títulos que podem ser utilizados por meio das tags h1, h2, h3, h4, h5 e h6, sendo h1 o maior/mais 
		relevante e h6 o menor/menos relevante.</p>
		<div class="col-xs-12 code_example">
			&lt;h1>Título de nível 1&lt;/h1>
			<h1>Título de nível 1</h1>
			
			&lt;h2>Título de nível 2&lt;/h2>
			<h2>Título de nível 2</h2>
			
			&lt;h3>Título de nível 3&lt;/h3>
			<h3>Título de nível 3</h3>
			
			&lt;h4>Título de nível 4&lt;/h4>
			<h4>Título de nível 4</h4>
			
			&lt;h5>Título de nível 5&lt;/h5>
			<h5>Título de nível 5</h5>
			
			&lt;h6>Título de nível 6&lt;/h6>
			<h6>Título de nível 6</h6>
		</div>
		<h3 style="color: lightblue">Parágrafos</h3>
		<hr class="col-xs-12">
		<p>Parágrafos de texto são gerados em HTML por meio das tags. 
		Este é um exemplo de tag cuja disposição na tela dá-se em forma de bloco, ou seja, um parágrafo é posto sempre abaixo do outro.</p>
		<div class="col-xs-12 code_example">
			&lt;p>Primeiro parágrafo do texto.&lt;/p><br />
			&lt;p>Segundo parágrafo do texto.&lt;/p><br />
			&lt;p>Terceiro parágrafo do texto.&lt;/p><br />
			<br />
			<span style="color: #3b5998">Resultado:</span><br />
			<p>Primeiro parágrafo do texto.</p>
			<p>Segundo parágrafo do texto.</p>
			<p>Terceiro parágrafo do texto.</p>
		</div>
		<h3 style="color: lightblue">Formatação de texto</h3>
		<hr class="col-xs-12">
		<p>As tags de formatação de texto ajudam a destacar partes do texto da página. 
		Formatações como negrito e itálico podem ser aplicadas com facilidade utilizando as várias tags disponíveis para esse fim.</p>
		<div class="col-xs-12 code_example">
			&lt;p>Texto em negrito com &lt;b>bold&lt;/b> e &lt;strong>strong&lt;/strong>.&lt;/p><br />
			&lt;p>Texto em itálico com &lt;i>italics&lt;/i> e &lt;em>emphasis&lt;/em>.&lt;/p><br />
			&lt;p>Texto &lt;sup>sobrescrito&lt;/sup> e &lt;sub>subscrito&lt;/sub>.&lt;/p><br />
			&lt;p>Texto &lt;ins>inserido&lt;/ins> e &lt;del>excluído&lt;/del>.&lt;/p><br />
			&lt;p>Texto &lt;small>pequeno&lt;/small> e &lt;mark>destacado&lt;/mark>.&lt;/p><br /><br />
			<span style="color: #3b5998">Resultado:</span><br />
			<p>Texto em negrito com <b>bold</b> e <strong>strong</strong>.</p>
			<p>Texto em itálico com <i>italics</i> e <em>emphasis</em>.</p>
			<p>Texto <sup>sobrescrito</sup> e <sub>subscrito</sub>.</p>
			<p>Texto <ins>inserido</ins> e <del>excluído</del>.</p>
			<p>Texto <small>pequeno</small> e <mark>destacado</mark>.</p>
		</div>
		
		
		<h3 style="color: lightblue">Listas</h3>
		<hr class="col-xs-12">
		<p>Listas são elementos úteis para organizar e ordenar itens que estão relacionados de alguma forma. 
		Em HTML é possível criar três tipos de listas: ordenadas (com a tag ol), não ordenadas (com a tag ul), e de definição (por meio da tag dl).</p>
		<div class="col-xs-12 code_example">
			<span style="color: #3b5998">Lista ordenada:</span><br />
			&lt;ol><br />
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&lt;li>Item 1&lt;/li><br />
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&lt;li>Item 2&lt;/li><br />
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&lt;li>Item 3&lt;/li><br />
			&lt;/ol><br />
			<span style="color: #3b5998">Resultado:</span><br />
			<ol>
   				<li>Item 1</li>
    			<li>Item 2</li>
    			<li>Item 3</li>
			</ol>
			<span style="color: #3b5998">Lista não ordenada:</span><br />
			&lt;ul><br />
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&lt;li>Item 1&lt;/li><br />
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&lt;li>Item 2&lt;/li><br />
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&lt;li>Item 3&lt;/li><br />
			&lt;/ul><br />
			<span style="color: #3b5998">Resultado:</span><br />
			<ul>
   				<li>Item 1</li>
    			<li>Item 2</li>
    			<li>Item 3</li>
			</ul>
			<p>As <span style="color: #3b5998">listas de definição</span> têm um comportamento um pouco diferente, uma vez que cada item é composto por um título (dt) e uma definição (dd), 
			semelhante ao que ocorre em dicionários, nos quais temos as palavras e respetivas definições.</p>
			&lt;dl><br />
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&lt;dt>Título 1&lt;/dt><br />
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&lt;dd>Definição 1&lt;/dd><br />
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&lt;dt>Título 2&lt;/dt><br />
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&lt;dd>Definição 2&lt;/dd><br />
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&lt;dt>Título 3&lt;/dt><br />
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&lt;dd>Definição 3&lt;/dd><br />
			&lt;/dl><br />
			<span style="color: #3b5998">Resultado:</span><br />
			<dl>
    			<dt>Título 1</dt>
    			<dd>Definição 1</dd>
    			<dt>Título 2</dt>
    			<dd>Definição 2</dd>
    			<dt>Título 3</dt>
    			<dd>Definição 3</dd>
				</dl>
		</div>
		<span class="text-muted">Referência: <a href="https://www.w3schools.com/html/" target="_blank">https://www.w3schools.com/html/</a></span>
	</div>
</div>

</div> <!-- /container -->

	<!-- script references -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
