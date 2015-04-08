<?php 
include_once('../../config.php');


if (isset($_GET['id']))
{
	$id_prof = $_SESSION['idprof'];
	if (isset($_POST['del'])) 
	{
		try 
		{
			$sql = "DELETE FROM planning WHERE id = ".$_GET['id'];

		    // use exec() because no results are returned
		    $bdd->exec($sql);
			header('Location: ../choose-prof.php');
	    }
		catch(PDOException $e)
	    {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
		

	}

}
?>		
		


		
