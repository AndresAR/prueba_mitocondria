<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!--colocamos los estilos necesarios para la maquetacion-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/bootstrap.css" media="screen" />
	<script src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
	<title><?= $title ?></title>
</head>
<body>
	<main role="main">

		<section class="jumbotron text-center">
			<div class="container">
				<h1 class="jumbotron-heading">Prueba Mitocondria</h1>
				<p class="lead text-muted">
					Albun de fotos de mascotas
					<a href="<?php echo base_url() . 'subir' ?>">Subir imagen</a>
				</p>
			</div>
		</section>

		<div class="album py-5 bg-light">
			<div class="container">
				<?php $cont=0; $fin=false; foreach($mascotas as $mascota): ?>
				<?php if($cont==0) echo '<div class="row">'; ?>
				
					<div class="col-md-4">
						<div class="card mb-4 shadow-sm">
							<img class="card-img-top" src="<?php echo base_url() . 'assets/upload/' . $mascota->imagen; ?>" alt="Card image cap">
							<div class="card-body">
								<p class="card-text">
									<b>Nombre: </b> <?= $mascota->nombre; ?><br />
									<b>Votos: </b> <?= $mascota->votos; ?><br />
									<span class="btn btn-success votar" data-id="<?= $mascota->id; ?>">Votar</span>
								</p>
								
							</div>
						</div>
					</div>
				<?php 
					if($cont > 3 || $fin == true || count($mascotas) == $cont){
						echo '</div>';
						$cont = 0;
						$fin = true;

					}
					$cont++;
				?>
				<?php endforeach; ?>
				</div>
			</div>
		</div>
		<script>
			$('.votar').on('click', function(){
				$.ajax({
					type: 'POST',
					url: "mascota/votar",
					data: {id: $(this).data('id')},
					success: function(res){
						if(res == 200){
							alert('Gracias por votar');
							location.reload();
						}
					}

				});
			});
		</script>
		</main>
	</body>
	</html>