
<div class="row">
	<div class="col-md-12"><h2>Administration Benutzer einfügen </h2> 
	
	</div>
</div>

			
					
	
<div class="row">
	<div class="col-md-6">
		<form class="form " action="index.php?aktion=adminBenutzer&" method=post >
			  <div class="form-group" >
				<label for="Vorname">Vorname</label>
				<input type="text" class="form-control" id="Vorname" name="Vorname" placeholder="Vorname">
			  </div>
			  
			<div class="form-group" >
				<label for="Nachname">Nachname</label>
				<input type="text" class="form-control" id="Nachname" name="Nachname" placeholder="Nachname">
			  </div>
			  
			  <div class="form-group" >
				<label for="Benutzername">Benutzername</label>
				<input type="text" class="form-control" id="Benutzername" name="Benutzername" placeholder="Benutzername">
			  </div>
			  
			  
			  <div class="form-group" >
				<label for="Passwort">Passwort</label>
				<input type="text" class="form-control" id="Passwort" name="Passwort" placeholder="Passwort">
			  </div>
			  
			  
			   <div class="form-group" >
				<label for="Nutzerrecht">Nutzerrecht</label>
				<div class="radio">
				  <label><input type="radio" name="Nutzerrecht" value="normal" checked>&nbsp; Lehrer</label>
				</div>
				<div class="radio">
				  <label><input type="radio" name="Nutzerrecht" value="admin">&nbsp; Administrator</label>
				</div>
			  </div>
			  
			
			  <button type="submit" name="BenutzerEinbinden" class="btn btn-primary">Benutzer Einbinden</button>
		</form>
	</div>
</div>

<a href="index.php?aktion=adminGeraete&sortierung=ID&reihenfolge=DESC">zurück</a>	