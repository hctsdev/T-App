


<div class="row">
	<div class="col-md-12"><h2>Übersicht</h2> 
	
	</div>
</div>



<div class="row">

	<div class="col-md-8">
	
			<div class="card">
			  <div class="card-header">
				<h2>Raum: <b><?php echo $data['Klassenzimmer']->gebeRaum();?></b></h2>
			  </div>
			  <div class="card-body">
				
				<?php foreach($data['Klassenzimmer']->gebeToiletten() as $toilette){
					if($toilette->gebeBesetzt()!= -1){
						$farbe = "btn-danger";
						$nachricht = "besetzt";
					}else{
						
						$farbe = "btn-success";
						$nachricht = "frei";
					}
					?>
				
				<a href="index.php?aktion=RaumEinsehen&ID=<?php echo $data['Klassenzimmer']->gebeID();?>&ToilettenID=<?php echo $toilette->gebeID();?>" class="btn <?php echo $farbe;?> btn-lg"><?php echo $toilette->gebeRaum()." ".$toilette->gebeGeschlecht();?><br /><?php echo $nachricht;?>
				 <br /> 
				 <?php 
				 if($toilette->gebeBesetzt()!= -1){
						echo "(".$toilette->gebeBesetzt().")";
					}
				 ?>
				</a>
				<?php }?>
			  </div>
			</div>
	</div>

	
</div>


  <div class="row">
	<div class="col-md-12">
	<p><a href="index.php?aktion=RaeumeEinsehen">zurück</a></p>
	
	</div>
</div>


  <script language=javascript>
window.setTimeout('window.location = "index.php?aktion=RaumEinsehen&ID=<?php echo json_encode($data['Klassenzimmer']->gebeID()); ?>"',3000);
</script>
  
  