



<div class="row">
  <div class="col-md-12"><h2 >Administration</h2></div>
  

</div>



<div class="row">
  <div class="col-12 text-left">
  

<form class="" action="index.php?aktion=anmelden&<?php echo SID ?>" method=post>
  <div class="form-group">
    
    <div class="col-4">
		<input type="text" class="form-control" name="benutzername" id="Benutzer" placeholder="Benutzer">
	</div>
  </div>
  <div class="form-group">
    
    <div class="col-4">
		<input type="password" name="benutzerpasswort" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
 
  
  </div>
  <div class="col-12">
	<button type="submit" class="btn btn-info" value="Anmelden">Anmelden</button>
  </div>
</form>
  
  
</div>
</div>
<?php
if (array_key_exists ("fehler", $data))
{
	echo "<p><p><p><font size=+3 color=\"#FF0000\">Fehler beim Anmelden.</font>\n";
}
?>


	  
