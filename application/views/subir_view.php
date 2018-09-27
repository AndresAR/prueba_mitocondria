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
				</p>
			</div>
		</section>

		<div class="album py-5 bg-light">
			<div class="container">
				<h1>Subir Foto</h1>
					
					<form enctype="multipart/form-data" action="subir" method="POST">
					Nombre: <input type="text" name="nombre" placeholder="Nombre de tu mascota" class="form-control" />
					Nickname: <input type="text" name="nickname" placeholder="Nombre del dueño" class="form-control" />
					Imagen
					 <input type="file" name="imagen" id="picture" />
					<input type="submit" name="submit" value="Subir"/>
				</form>
				
			</div>
		</div>
	</main>
</body>
</html>