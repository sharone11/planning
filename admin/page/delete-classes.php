<?php 
include_once('../../config.php');

if (isset($_GET['id'])){

	if (isset($_POST['del'])) {

		$sql = "DELETE FROM planning WHERE id = ".$_GET['id'];

	    // use exec() because no results are returned
	    $bdd->exec($sql);

		header('Location: ../choose-classes.php');

	}

	if (isset($_POST['ajou'])) {

		

		header('Location: ../choose-classes.php');

	}
} 

?>