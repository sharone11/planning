<div class='container'>
			<div style = "width:45%; float:left" >

				<table class="table table-bordered">
						<tr>
							<th><div class="center">Classes</div></th>
						</tr>
						<?php
						    try {
							      $req = $bdd->query("SELECT * FROM classes");
							      while ($classe = $req->fetch())
							      {
							      ?>
							         <tr>
							            <td>
							            	<a href="page/config-classes.php?id=<?php echo $classe['id']; ?>">
							                <button type='submit' name='modif_profils' class='btn2'>
							                     <div class='center controls'><?php echo $classe['classe'];?></div>
							                 </button>
							               </a>
							            </td>
							         </tr>
							      <?php                               
							      }
							   }   
							   catch(Exception $e) {
							        echo $e->getMessage();
							   }
						                     
						?>
						
				</table>
			</div>
			<div style = "width:45%; float:right">
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
</div>