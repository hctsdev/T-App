
<div class="row">
	<div class="col-md-12"><h2>Administration Benutzer </h2> 
	
	</div>
</div>

			
					
					
<div class="row">
	<div class="col-md-4">
	
	<a href="index.php?aktion=adminBenutzerEinfuegen&"><button type="button" class="btn btn-primary">Benutzer anlegen</button></a>
	</div>
</div>



<div id="row">
	<table class="table">
		<tr>
			
			<th scope="col">Name
				<a href="index.php?aktion=adminBenutzer&sortierung=Nachname&reihenfolge=ASC"><span class=" 	fa fa-level-up" aria-hidden="true"></span></a>
				<a href="index.php?aktion=adminBenutzer&sortierung=Nachname&reihenfolge=DESC"><span class=" 	fa fa-level-down" aria-hidden="true"></span></a>
			
			</th>
			
			<th scope="col">Vorname
				<a href="index.php?aktion=adminBenutzer&sortierung=Vorname&reihenfolge=ASC"><span class=" 	fa fa-level-up" aria-hidden="true"></span></a>
				<a href="index.php?aktion=adminBenutzer&sortierung=Vorname&reihenfolge=DESC"><span class=" 	fa fa-level-down" aria-hidden="true"></span></a>
			
			</th>
			
			<th scope="col">Benutzername
				<a href="index.php?aktion=adminBenutzer&sortierung=Benutzername&reihenfolge=ASC"><span class=" 	fa fa-level-up" aria-hidden="true"></span></a>
				<a href="index.php?aktion=adminBenutzer&sortierung=Benutzername&reihenfolge=DESC"><span class=" 	fa fa-level-down" aria-hidden="true"></span></a>
			
			</th>
			
			<th scope="col">Privileg
				<a href="index.php?aktion=adminBenutzer&sortierung=Privilegien&reihenfolge=ASC"><span class=" 	fa fa-level-up" aria-hidden="true"></span></a>
				<a href="index.php?aktion=adminBenutzer&sortierung=Privilegien&reihenfolge=DESC"><span class=" 	fa fa-level-down" aria-hidden="true"></span></a>
			
			</th>
			
			

			<th scope="col">  <span class="fa fa-trash" aria-hidden="true"></span></th>
		</tr>
		
		<?php foreach($data['AlleBenutzer'] as $benutzer){
					
					
					?>
		 	
		<tr>
			<th><?php echo $benutzer->NameGeben();?></th>
			<td><?php echo $benutzer->VornameGeben();?></td>
			
			<td><a href="index.php?aktion=adminBenutzerVerwalten&ID=<?php echo $benutzer->IDGeben();?>"><?php echo $benutzer->BenutzernameGeben();?></a></td>
			<td><?php echo $benutzer->RechteGeben();?></td>
			
			
			
			<td>
			<?php if($_SESSION['benutzer']->IDGeben() != $benutzer->IDGeben()){?>
			<a href="index.php?aktion=adminBenutzer&delete=<?php echo $benutzer->IDGeben();?>"><span class="fa fa-trash" aria-hidden="true"></a></span></td>
			<?php }?>
		</tr>
		<?php }?>
	</table>
</div>
