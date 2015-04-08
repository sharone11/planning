<?php 
include_once('../../config.php');

$_SESSION['idprof'] = $_GET['id'];

$semaine = 1;
if (isset($_POST["del"])) {
echo $_SESSION['idcours'];
	$suppr = "DELETE FROM planning WHERE id =".$_SESSION['idcours'];
} 

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="shortcut icon" type="image/jpeg" href="" />
	<link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="../../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	<link href="../../css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
	<link href="../../css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="../../css/style.css" rel="stylesheet" media="screen">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Planning</title>
	
</head>
<body>
	<div id="container">
		<header>
			<div class="navbar navbar-inverse">
			  <div class="navbar-inner">
			  	<?php if($user['type'] == 2): ?>
				<a class="brand" href="../index.php">Espace Admin</a>
				<?php endif; ?>
			    <ul class="nav">
			      	<li class="active"><a href="../index.php"><i class="icon-home icon-white"></i> Home</a></li>
			      	<li><a href="../choose-prof.php">Planning Professeurs</a></li>
                    <li><a href="../choose-classes.php">Planning Classes</a></li>
      				<li><a href="../ajout_utilisateurs.php">Ajouter un utilisateur</a></li>
      				<li><a href="../ajout_classes.php">Ajouter une classe</a></li>
      				<li><a href="../ajout_salles.php">Ajouter une salle</a></li>../
			    </ul>
			    <ul class="nav pull-right">
			    <li class="dropdown">
			      	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			      		<i class="icon-user icon-white"></i>
			      		<?= $user['nom']." ".ucfirst($user['prenom']); ?> 
			      	<b class="caret"></b></a>
			      	<ul class="dropdown-menu">
			      		<li><a href="#">Informations</a></li>
			      		<li><a href="../../index.php?page=deconnection"><i class="icon-off"></i> Déconnection</a></li>
			      	</ul>
			    </li>
			    </ul>
			  </div>

			</div>
		</header>
		<section>
		<div class="planning">
			<div class="btn-toolbar" role="toolbar" aria-label="group">
				<?php for($i=1;$i<=30;$i++):?>
		  		<a href="<?= $semaine=$i ?>" class="plng"><button type="button" class="btn btn-default semaine"><?= $i; ?></button></a>
		  		<?php endfor; ?>
			</div>
			<div class="planningjs center"><p>Choisissez une semaine.</p></div>

    	
		</div>

		</section>
		<footer>
		</footer>
		<script src="http://code.jquery.com/jquery.js"></script>
    	<script src="../../js/bootstrap.min.js"></script>
    	<script src="../js/planning_prof.js" ></script>
	</div>
</body>
</html>
			
		
