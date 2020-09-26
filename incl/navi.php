<?php
	$usernamelog = "Fachlehrer";
	if (isset($_SESSION["benutzer"])) {
		$usernamelog = $_SESSION["benutzer"]->BenutzernameGeben();
	}
	
	
	?>
	<div class="row">
		<div class="col-12 ">Name</div>
	</div>	
	
	<div class="row">
		<div class="col-12 bg-info text-center"><?php echo $usernamelog ;?></div>
	</div>
	
	<div class="row-fluid">
	<?php
		if (isset($_SESSION["benutzer"]))
	{
		echo "<A HREF=index.php?aktion=abmelden&" . SID . " >Abmelden</A>";
	}
	else
	{
		echo "<A HREF='index.php?aktion=anmelden&Start&" . SID . "' >Anmelden Administration</A>";
	}
	?>
	</div>
		
	
	<?php
  	
	$first = 1;
	foreach ($data["navigationdata"] as $navi)
	{
		switch ($navi->EbeneGeben())
		{
			case 1:
				if ($first == 1)
				{
					echo "</p>";
					$first = 0;
				};
				echo "<p><font size=4>";
				break;
			case 2:
				echo "<br><font size=2>";
				break;
			default:
				echo "<br><font size=1>";
		};
		for ($i = 2; $i <= $navi->EbeneGeben(); $i++)
			echo "&nbsp;&nbsp;&nbsp;&nbsp;";
		if ($navi->AktionGeben() != "")
		{
			echo "<A HREF=\"" . $navi->AktionGeben() . SID . "\"";
			if ($navi->KommentarGeben() != "")
				echo " OnMouseOver=\"window.status='" . $navi->KommentarGeben() ."';return true;\"";
			echo ">" . $navi->TextGeben() . "</a>";
		}
		else
		{
			echo "<font class=dunkel>" . $navi->TextGeben() . "</font>";
		};
		echo "</font>\n";
	}
	echo "</p>";
    ?>
