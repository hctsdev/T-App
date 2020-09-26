


<div class="row">
	<div class="col-md-12"><h3>Bitten wählen Sie Ihr Klassenzimmer aus:</h3> 
	
	</div>
</div>



<div class="row">
	<?php foreach($data['Klassenzimmer'] as $zimmer){?>
	<div class="col-md-2 mb-4">
	
			<?php  echo "<a class='btn btn-primary btn-lg active' role='button' aria-pressed='true' href='index.php?aktion=RaumEinsehen&ID=".$zimmer->gebeID()."&'>".$zimmer->gebeRaum()."</a>";?>
	
	</div>
	
	<?php } ?>
	
	
</div>

