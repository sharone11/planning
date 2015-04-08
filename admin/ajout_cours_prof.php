<?php 
include_once('../config.php');

if (isset($_GET['id']))
{
	$id_prof = $_SESSION['idprof'];
	
	if (isset($_POST['ajout_cours'])) 
	{
		$ajout_horaire = $_POST['horaire'];
		$ajout_classe = $_POST['classe'];
		$ajout_semaine = $_POST['semaine'];
		$ajout_jour = $_POST['jour'];
		$ajout_salle = $_POST['salle'];
		
		$sql_prof2 = $bdd->prepare("SELECT * FROM planning WHERE horaire = :horaire and id_prof = :id_prof and semaine = :semaine and id_jour = :id_jour and id_salle = :id_salle ");
		$sql_prof2->execute(array(
					'horaire'    => $ajout_horaire,
					'id_prof'    => $_SESSION['idprof'],
					'semaine'    => $ajout_semaine,
					'id_jour'    => $ajout_jour,
					'id_salle'    => $ajout_salle
					));
		$info_prof2 = $sql_prof2->fetch();

		if (isset($info_prof2['id'])) 
		{
			echo '<script>alert("Attention ce cours existe déjà. Veuillez en saisir un autre.");</script>';
		}
		else
		{
			try 
			{
			    $sql = 'INSERT INTO planning (horaire,id_classe,id_prof,semaine,id_jour,id_salle)
			    VALUES ('.$_POST['horaire'].', '.$_POST['classe'].', '.$_SESSION['idprof'].','.$_POST['semaine'].','.$_POST['jour'].','.$_POST['salle'].')';
			    $bdd->exec($sql);
			    header('Location: choose-prof.php');
		    }
			catch(PDOException $e)
		    {
		    	echo $sql . "<br>" . $e->getMessage();
		    }
		}

	}
} 

?>

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
				<a class="brand" href="../index.php">Espace Admin</a>
				<?php endif; ?>
			    <ul class="nav">
			      	<li class="active"><a href="../index.php"><i class="icon-home icon-white"></i> Home</a></li>
			      	<li><a href="choose-prof.php">Planning Professeurs</a></li>
                    <li><a href="choose-classes.php">Planning Classes</a></li>
      				<li><a href="ajout_utilisateurs.php">Ajouter un utilisateur</a></li>
      				<li><a href="ajout_classes.php">Ajouter une classe</a></li>
      				<li><a href="ajout_salles.php">Ajouter une salle</a></li>
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
		<body>
		<section>

    	<div>
    	
    	<form id="form_ajout" action="ajout_cours_prof.php?id=<?php echo $_GET['id']; ?>" method="post">
					<table>
	    				<tr>
	    					<th colspan="2">
	    						<?php 
	    						$sql_prof = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = :id_prof");
								$sql_prof->execute(array('id_prof' => $id_prof));
								$info_prof = $sql_prof->fetch();
	    						echo 'Vous allez ajouter un cour au professeur '.$info_prof['nom'].' '.$info_prof['prenom']; ?>
	    					</th>
	    				</tr>
						<tr>
							<th>Horaire</th>
							<td>
								<select name="horaire">
									<option value="0">Matin</option>
									<option value="1">Après-Midi</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>Classe</th>
							<td>
								<select name="classe">';
									<?php
									$req2 = $bdd->query("SELECT * FROM classes");

									while ($data_classe = $req2->fetch()) 
									{
											echo '<option value="'.$data_classe['id'].'">'.$data_classe['classe'].'</option>';
											// Remise à zéro de $selected		
									}
									?>					
								</select>
							</td>
						</tr>
						<tr>
							<th>Semaine</th>
							<td>
								<select name="semaine">';
									<?php
									$semaine = 1;
									while($semaine<31)
								  	{
								  		
											echo '<option value="'.$semaine.'">'.$semaine.'</option>';
										$semaine++;

								  	}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<th>Semaine</th>
							<td>
								<select name="jour">
									<option value="1">Lundi</option>
									<option value="2">Mardi</option>
									<option value="3">Mercredi</option>
									<option value="4">Jeudi</option>
									<option value="5">Vendredi</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>Salle</th>
							<td>
								<select name="salle">';
									<?php
									$req3 = $bdd->query("SELECT * FROM salles");
									while ($data_salle = $req3->fetch()) 
									{
											echo '<option value="'.$data_salle['id'].'">'.$data_salle['salle'].'</option>';
											// Remise à zéro de $selected		
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<INPUT TYPE="submit" NAME="ajout_cours" VALUE="Ajouter un cour">
							</td>
						</tr>
							</form>
		</div>
		

		</section>
		</body>
		<footer>
		</footer>
		<script src="http://code.jquery.com/jquery.js"></script>
    	<script src="../js/bootstrap.min.js"></script>
    	<script src="js/planning.js" ></script>
	</div>
</body>
</html>
			


		
