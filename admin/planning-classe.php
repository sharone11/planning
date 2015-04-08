<?php 

include_once('../config.php');

$color = "blue";


if(isset($_POST['action'])){
	if($_POST['action']=="getSemaine"){
?>
	
<table class="table table-bordered">
	<tr>
		<th><div>Lundi</div></th>
		<th><div>Mardi</div></th>
		<th><div>Mercredi</div></th>
		<th><div>Jeudi</div></th>
		<th><div>Vendredi</div></th>
	</tr>
	<tr>
		<?php

		for($i=1;$i<=5;$i++):
			$query = getClasse(0,0,$i);
			$planning = $bdd->prepare($query);
			$planning->execute(array(
				'id_classe' => $_SESSION['idclasse'],
				'semaine'   => $_POST['semaine']
				));
			$dPlanning = $planning->fetch();

			$query = getClasse(1,0,$i);
			$matin = $bdd->prepare($query);
			$matin->execute(array(
				'id_matiere' => $dPlanning['id_matiere'],
				'id_salle'   => $dPlanning['id_salle'],
				'id_prof'    => $dPlanning['id_prof']
				));
			$dMatin = $matin->fetch();
		if ($dPlanning['id'] != null) 
		{
		?>
		<td style="background-color:<?= $dMatin['couleur']; ?>">
			<div>
				<?= $dMatin['matiere']."<br/>".ucfirst($dMatin['prenom'])." ".$dMatin['nom']."<br/>".$dMatin['salle']; ?>
			</div>
			<div>
			<form id="form" action="delete-classes.php?id=<?php echo $dPlanning['id']; ?>" method="post">

				<INPUT TYPE="submit" NAME="del" VALUE="Supprimer">

			</form>
				
			</div>
				
		</td>
		<?php
				} 
				else
				{
					echo '<td style="background-color:#bdc3c7"></td>';
				}
			 ?>
		<?php endfor; ?>
	</tr>
	<tr>
		<?php
		for($i=1;$i<=5;$i++):
			$query = getClasse(0,1,$i);
			$planning = $bdd->prepare($query);
			$planning->execute(array(
				'id_classe' => $_SESSION['idclasse'],
				'semaine'   => $_POST['semaine']
				));
			$dPlanning = $planning->fetch();

			$query = getClasse(1,1,$i);
			$aprem = $bdd->prepare($query);
			$aprem->execute(array(
				'id_matiere' => $dPlanning['id_matiere'],
				'id_salle'   => $dPlanning['id_salle'],
				'id_prof'    => $dPlanning['id_prof']
				));
			$dAprem = $aprem->fetch();
		if ($dPlanning['id'] != null) 
		{
		?>
		<td style="background-color:<?= $dAprem['couleur']; ?>">
			<div>
				<?= $dAprem['matiere']."<br/>".ucfirst($dAprem['prenom'])." ".$dAprem['nom']."<br/>".$dAprem['salle']; ?>
			</div>
			<div>
			<form id="form" action="delete-classes.php?id=<?php echo $dPlanning['id']; ?>" method="post">
				
				<INPUT TYPE="submit" NAME="del" VALUE="Supprimer">

			</form>
				
			</div>
		</td>
		<?php
				} 
				else
				{
					echo '<td style="background-color:#bdc3c7"></td>';
				}

			  endfor; ?>
	</tr>
</table>

			<div>

				<a href="../ajout_cours_classe.php?id=<?php echo $_SESSION['idclasse']; ?>"><button NAME="ajout">Ajouter un cours</button></a>

			</div>

<?php	
	}
}

?>