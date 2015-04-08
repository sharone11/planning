<?php 
include_once('../config.php'); 
/*
';
$sql_matiere = $bdd->query("SELECT * FROM matieres");

	while ($data_matiere = $sql_matiere->fetch()) 
	{
			echo '<option value="'.$data_matiere['id'].'">'.$data_matiere['matiere'].'</option>';
			// Remise à zéro de $selected		
	}
echo '
*/
//--------------------------------------------------------------- Début du code php pour le insert into --------------------------------------------------------------------------

if (isset($_POST['submit'])) 
{
	//Onvérifie que les champs ne sont pas vide
	if ($_POST['nom'] == "" && $_POST['prenom'] == "" && $_POST['mdp1'] == "" && $_POST['mdp2'] == "" && $_POST['email'] == "" && $_POST['type'] == "3") 
	{
		echo '<script>alert("Attention vous avez oublié un ou plusieurs champs");</script>';
	}
	else
	{

		//On remplace les variable	
		$ajout_nom = $_POST['nom'];
		$ajout_prenom = $_POST['prenom'];
		$ajout_mdp1 = sha1('it'.$_POST['mdp1']);
		$ajout_mdp2 = sha1('it'.$_POST['mdp2']);
		$ajout_email = $_POST['email'];
		$ajout_matiere = $_POST['matiere'];
		$ajout_type = $_POST['type'];
		$ajout_classe = $_POST['classe'];


		//On vérifie que l'utilisateur n'existe pas déjà
		$sql_utilisateur = $bdd->prepare("SELECT * FROM utilisateurs WHERE nom = :nom and prenom = :prenom and email = :email and type = :type ");
		$sql_utilisateur->execute(array(
					'nom'    => $ajout_nom,
					'prenom'    => $ajout_prenom,
					'email'    => $ajout_email,
					'type'    => $ajout_type
					));
		$info_utilisateur = $sql_utilisateur->fetch();

		if (isset($info_utilisateur['id'])) 
		{
			echo '<script>alert("Attention cet utilisateur existe déjà. Veuillez en saisir un autre.");</script>';
		}
		else
		{
			//On vérifie si les deux mdp sont égaux
			if ($ajout_mdp1 != $ajout_mdp2) 
			{
				echo '<script>alert("Les deux mots de passe ne sont pas égaux");</script>';
			}
			else
			{

//-------------------------------------------------------------------------------- PARTIE ELEVE ---------------------------------------------------------------------------------

				if ($ajout_type == 0) 
				{
					//On vérifie si la classe existe déjà si elle n'existe pas on la crée
					$sql_classe = $bdd->prepare("SELECT * FROM classes WHERE classe = :classe");
					$sql_classe->execute(array(
								'classe'    => $ajout_classe
								));
					$info_classe = $sql_classe->fetch();

					if (isset($info_classe['id'])) 
					{
						$id_classe = $info_classe['id'];
					}
					else
					{
						$sql_id_classe = 'INSERT INTO classes (classe)
					    VALUES ('.$ajout_classe.')';
					    $bdd->exec($sql_id_classe);
					    $sql_classe2 = $bdd->prepare("SELECT * FROM matieres WHERE matiere = :matiere");
						$sql_classe2->execute(array(
									'matiere'    => $ajout_matiere
									));
						$info_classe2 = $sql_classe2->fetch();
						$id_classe = $info_classe2['id'];
					}
						//on insert dans la table utilisateurs
						try 
						{
						    $sql = "INSERT INTO utilisateurs (type, email, pass, nom, prenom, classe)
						    VALUES ('".$ajout_type."', '".$ajout_email."', '".$ajout_mdp1."','".$ajout_nom."','".$ajout_prenom."','".$id_classe."')";
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

//-------------------------------------------------------------------------------- PARTIE PROF ---------------------------------------------------------------------------------
				
				elseif ($ajout_type == 1) 
				{
					$sql_matiere = $bdd->prepare("SELECT * FROM matieres WHERE matiere = :matiere");
					$sql_matiere->execute(array(
								'matiere'    => $ajout_matiere
								));
					$info_matiere = $sql_matiere->fetch();

					if (isset($info_matiere['id'])) 
					{
						$id_matiere = $info_matiere['id'];
					}
					else
					{
						$sql_id_matiere = 'INSERT INTO matieres (matieres)
					    VALUES ('.$ajout_matiere.')';
					    $bdd->exec($sql_id_matiere);
					    $sql_matiere2 = $bdd->prepare("SELECT * FROM matieres WHERE matiere = :matiere");
						$sql_matiere2->execute(array(
									'matiere'    => $ajout_matiere
									));
						$info_matiere2 = $sql_matiere2->fetch();
						$id_matiere = $info_matiere2['id'];
					}
					//on insert dans la table utilisateurs
					try 
					{
					    $sql = "INSERT INTO utilisateurs (type, email, pass, nom, prenom, matiere)
					    VALUES ('".$ajout_type."', '".$ajout_email."', '".$ajout_mdp1."','".$ajout_nom."','".$ajout_prenom."','".$id_matiere."')";
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

//-------------------------------------------------------------------------------- PARTIE ADMIN ---------------------------------------------------------------------------------
			
				elseif ($ajout_type == 2) 
				{
					//on insert dans la table utilisateurs
					try 
					{
					    $sql = "INSERT INTO utilisateurs (type, email, pass, nom, prenom)
					    VALUES ('".$ajout_type."', '".$ajout_email."', '".$ajout_mdp1."','".$ajout_nom."','".$ajout_prenom."')";
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
					<form action="ajout_utilisateurs.php" method="post">
						<table class="table_ajout">
					 		<tr>
							  	<td><div class="div_ajout"><input class="input_ajout" type="text" name="nom" placeholder="Nom"></div></td>
						 	</tr>
							<tr>
								<td><div class="div_ajout"><input class="input_ajout" type="text" name="prenom" placeholder="Prenom"></div></td>
							</tr>
							<tr>
								<td><div class="div_ajout"><input class="input_ajout" type="password" name="mdp1" placeholder="Password"></div></td>
							</tr>
							<tr>
								<td><div class="div_ajout"><input class="input_ajout" type="password" name="mdp2" placeholder="Confirmation"></div></td>
							</tr>
							<tr>
								<td><div class="div_ajout"><input class="input_ajout" type="email" name="email" placeholder="Email"></div></td>
							</tr>

							<tr>
								<td>
									<div class="div_ajout"  >
										<select name="type" id="type">
											<option value="3" ng-model="selected">Type d'utilisateur</option>
											<option value="0" ng-model="selected">Élève</option>
											<option value="1" ng-model="selected">Professeur</option>
											<option value="2" ng-model="selected">Admin</option>		  	
										</select>
									</div>
								</td>
							</tr>
							<tr >
								<td>
									<div id="matiere1" class="div_ajout">
									<input class="input_ajout" name="matiere" list="matiere" type="text" placeholder="Matiere">
									<datalist id="matiere">
										  	<?php
											  	$sql_matiere = $bdd->query("SELECT * FROM matieres");

												while ($data_matiere = $sql_matiere->fetch()) 
												{
														echo '<option>'.$data_matiere['matiere'].'</option>';
												}
											?>
									</datalist>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div id="classe1" class="div_ajout">
										<input class="input_ajout" name="classe" list="classe" type="text" placeholder="Classe">
										<datalist id="classe">
											  	<?php
												  	$sql_classe = $bdd->query("SELECT * FROM classes");

													while ($data_classe = $sql_classe->fetch()) 
													{
															echo '<option>'.$data_classe['classe'].'</option>';
															// Remise à zéro de $selected		
													}
												?>
										</datalist>
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
		<script>
        $(function() {
            $("#type").on("change", function() {
                var id_type = $("#type").val();
					
                if(id_type == 0)
				{
					//$("#classe1").show();
					//$("#matiere1").hide();
					$("#classe1").css('display', 'block');
					$("#matiere1").css('display', 'none');
				}
				else if(id_type == 1)
				{
					// $("#matiere1").show();
					// $("#classe1").hide();
					$("#classe1").css('display', 'none');
					$("#matiere1").css('display', 'block');
				}
				else if(id_type == 2 || id_type == 3)
				{
					// $("#matiere1").hide();
					// $("#classe1").hide();
					$("#classe1").css('display', 'none');
					$("#matiere1").css('display', 'none');
				}
				
                
            });
        });
        </script>

	</div>
</body>
</html>