
<div class="row">
	<div class="col-md-12"><h2>Administration Klassenzimmer </h2> </div>
</div>

<div class="row">
	<div class="col12">
		<form  action="index.php?aktion=adminKlassenzimmer&" method=post>
			  <div class="form-row" >
				<div class="col">
				<label for="Name">Klassenzimmer einfügen</label>
				</div>
				<div class="col">
				
				<input type="text" class="form-control" id="Name" name="Name" placeholder="Name">
			  </div>
			 
			
			
			<div class="col" >
					<label ><b>Toiletten:</b></label><br />
					
							
							<?php 
							foreach($data['Toiletten'] as $toilette)
							{
								
								
								
							echo '<input type="checkbox" name="toiletten[]"  value="'.$toilette->gebeID().'"><label> &nbsp;'. $toilette->gebeRaum().'</label> <br />';
							
							}
							
							
							
							
							?>
							
					
					</div>
			
			
			
			 
			 
			 <div class="col">
			  <button type="submit" name="KlassenzimmerEinbinden" class="btn btn-primary">Klassenzimmer Einbinden</button>
			  </div>
			  </div>
		</form>
	</div>
</div>



<div class="row">
	<div class="col-md-8">
	
			<table class="table table-hover table-striped">
				<tr>
					<th>Name</th>
					<th>Toiletten</th>
					<th>Bearbeiten</th>
					<th>Löschen</th>
					
				</tr>
				
				
				<?php foreach($data['Klassenzimmer'] as $zimmer){
					
					?>
					
				<tr>
					<td><?php echo $zimmer->GebeRaum();?></td>
					<td><?php foreach($zimmer->GebeToiletten() as $tol)
					{
						echo $tol->gebeRaum()." ".$tol->gebeGeschlecht()."<br />";
						
					}?></td>
				
					<td><?php echo '<a href="index.php?aktion=adminKlassenzimmerUmbenennen&ID='.$zimmer->GebeID().'">';?><span class="fa fa-pencil" aria-hidden="true"></span><?php echo '</a>';?></td>
				
					<td><?php echo '<a href="index.php?aktion=adminKlassenzimmer&delete='.$zimmer->GebeID().'">';?><span class="fa fa-trash" aria-hidden="true"></span><?php echo '</a>';?></td>
				</tr>
					
					
					<?php
				}?>
				
				
				
				
				
			</table>
	
	</div>
</div>