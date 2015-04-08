<?php 

include_once('../config.php');

$color = "blue";
		

if(isset($_POST['action'])){

	$req_planning = $bdd->query("SELECT max(id) FROM planning");
	$planning_id = $req_planning->fetch();
	$planning_id_max = $planning_id[0];
	$planning_id_max++;


	$req = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = :profid");
	$req->execute(array('profid' => $_SESSION['idprof']));
	$prof = $req->fetch();


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
			$query = getProf(0,0,$i);
			$planning = $bdd->prepare($query);
			$planning->execute(array(
				'id_prof'    => $_SESSION['idprof'],
				'semaine'    => $_POST['semaine']
				));
			$dPlanning = $planning->fetch();

			$query = getProf(1,0,$i);
			$matin = $bdd->prepare($query);
			$matin->execute(array(
				'id_matiere' => $prof['id_matiere'],
				'id_classe'  => $dPlanning['id_classe'],
				'id_salle'   => $dPlanning['id_salle']
				));
			$dMatin = $matin->fetch();

		if ($dPlanning['id'] != null) 
		{
		?>
		<td style="background-color:<?= $dMatin['couleur']; ?>">
			<div>
				<?= $dMatin['matiere']."<br/>".$dMatin['classe']."<br/>".$dMatin['salle']; ?>
			</div>
			<div>
				<form id="form" action="delete-prof.php?id=<?php echo $dPlanning['id']; ?>" method="post">

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
			$query = getProf(0,1,$i);
			$planning = $bdd->prepare($query);
			$planning->execute(array(
				'id_prof'    => $_SESSION['idprof'],
				'semaine'    => $_POST['semaine']
				));
			$dPlanning = $planning->fetch();

			$query = getProf(1,1,$i);
			$aprem = $bdd->prepare($query);
			$aprem->execute(array(
				'id_matiere' => $prof['id_matiere'],
				'id_classe'  => $dPlanning['id_classe'],
				'id_salle'   => $dPlanning['id_salle'],
				));
			$dAprem = $aprem->fetch();
		if ($dPlanning['id'] != null) 
				{
		?>
		<td style="background-color:<?= $dAprem['couleur']; ?>">
			<div>
				<?= $dPlanning['id']."<br/>".$dAprem['matiere']."<br/>".$dAprem['classe']."<br/>".$dAprem['salle']; ?>
			</div>
			<div>	
				<form id="form" action="delete-prof.php?id=<?php echo $dPlanning['id']; ?>" method="post">
			
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

				<a href="../ajout_cours_prof.php?id=<?php echo $_SESSION['idprof']; ?>"><button NAME="ajout">Ajouter un cours</button></a>

			</div>
	

<?php	
		
	}
}

?>