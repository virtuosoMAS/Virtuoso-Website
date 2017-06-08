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
	.navbar {
		margin-bottom: 0px !important;
	}
	.fb_button {
		background-color:#3b5998;
		color: white; 
		height: 40px; 
		line-height:40px; 
		padding:0 10px 0 10px;
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
	</style>
<body>
<script>
  window.fbAsyncInit = function() {
    FB.init({	
      appId            : '154682721732376',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v2.9'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

   function logIn() {
	FB.login(function(response) {
		if (response.status == "connected") {
			//document.getElementById("status").innerHTML = "Connected";
			getInfo();
		}
	}, {scope: 'email'});
	//, {scope: 'publish_actions, email'}
   }
   
   function getInfo() {
	FB.api('/me','GET', {fields: 'id, name, email, link, picture.width(500).height(500)'}, function(response) {
		$("#id").val(response.id);
		$("#nome").val(response.name);
		$("#email").val(response.email);
		$("#picture").val(response.picture.data.url);
		$("#user_data").submit();
	})
   }

</script>
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
    </div><!--/.nav-collapse -->
  </div>
</div>

<div class="container">
	
		<div class="well well-lg text-center col-xs-12 col-md-8 col-md-offset-2">
			<h1 class="virtuoso">Virtuoso</h1>
			<h4><p style="color: grey;">Uma comunidade especializada em compra e venda de instrumentos musicais!</p></h4>
			<h5><p style="color: grey;">Para usufruir de todas as funcionalidades do <span class="virtuoso">Virtuoso</span> tem de primeiro iniciar sessão</p></h5>
			<!--<div class="fb_button col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3">
			<button  href="" onclick="logIn()">
			<div class="col-xs-12 col-sm-10" align="left">Continuar com o Facebook</div>
			<div class="hidden-xs col-sm-1" style="margin-top:10px;"><i class="fa fa-angle-right"></i></div>
			</button></div>-->
			<button class="btn btn-lg fb_button" onclick="logIn()">Continuar com o Facebook&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-right"></i></button>
		
		</div>
	

</div> <!-- /container -->
<form class="userData" id="user_data" method="post" action="facebook_handler.php">
	<input type="hidden" name="user_id" id="id" value="">
	<input type="hidden" name="nome" id="nome" value="">
	<input type="hidden" name="email" id="email" value="">
	<input type="hidden" name="profile_img" id="picture" value="">
</form>
<div id="status"></div>
<script src="assets/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
