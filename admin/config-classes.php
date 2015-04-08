<?php include_once('../config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="shortcut icon" type="image/jpeg" href="" />
	<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	<link href="../css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
	<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="../css/style.css" rel="stylesheet" media="screen">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Planning</title>
</head>
<body>
	<div id="container">
		<header>
			<div class="navbar navbar-inverse">
			  <div class="navbar-inner">
			  	<?php if($user['type'] == 2): ?>
				<a class="brand" href="index.php">Espace Admin</a>
				<?php endif; ?>
			    <ul class="nav">
			      	<li class="active"><a href="index.php"><i class="icon-home icon-white"></i> Home</a></li>
			      	<li><a href="config-prof.php">Planning Professeurs</a></li>
                    <li><a href="config-classes.php">Planning Classes</a></li>
      				<li><a href="#">Récapitulatif des cours</a></li>
			    </ul>
			    <ul class="nav pull-right">
			    <li class="dropdown">
			      	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			      		<i class="icon-user icon-white"></i>
			      		<?= $user['nom']." ".ucfirst($user['prenom']); ?> 
			      	<b class="caret"></b></a>
			      	<ul class="dropdown-menu">
			      		<li><a href="#">Informations</a></li>
			      		<li><a href="../index.php?page=deconnection"><i class="icon-off"></i> Déconnection</a></li>
			      	</ul>
			    </li>
			    </ul>
			  </div>

			</div>
		</header>
		<section>
		<section>
			<include('planning-classe.php');>
			
		</section>
		</section>
		<footer>
		</footer>
		<script src="http://code.jquery.com/jquery.js"></script>
    	<script src="../js/bootstrap.min.js"></script>
    	<script src="page/planning.js" ></script>
	</div>
</body>
</html>
			
		