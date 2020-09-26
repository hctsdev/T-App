
<div class="row">
	<div class="col-md-12"><h2>Administration Toiletten </h2> </div>
</div>

<div class="row">
	<div class="offset-md-1 col11">
		
		
		
		<form  action="index.php?aktion=adminToiletten&" method=post>
			  <div class="form-row" >
			
				<div class="col">
				
				<input type="text" class="form-control" id="Name" name="Name" placeholder="Name">
			  </div>
			
						<label ><b>Geschlecht:</b></label> <br />
							 <div class="col">	
								<div class="form-check">
								  <input class="form-check-input" type="radio" name="Geschlecht" id="Mädchen" value="Mädchen" checked>
								  <label class="form-check-label" for="Mädchen">
									Mädchen
								  </label>
								</div>
								<div class="form-check">
								  <input class="form-check-input" type="radio" name="Geschlecht" id="Jungen" value="Jungen">
								  <label class="form-check-label" for="Jungen">
									Jungen
								  </label>
								</div>
								
						</div>
						
			 
			 
			 <div class="col">
			  <button type="submit" name="ToiletteEinbinden" class="btn btn-primary">Toilette Einbinden</button>
			  </div>
			 </div>
		</form>
	</div>
</div>



<div class="row">
	<div class="col-md-4">
	
			<table class="table table-hover table-striped">
				<tr>
					<th>Name</th>
					<th>Geschlecht</th>
					<th>Bearbeiten</th>
					<th>Löschen</th>
					
				</tr>
				
				
				<?php foreach($data['Toiletten'] as $toilette){
					
					?>
					
				<tr>
					<td><?php echo $toilette->GebeRaum();?></td>
					<td><?php echo $toilette->GebeGeschlecht();?></td>
				
					<td><?php echo '<a href="index.php?aktion=adminToiletteUmbenennen&ID='.$toilette->GebeID().'">';?><span class="fa fa-pencil" aria-hidden="true"></span><?php echo '</a>';?></td>
				
					<td><?php echo '<a href="index.php?aktion=adminToiletten&delete='.$toilette->GebeID().'">';?><span class="fa fa-trash" aria-hidden="true"></span><?php echo '</a>';?></td>
				</tr>
					
					
					<?php
				}?>
				
				
				
				
				
			</table>
	
	</div>
</div>