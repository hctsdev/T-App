

<div class="row">
	<div class="col-md-12"><h2>Toilette: <?php echo $data['Toilette']->gebeRaum();?> </h2> </div>
</div>



<div class="row">
	<div class="col-md-6">
		<form class="form " action="index.php?aktion=adminToiletteUmbenennen&ID=<?php echo $data["Toilette"]->GebeID() ;?>" method=post >
			
			
			
			 <div class="form-group" >
				<label for="neuerName">Name</label>
				<input type="text" class="form-control" id="neuerName" name="neuerName" value="<?php echo $data["Toilette"]->gebeRaum();?>">
			  </div>
			
			<label >Geschlecht:</label> <br />
							 <div class="col">	
								<div class="form-check">
								  <input class="form-check-input" type="radio" name="Geschlecht" id="Mädchen" value="Mädchen" <?php if($data['Toilette']->gebeGeschlecht()=="Mädchen"){echo "checked";}?>>
								  <label class="form-check-label" for="Mädchen">
									Mädchen
								  </label>
								</div>
								<div class="form-check">
								  <input class="form-check-input" type="radio" name="Geschlecht" id="Jungen" value="Jungen" <?php if($data['Toilette']->gebeGeschlecht()=="Jungen"){echo "checked";}?>>
								  <label class="form-check-label" for="Jungen">
									Jungen
								  </label>
								</div>
								
						</div>
						
		
			
			  <button type="submit" name="ToiletteAktualisieren" class="btn btn-primary">Toilette aktualisieren</button>
		</form>
	</div>
</div>

<div class="row">
<div class="col-md 12">
	<a href="index.php?aktion=adminToiletten">zurück</a>
</div>

</div>
