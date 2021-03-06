<?php 
include_once('../config.php'); 

if(isset($_SESSION['id_user']) && $_SESSION['type'] == '2'){
	$req = $bdd->prepare("SELECT id,UPPER(nom) as nom, prenom, email, pass, type, classe FROM utilisateurs WHERE id = :id");
	$req->execute(array('id' => $_SESSION['id_user']));
	$user = $req->fetch();
}else{
	header("Location: ../login.php");
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
			  </div>

			</div>
		</header>
		<section>
            <div style = "width:20%; margin : 10px auto auto auto;">
				<table class="table table-bordered">
						<tr>
							<th><div class="center">Professeur</div></th>
						</tr>
						<?php
						try {
							   $req = $bdd->query("SELECT id, type, UPPER(nom) as nom, prenom FROM utilisateurs");
							   while ($prof = $req->fetch())
							   {
							   	if ($prof['type'] == '1') 
									{
								   	?>
								      <tr>
								         <td>
								            <a href="page/config-prof.php?id=<?php echo $prof['id']; ?>">
								                 <button type='submit' name='modif_profils' class='btn2'>
								                     <div class='center controls'><?php echo $prof['nom']." ".ucfirst($prof['prenom']); ?></div>
								                 </button>
								            </a>
								         </td>
								      </tr>
								  	<?php 
					   				}  
					   			} 
					   		}
					    catch(Exception $e) {
					        echo $e->getMessage();
					    }         
						?>
				</table>
			</div>		
		</section>
		<footer>
		</footer>
        <script src="http://code.jquery.com/jquery.js"></script>
    	<script src="../js/bootstrap.min.js"></script>
    	<script src="page/planning.js"></script>
		<script src="../js/jquery.js"></script>
		<script src="../js/profil.js"></script>
	</div>
</body>
</html>