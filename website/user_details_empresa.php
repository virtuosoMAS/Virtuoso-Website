<body>
<div class="container col-xs-12" style="">
<?php 
$perguntas = mysql_query("SELECT * FROM Perguntas WHERE user_id={$id} ORDER BY DATA DESC");
$respostas = mysql_query("SELECT * FROM Respostas WHERE user_id={$id} ORDER BY DATA DESC");
$anuncios  = mysql_query("SELECT * FROM  Anuncios WHERE user_id={$id} ORDER BY DATA DESC");
$concertos = mysql_fetch_array(mysql_query("SELECT user_id, concertos FROM Utilizadores WHERE user_id={$id}"))["concertos"];
$concertos = unserialize($concertos);

if ($concertos)
	$num_concertos = sizeof($concertos);
else
	$num_concertos = 0;
$num_perguntas = mysql_num_rows($perguntas);
$num_respostas = mysql_num_rows($respostas);
$num_anuncios  = mysql_num_rows($anuncios);
?>
<div class="personal_info col-xs-12" style="background-color: #68c4af; border-radius: 0 0 5px 5px;position: relative;height: 400px;margin-left: 13px;">
	<?php if ($proprio_perfil) { ?><span class="glyphicon glyphicon-cog" data-toggle="modal" data-target="#definicoes" style="font-size: 30px"></span><?php }?>
	<div class="profile_img text-center col-xs-3" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
		<a href="<?php echo $user_info['link'] ?>" target="_blank"><img  class="img-responsive" style="border-radius: 40%;" src="<?php echo $user_info["profile_img"]?>" width="250"/></a>
		<a href="mailto:<?php echo $user_info["email"]?>" style="color: white" ><h3><?php echo $user_info["nome"]?></h3></a>
	</div>
	<?php if ($proprio_perfil) { ?>
	<!-- Modal para as Definições -->
	<form action="" method="post" class="col-xs-12">
	<div id="definicoes" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			    <!-- Conteúdo Modal-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Definições</h4>
			      </div>
			      <div class="modal-body">
			        <div class="form-group">
						<label for="link"><h4>Link - Site da Empresa:</h4></label>
    					<input type="text" class="form-control" name="link" placeholder="http://www.example.com">
					</div>
					<div class="form-group">
						<h4>Mudar Tipo de Conta:</h4>
    					<label class="radio-inline col-xs-offset-3 col-xs-4"><input type="radio" name="tipo_conta" value="pessoal"><h4>&nbsp;Pessoal</h4></label>
    					<label class="radio-inline col-xs-4"><input type="radio" name="tipo_conta" value="empresa"><h4>&nbsp;Empresa</h4></label>
					</div>
					<br /><br />
			      </div>
			      <div class="modal-footer text-right" style="max-height: 65px">
			      		<button type="submit" class="btn btn-success" >Alterar</button>
			        	<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
	      				<input type="hidden" name="func_name" value="definicoes"/>
	      				<input type="hidden" name="func_arg_id" value="<?php echo $user_info['user_id']?>"/>
			      </div>
			    </div>
				<!-- Fim do conteúdo Modal -->
		  </div>
	</div>
	</form>
	<?php }?>

	
</div>
<hr class="col-xs-12">
<ul class="nav nav-tabs navbar-left">
	<?php 
		$no_view = false;
		if (!isset($_GET["view"])) {
			$no_view = true;
		} else { $view = $_GET["view"];}
	?>
	<li class="<?php echo (($no_view || $view != 'Concertos' && $view != 'Perguntas' && $view != 'Respostas') ? 'active' : 'inactive' )?>">
		<?php if ($num_anuncios > 0) {?>
			<a href="?id=<?php echo $id ?>&view=anuncios">Anúncios <span class="badge"><?php echo $num_anuncios?></span></a>
		<?php } else {?>
			<a style="pointer-events: none;cursor: default;">Anúncios <span class="badge"><?php echo $num_anuncios?></span></a>
		<?php }?>
	</li>
	<li class="<?php echo ($view == 'Perguntas' ? 'active' : 'inactive' )?>">
		<a href="?id=<?php echo $id ?>&view=Perguntas">Perguntas <span class="badge"><?php echo $num_perguntas?></span></a>
	</li>
	<li class="<?php echo ($view == 'Respostas' ? 'active' : 'inactive' )?>">
		<a href="?id=<?php echo $id ?>&view=Respostas">Respostas <span class="badge"><?php echo $num_respostas?></span></a>
	</li>
	<li class="<?php echo ($view == 'Concertos' ? 'active' : 'inactive' )?>">
		<a href="?id=<?php echo $id ?>&view=Concertos">Concertos <span class="badge"><?php echo $num_concertos?></span></a>
	</li>
