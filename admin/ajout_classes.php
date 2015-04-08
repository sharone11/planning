<?php 
include_once('../config.php'); 


//--------------------------------------------------------------- Début du code php pour le insert into --------------------------------------------------------------------------

if (isset($_POST['submit'])) 
{
	$classe = $_POST['classe'];
	//On vérifie si la classe existe déjà si elle n'existe pas on la crée
	$sql_classe = $bdd->prepare("SELECT * FROM classes WHERE classe = :classe");
	$sql_classe->execute(array(
				'classe'    => $classe
				));
	$info_classe = $sql_classe->fetch();

	if (!isset($info_classe['id'])) 
	{
		try 
		{
		    $sql = "INSERT INTO classes (id, classe) 
		    VALUES (NULL, '".$classe."')";
		    $bdd->exec($sql);
		    /*-------------------------------------------------------------A CHANGER !!!!!!!!!!!!!!!!!!!!!!!!!-------------------------------------------------------------------------
    
	    header('Location: choose-prof.php');

-------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	    }
		catch(PDOException $e)
	    {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}
	else
	{
		echo '<script>alert("Attention cette classe existe déjà. Veuillez en saisir un autre.");</script>';
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
<body ng-app="SignUp">
	<div id="container">
		<header>
			<div class="navbar navbar-inverse">
			  <div class="navbar-inner">
			  	<?php if($user['type'] == 2): ?>
				<a class="brand" href="index.php">Espace Admin</a>
				<?php endif; ?>
			    <ul class="nav">
			      	<li class="active"><a href="index.php"><i class="icon-home icon-white"></i> Home</a></li>
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
			 
		</header>
			<section>
				<div>	
					<form action="ajout_classes.php" method="post">
						<table class="table_ajout">
							<tr>
								<td>
									<div id="classe" class="div_ajout">
										<input class="input_ajout" name="classe" type="text" placeholder="Classe">
									</div>
								</td>
							</tr>
							<tr>
								<td><div class="div_ajout"><input type="submit" name="submit" placeholder="Validé"></div></td>
							</tr>
					 	</table>
					</form>
				</div>
			</section>
		<footer>
		</footer>
		<script src="js/angular.js"></script>
		<script src="js/signup.js"></script>
        <script src="http://code.jquery.com/jquery.js"></script>
    	<script src="../js/bootstrap.min.js"></script>
    	<script src="page/planning.js"></script>
		<script src="../js/jquery.js"></script>
		<script src="../js/profil.js"></script>
	</div>
</body>
</html>