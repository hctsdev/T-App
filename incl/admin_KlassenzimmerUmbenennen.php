

<div class="row">
	<div class="col-md-12"><h2>Klassenzimmer: <?php echo $data['Klassenzimmer']->gebeRaum();?> </h2> </div>
</div>



<div class="row">
	<div class="col-md-6">
		<form class="form " action="index.php?aktion=adminKlassenzimmerUmbenennen&ID=<?php echo $data["Klassenzimmer"]->GebeID() ;?>" method=post >
			
			
			
			 <div class="form-group" >
				<label for="neuerName">Name</label>
				<input type="text" class="form-control" id="neuerName" name="neuerName" value="<?php echo $data["Klassenzimmer"]->gebeRaum();?>">
			  </div>
			
			<div class="form-group" >
					<label ><b>Toiletten:</b></label><br />
					
							
							<?php 
							foreach($data['Toiletten'] as $toilette)
							{
								$checked="";
								
								
								if(is_array($data['aktivierteToiletten']) && in_array($toilette->gebeID(), $data['aktivierteToiletten']))
								{
									$checked = ' checked="checked"';
								}
								
							echo '<input type="checkbox" name="toiletten[]" '.$checked.' value="'.$toilette->gebeID().'"><label> &nbsp;'. $toilette->gebeRaum().' '.$toilette->gebeGeschlecht().'</label> <br />';
							
							}
							
							
							
							
							?>
							
					
					</div>
		
			
			  <button type="submit" name="KlassenzimmerAktualisieren" class="btn btn-primary">Klassenzimmer umbenennen</button>
		</form>
	</div>
</div>

<div class="row">
<div class="col-md 12">
	<a href="index.php?aktion=adminKlassenzimmer">zurück</a>
</div>

</div>