</ul>
<hr class="col-xs-12">

<?php 
	if ($view == 'Perguntas') {
		if ($row = mysql_fetch_array($perguntas)) {
		while ($row) {
			?>
<div class="card card-outline-primary mb-3 text-center col-xs-12">
  <div class="card-block col-xs-3 info_card text-center">
		  <div class="hidden-xs col-sm-4 square">
			  <div class="num">7</div>
			  <div class="text">Votos</div>
		  </div>
		  <?php
		  $num_respostas = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM `Respostas` WHERE `q_id` = '{$row['id']}'"))[0];
		  ?>
		  <div class="col-xs-12  col-sm-4 square" style="color:<?php echo $num_respostas == 0 ? ' ' : ' MediumSeaGreen;'?>">
			  <div class="num">
				  <?php echo ($num_respostas == '' ? 0 : $num_respostas); ?>
			  </div>
			  <div class="text">Resp.</div>
		  </div>
		  <div class="hidden-xs col-sm-4 square">
			  <div class="num"><?php echo $row["views"]?></div>
			  <div class="text">Visual.</div>
		  </div>

  </div>
  <div class="card-block col-xs-9">
    <blockquote class="card-blockquote text-left">
      <h4 class="col-xs-10"><a style="color:white" href="q_details.php?id=<?php echo $row['id']; ?>"><?php echo $row['titulo']?></a></h4>
      
      <?php if ($proprio_perfil) {?>
	      <div class="edit col-xs-2 text-right">
	      	<div class="col-xs-6">
	      		<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminar_q_<?php echo $row['id']?>">
	      			<span class="glyphicon glyphicon-trash" style="color: white" aria-hidden="true"></span>
	      		</button>
	      	</div>
	      </div>
			
				<!-- Modal para confirmar eliminação -->
				<div id="eliminar_q_<?php echo $row['id']; ?>" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				
				    <!-- Conteúdo Modal-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Tem a certeza que pretende elimar esta questão?</h4>
				      </div>
				      <div class="modal-body">
				        <p>Esta ação não pode ser desfeita.</p>
				      </div>
				      <div class="modal-footer text-right" style="max-height: 65px">
				        <form action="" method="post" class="col-xs-12">
				        	<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
		      				<button type="submit" class="btn btn-danger">Eliminar</button>
		      				<input type="hidden" name="func_name" value="eliminarQ"/>
		      				<input type="hidden" name="func_arg_id" value="<?php echo $row['id']?>"/>
		      			</form>
				      </div>
				    </div>
					<!-- Fim do conteúdo Modal -->
					
				  </div>
				</div>	      
	  <?php } ?>
      <br />
      <br />
      
	  <div class="text-right col-xs-12">
  		  <small style="color: #6497b1;"> 
  		  <?php 
  		  		$data_split = str_split(str_split($row['data'], 16)[0], 10);
				echo $data_split[0]." às ".$data_split[1];
		  ?>
		  </small>
  	 </div>
	</blockquote>
  </div>
</div>
 <hr class="col-xs-12">
	<?php $row = mysql_fetch_array($perguntas); }}
	
	} elseif ($view == 'Respostas') {
		while ($row = mysql_fetch_array($respostas)) {
			$titulo_pergunta = mysql_fetch_array(mysql_query("SELECT titulo FROM Perguntas WHERE id={$row['q_id']}"))[0];
			//style="float: right; margin-left: 2px;"
	?>
	<div id="sing_resp" class="col-xs-12">
			  <div class="pergunta_da_resposta col-xs-10" >
			  	<a href="q_details.php?id=<?php echo $row['q_id']?>"><u><h4><?php echo $titulo_pergunta; ?></h4></u></a>
			  </div>
			<?php if ($proprio_perfil) {?>
			  <div class="edit col-xs-2 text-right">
			  		<div class="col-xs-6">
			  			<button class="btn btn-success btn-sm hidden-md hidden-lg" data-toggle="modal" data-target="#editar_a_<?php echo $row['id']?>">
			  				<span class="glyphicon glyphicon-pencil" style="color: white;" aria-hidden="true"></span>
			  			</button>
	      				<button class="btn btn-success btn-md hidden-xs hidden-sm" data-toggle="modal" data-target="#editar_a_<?php echo $row['id']?>">
	      					<span class="glyphicon glyphicon-pencil" style="color: white;" aria-hidden="true"></span>
	      				</button>
	      			</div>
			  		<div class="col-xs-6">
	      				<button class="btn btn-danger btn-sm hidden-md hidden-lg" data-toggle="modal" data-target="#eliminar_a_<?php echo $row['id']?>">
	      					<span class="glyphicon glyphicon-trash" style="color: white;" aria-hidden="true"></span>
	      				</button>
	      				<button class="btn btn-danger btn-md hidden-xs hidden-sm" data-toggle="modal" data-target="#eliminar_a_<?php echo $row['id']?>">
	      					<span class="glyphicon glyphicon-trash" style="color: white;" aria-hidden="true"></span>
	      				</button>
	      			</div>
	      	  </div>
			<?php } ?>
			  <div class="body_resp col-xs-12">
				 <p><?php echo $row['corpo'];?></p>
			  </div>
			 
			  	<!-- Modal para confirmar eliminação -->
				<div id="eliminar_a_<?php echo $row['id']?>" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				
				    <!-- Conteúdo Modal-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Tem a certeza que pretende elimar esta resposta?</h4>
				      </div>
				      <div class="modal-body">
				        <p>Esta ação não pode ser desfeita.</p>
				      </div>
				      <div class="modal-footer text-right" style="max-height: 65px">
				        <form action="" method="post" class="col-xs-12">
				        	<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
		      				<button type="submit" class="btn btn-danger">Eliminar</button>
		      				<input type="hidden" name="func_name" value="eliminarA"/>
		      				<input type="hidden" name="func_arg_id" value="<?php echo $row['id']?>"/>
		      			</form>
				      </div>
				    </div>
					<!-- Fim do conteúdo Modal -->
					
				  </div>
				</div>
				
				
				<!-- Modal para editar resposta -->
				<div id="editar_a_<?php echo $row['id']?>" class="modal fade" role="dialog">
				  <div class="modal-dialog modal-lg">
				
				    <!-- Conteúdo Modal-->
				    <form action="" method="post" class="col-xs-12">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Editar Resposta</h4>
				      </div>
				      	<div class="modal-body">
				      		<div class="form-group">
								<label for="exampleTextarea"><h4>Resposta:</h4></label>
    							<textarea class="form-control" name="func_arg_corpo" rows="10"><?php echo br2nl($row['corpo'])?></textarea>
  							</div>
				    	</div>
				      	<div class="modal-footer text-right" style="max-height: 65px">
				        		<button type="button" class="btn btn-primary" onclick="window.location.reload();">Cancelar</button>
		      					<button type="submit" class="btn btn-danger">Guardar</button>
		      					<input type="hidden" name="func_name" value="editarA"/>
		      					<input type="hidden" name="func_arg_id" value="<?php echo $row['id']?>"/>
		      		  	</div>
				    </div>
				    </form>
					<!-- Fim do conteúdo Modal -->
					
				  </div>
				</div>
				
			  <div class="data col-xs-12 text-right">
		  	  <?php 
				$data_split = str_split(str_split($row['data'], 16)[0], 10);
				echo $data_split[0]." às ".$data_split[1];
			  ?>
			  </div>	  
	</div>
	<hr class="col-xs-12">
	<?php }} elseif ($view == 'Concertos') { ?>
	<div class="concertos col-xs-12">
	<h3 style="color: black">Concertos:
	<?php if ($proprio_perfil) { ?><button class="btn btn-success" data-toggle="modal" data-target="#adicionar_concerto">
		<span class="glyphicon glyphicon-plus" style="color: white;" aria-hidden="true"></span>
	</button> <?php } ?></h3>
				<!-- Modal para editar resposta -->
				<div id="adicionar_concerto" class="modal fade" role="dialog">
				  <div class="modal-dialog modal-lg">
				
				    <!-- Conteúdo Modal-->
				    <form action="" method="post" class="col-xs-12">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Adicionar Concerto</h4>
				      </div>
				      	<div class="modal-body">
				      		<input type="hidden" name="func_name" value="adicionarC"/>
				      		<div class="form-group">
								<label for="exampleTextarea"><h4>Data e Hora:</h4></label>
    							<input type="text" class="form-control" id="dateTime_picker" name="func_arg_data" required="true">
  							</div>
  							<div class="form-group">
								<label for="exampleTextarea"><h4>Título:</h4></label>
    							<input type="text" class="form-control" name="func_arg_data_titulo" required="true">
  							</div>
  							<div class="form-group">
								<label for="exampleTextarea"><h4>Localização:</h4></label>
    							<input type="text" class="form-control" name="func_arg_corpo" required="true">
  							</div>
				    	</div>
				      	<div class="modal-footer text-right" style="max-height: 65px">
				        		<button type="button" class="btn btn-primary" onclick="window.location.reload();">Cancelar</button>
		      					<button type="submit" class="btn btn-danger">Guardar</button>
		      		  	</div>
				    </div>
				    </form>
					<!-- Fim do conteúdo Modal -->
					
				  </div>
				</div>
				<!-- Fim do Modal -->
				<?php
				if ($concertos) {
				$i = 0;
				foreach ($concertos as $concerto) { 
					$concerto = explode("-", $concerto);
					$data = explode(" ", $concerto[0]); ?>
				<div style="margin-left:20px; margin-bottom: 10px">
					<span style='color: black'> Dia <span style="color:#6897bb"><?php echo $data[0]?></span> 
					às <span style="color:#6897bb"><?php echo $data[1]."H - "?></span> 
					<span style="color: grey;font-size:20px"><?php echo $concerto[1] ?> - </span>	
					<a data-toggle="modal" data-target="#maps_local<?php echo $i ?>"><?php echo $concerto[2] ?></a></span><br />
				</div>
				
				<!-- Modal para editar resposta -->
				<div id="maps_local<?php echo $i ?>" class="modal fade" role="dialog">
				  <div class="modal-dialog modal-lg">
				
				    <!-- Conteúdo Modal-->
				    <form action="" method="post" class="col-xs-12">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Localização:</h4>
				      </div>
				      	<div class="modal-body">
				      	<div class="embed-responsive embed-responsive-16by9">
				      		<iframe class="embed-responsive-item"
				src="https://www.google.com/maps/embed/v1/search?key=AIzaSyDM0ZNlzZS6wulKFOv1s6PARvuXmGI-paM&q=<?php echo $concerto[2] ?>, Portugal"></iframe>
						</div>
				    	</div>
				    </div>
				    </form>
					<!-- Fim do conteúdo Modal -->
					
				  </div>
				</div>
				<!-- Fim do Modal -->
				<?php $i++; }} ?>
	</div>
	<? } else {
		while($row = mysql_fetch_array($anuncios)) {
	?>
	
<div class="card card-outline-primary mb-3 text-center col-xs-12">
  <div class="card-block hidden-xs col-sm-3 info_card text-center">
		<?php if ($row['main_img'] == null) {
			echo '<img src="http://www.pchelthgf.com/main/images/noimage_left.jpg" class="col-xs-12 img-responsive" style="max-height: 140px;">';
		} else {
			echo '<img src="data:image; base64,'.$row['main_img'].'" class="col-xs-12 img-responsive" style="max-height: 140px;">';
		  }?>
  </div>
  
  <div class="card-block col-xs-9">
    <blockquote class="card-blockquote text-left col-xs-12" style="height: 140px;">
      <h4 class="col-xs-10"><a style="color:white" href="anuncio_details.php?id=<?php echo $row['id']; ?>"><?php echo $row['titulo']?></a></h4>
      <div class="edit col-xs-2 text-right">
	  		<button class="btn btn-danger btn-sm hidden-md hidden-lg" data-toggle="modal" data-target="#eliminar_anuncio_<?php echo $row['id']?>">
	  			<span class="glyphicon glyphicon-trash" style="color: white;" aria-hidden="true"></span>
  			</button>
  			<button class="btn btn-danger btn-md hidden-xs hidden-sm" data-toggle="modal" data-target="#eliminar_anuncio_<?php echo $row['id']?>">
	  			<span class="glyphicon glyphicon-trash" style="color: white;" aria-hidden="true"></span>
  			</button>
	  </div>
	  <div class="text-right col-xs-12">
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
  	   			<!-- Modal para confirmar eliminação -->
				<div id="eliminar_anuncio_<?php echo $row['id']?>" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				
				    <!-- Conteúdo Modal-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Tem a certeza que pretende elimar este anúncio?</h4>
				      </div>
				      <div class="modal-body">
				        <p>Esta ação não pode ser desfeita.</p>
				      </div>
				      <div class="modal-footer text-right" style="max-height: 65px">
				        <form action="" method="post" class="col-xs-12">
				        	<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
		      				<button type="submit" class="btn btn-danger">Eliminar</button>
		      				<input type="hidden" name="func_name" value="eliminarAnuncio"/>
		      				<input type="hidden" name="func_arg_id" value="<?php echo $row['id']?>"/>
		      			</form>
				      </div>
				    </div>
					<!-- Fim do conteúdo Modal -->
					
				  </div>
				</div>
	</blockquote>
  </div>
</div>
 <hr class="col-xs-12">
		
	<?php }}?>

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