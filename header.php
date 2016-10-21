<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cadastro Eventos Vivo Rio</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"></script>

</head>
<body>
<?php
	//controlador de ativacao do menu de origem ativado
	function AtivarMenu($string){
		$url = $_SERVER['REQUEST_URI'];
		if (strpos($url, $string) !== false) {
    		$active = 'class="active"';
		} else {
			$active = "";
		}
		return $active;
	}
?>
<div class="container" style="margin-top: 10px;">
    <ul class="nav nav-tabs">
        <li <?php echo AtivarMenu('admin');?>><a href="admin.php">Inicio</a></li>

        <li <?php echo AtivarMenu('listar-eventos');?>><a href="listar-eventos.php">Listar Eventos</a></li>
        <li <?php echo AtivarMenu('listar-generos');?>><a href="listar-generos.php">Generos Musicais</a></li>

      </ul>
    <style>
        .acoes-button{
            width: 31% !important;
        }
    </style>