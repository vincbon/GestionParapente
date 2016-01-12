<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title ?></title>
		<link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url("assets/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url("assets/css/perso.css"); ?>" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<!-- Container du body (de toute la page)-->
		<div id="body_container" class="container">
			<header class="page-header">
				<h2><?php echo $title ?></h2>
			</header>
			<nav class="navbar navbar-default navbar-fixed-top">
				<!-- La classe fixed-top nécessite un container -->
				<div class="container">
					<div class="navbar-header">
						<a class="navbar-brand" href="<?php echo base_url(); ?>">Club de parapente de Lannion</a>
					</div>
					<ul class="nav navbar-nav">
						<li><a href="<?php echo base_url(); ?>"><span class="fa fa-bar-chart"></span> Tableau de bord</a></li>
						<li><a href="<?php echo base_url("locations"); ?>"><span class="glyphicon glyphicon-list-alt"></span> Locations</a></li>
    					<li class="dropdown">
        					<a data-target="#" href="" data-toggle="dropdown" class="dropdown-toggle"><span class="glyphicon glyphicon-user"></span> Clients <b class="caret"></b></a>
        					<ul class="dropdown-menu">
            					<li><a href="<?php echo base_url("pilotes"); ?>">Pilotes</a></li>
            					<li><a href="<?php echo base_url("invites"); ?>">Invités</a></li>
        					</ul>
    					</li>
						<li><a href="<?php echo base_url("parapentes"); ?>"><span class="glyphicon glyphicon-send"></span> Parapentes</a></li>
						<li class="dropdown">
        					<a data-target="#" href="page.html" data-toggle="dropdown" class="dropdown-toggle"><span class="glyphicon glyphicon-check"></span> Contrôles techniques <b class="caret"></b></a>
        					<ul class="dropdown-menu">
            					<li><a href="<?php echo base_url("controlesponctuels"); ?>">Contrôles ponctuels</a></li>
            					<li><a href="<?php echo base_url("controlesrecurrents"); ?>">Contrôles récurrents</a></li>
        					</ul>
    					</li>
						<li><a href="<?php echo base_url("parcours"); ?>"><span class="fa fa-map"></span> Parcours</a></li>
					</ul>
				</div>
			</nav>