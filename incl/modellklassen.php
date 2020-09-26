<?PHP
	

    function Logfile ($aktion)
	{
		/*
		$session_username = "Gast";
		if (isset($_SESSION["benutzer"]))
		{
			$session_username = $_SESSION["benutzer"]->BenutzernameGeben();
		}
        
		$fp = fopen("datenbankcheck.log", "a+");
		date_default_timezone_set ("Europe/Berlin");
		fputs ($fp, date("d.M.Y H:i")." - ".$session_username." - ".$aktion."\n");
		fclose ($fp);
		*/
	}
    
	function Darf ($was)
	{
		return isset ($_SESSION [$was . "_admin"]);
	}

	
	class DBAnbindung
	{
		private $db;
		private $lasterror;
		
		public function __construct ()
		{
			include ("dbconnect.php");
			
			
			$this->db = new mysqli ("localhost", $DatenbankcheckBenutzer, $DatenbankcheckPasswort, $DatenbankcheckDatenbank);
			
			if (mysqli_connect_errno())
			{
				printf ("Fehler bei connect: %s\n", mysqli_connect_error());
				exit ();
			}
            $this->db->query ("SET CHARACTER SET 'utf8'");
		}
		
		public function __destruct ()
		{
			$this->db->close();
		}
		
		private function LogFileQ ($aktion)
		{
			$session_username = "Fachlehrer";
			if (isset($_SESSION["benutzer"]))
			{
				$session_username = $_SESSION["benutzer"]->BenutzernameGeben();
			}
            
			$fp = fopen("Physiksammlung.log", "a+");
			date_default_timezone_set ("Europe/Berlin");
			$lasterror = $this->db->error;
			fputs ($fp, date("d.M.Y H:i")." - " . $session_username . " - ".$aktion."\n");
			fputs ($fp, "Erg: " . $this->db->errno . ": " . $lasterror . "\n");
			fclose ($fp);
		}
        
        public function FehlerGeben ()
        {
        	return $this->lasterror;
        }
		
		public function NavigationHolen ($admin)
		{
			$navi = array ();
			$res = $this->db->query ("SELECT * FROM navigation WHERE FIND_IN_SET ('" . $admin . "', rechte) ORDER BY sortierung ASC");
			while ($row = $res->fetch_object())
			{
				array_push ($navi, new NavigationEintrag ($row->text, $row->aktion, $row->kommentar, $row->ebene, $row->rechte, $row->sortierung));
			}
			return $navi;
		}
		
		public function Anmelden ($username, $passwort)
		{
			$res=false;
			$sql = "SELECT benutzername FROM benutzer WHERE benutzername = ? AND passwort = ?";
			
			$abfrage = $this->db->prepare( $sql );
			$passwort=sha1($passwort);
			$abfrage->bind_param( 'ss', $username, $passwort);
			$abfrage->execute();
    		$abfrage->bind_result ($benutzername);
    		if ($abfrage->fetch())
            {
    			$res=true;
    			$abfrage->close();
    			$user = $this->BenutzerHolen($benutzername);
				$_SESSION["benutzer"]=$user;
                
                $_SESSION ["normal_admin"] = 1;
                if ($user->RechteGeben () == "admin")
                {
                	$_SESSION ["admin_admin"] = 1;
                }

				//$this->LogFileQ ("angemeldet");
    		}
            else
            {
                $res=false;
    		};
            return $res;
		}

		
		

		
		
		public function BenutzerHolen ($benutzer)
		{
			$stmt = $this->db->prepare ("SELECT ID, benutzername, passwort, privilegien FROM benutzer WHERE benutzername=?");
			$stmt->bind_param ("s", $benutzer);
			$stmt->execute ();
			$stmt->bind_result ($ID, $benutzer, $passwort, $rechte);
			if ($stmt->fetch())
			{
				$user = new Benutzer ($ID, $benutzer, $passwort, $rechte);
				$stmt->close ();
				return $user;
			}
			else
			{
				$this->LogFileQ ("BenutzerHolen für ". $benutzer);
                $stmt->close ();
				return NULL;
			}
		}
		
		
		public function BenutzerHolenID ($benutzerID)
		{
			$stmt = $this->db->prepare ("SELECT ID, benutzername, passwort, privilegien FROM benutzer WHERE ID=?");
			$stmt->bind_param ("i", $benutzerID);
			$stmt->execute ();
			$stmt->bind_result ($ID, $benutzer, $passwort, $rechte);
			if ($stmt->fetch())
			{
				$user = new Benutzer ($ID, $benutzer, $passwort, $rechte);
				$stmt->close ();
				return $user;
			}
			else
			{
				$this->LogFileQ ("BenutzerHolen für ". $benutzer);
                $stmt->close ();
				return NULL;
			}
		}
		
		public function AlleBenutzerHolen($sortierung, $reihenfolge)
		{
			$stmt = $this->db->prepare ("SELECT ID, Nachname, Vorname, benutzername, passwort, privilegien FROM benutzer ORDER BY LOWER($sortierung) $reihenfolge");
			$benutzer = array();
			$stmt->execute ();
			$stmt->bind_result ($ID, $Name, $Vorname, $benutzername, $passwort, $privilegien);
			
			
			
			
			while ($stmt->fetch())
			{
				$nutzer = new Benutzer ($ID, $benutzername, $passwort, $privilegien, $Name, $Vorname);
				array_push($benutzer, $nutzer );
				
				
			}
			return $benutzer;
			$stmt->close ();
			
		}
		
		
		
		public function checkeObNutzernameVorhanden($name){
			$stmt = $this->db->prepare ("SELECT ID FROM benutzer WHERE benutzername=?");
			$stmt->bind_param ("s", $name);
			$stmt->execute ();
			$stmt->bind_result ($ID);
			if ($stmt->fetch())
			{
				$stmt->close ();
				return true;
			}else{
				return false;
			}
		}
		
		
		public function FuegeBenutzerEin($Vorname, $Nachname, $Benutzername, $Passwort, $Privileg)
		{
			$Passwort = sha1($Passwort);
			$stmt = $this->db->prepare ("INSERT INTO benutzer (Vorname, Nachname, benutzername, passwort, privilegien) VALUES (?,?,?,?,?)");
			$stmt->bind_param ("sssss", $Vorname, $Nachname, $Benutzername, $Passwort, $Privileg);
			$stmt->execute ();
			$this->LogFileQ ("Benutzer ".$Benutzername." eingefügt");
		}
		
		
		
		public function updateNutzerdaten($nutzername, $passwort){
			
			
			$ID = $_SESSION['benutzer']->IDGeben();
		
			$update = $this->db->prepare ("UPDATE benutzer 
														SET benutzername=?,
														passwort = ?,
														
														WHERE ID= ?
														");
														
						
						$update->bind_param ("ssi", $nutzername, $passwort, $ID);
					
						$update->execute ();
						$update->close();
		}
        
		
		
		public function loescheBenutzer($benutzer){
		
				if($_SESSION['benutzer']->IDGeben() != $benutzer)
				{
				
				 $stmt = $this->db->prepare ("DELETE FROM benutzer
															WHERE ID = ? 
									");
					
					
							$stmt->bind_param ("i", $benutzer);
							
							$stmt->execute ();
							
							$stmt->close();
							$this->LogFileQ ($benutzer." gelöscht");
								
			  } 
		}
	  
	
		
		public function FuegeKlassenzimmerEin($name)
		{
			
			$stmt = $this->db->prepare ("INSERT INTO klassenzimmer(Raum) VALUES (?)");
			
			$stmt->bind_param ("s", $name);
			$stmt->execute();
		
			$stmt->close();

		}
		
		public function holeIDzuKlassenzimmer($name)
		{
			$stmt = $this->db->prepare ("SELECT klassenzimmer.ID FROM klassenzimmer WHERE Raum = ?");
				$stmt->bind_param("s",$name);
				$stmt->execute ();
				$stmt->bind_result ($ID);
				

				if ($stmt->fetch())
				{
				$stmt->close();
				return $ID;
			}
			
			
		}
		
		public function ordneToilettenZuKlassenzimmer($ID, $toiletten)
		{
			
			
			
			if(is_array($toiletten) && count($toiletten)>0){
			
$stmt = $this->db->prepare ("DELETE FROM klassenzimmer_toilette
													WHERE KlassenzimmerID = ? 
							");
			
			
					$stmt->bind_param ("i", $ID);
					
					$stmt->execute ();
					
					$stmt->close();



			for($i=0; $i<count($toiletten); $i++)
					{
						$toilette = $toiletten[$i];
						$stmt= $this->db->prepare ("INSERT INTO klassenzimmer_toilette (KlassenzimmerID, ToiletteID) VALUES (?,?)");
						$stmt->bind_param ("ii", $ID, $toilette);
						$stmt->execute ();
						$stmt->close();
					}
				}
			
		}
		
		public function holeKlassenzimmer()
		{
			$stmt = $this->db->prepare ("SELECT ID, Raum FROM klassenzimmer ORDER BY Raum");
			$klassenzimmer = array();
			$stmt->execute ();
			$stmt->bind_result ($ID, $Raum);
			
			
			
			
			while ($stmt->fetch())
			{
				
				$zimmer = new Klassenzimmer ($ID, $Raum);
				
				array_push($klassenzimmer, $zimmer );
				
				
			}
			$stmt->close ();
			
			
			foreach($klassenzimmer as $zimmer)
			{
				$zimmer->SetzeToiletten($this->holeToilettenZuKlassenzimmer($zimmer->gebeID()));
				
			}
			
			
			
			return $klassenzimmer;
			
			
		}
		
		
		
		public function holeKlassenzimmerMitID($ID)
		  {
			 
				$stmt = $this->db->prepare ("SELECT ID, Raum FROM klassenzimmer WHERE ID = ?");
				$stmt->bind_param("i", $ID);
				$stmt->execute ();
				$stmt->bind_result ($ID, $Raum);
				

				if ($stmt->fetch())
				{
				
						$stmt->close ();
					
					$klassenzimmer = new Klassenzimmer ($ID, $Raum);
					
					$klassenzimmer->SetzeToiletten($this->holeToilettenZuKlassenzimmer($ID));
				
					return $klassenzimmer;
					
					
					
				}
				
						
			
			  
		  }
		
		
		
		public function AktualisiereKlassenzimmer($ID, $name)
		{

			
			$stmt = $this->db->prepare ("UPDATE klassenzimmer SET Raum=? WHERE ID=?");
			$stmt->bind_param ("si", $name, $ID );
			$stmt->execute ();
			
			
		}
			
		
		public function LoescheKlassenzimmer($ID){
	
		 $stmt = $this->db->prepare ("DELETE FROM klassenzimmer
													WHERE ID = ? 
							");
			
			
					$stmt->bind_param ("i", $ID);
					
					$stmt->execute ();
					
					$stmt->close();
					
					

					$stmt = $this->db->prepare ("DELETE FROM klassenzimmer_toilette
													WHERE KlassenzimmerID = ? 
							");
			
			
					$stmt->bind_param ("i", $ID);
					
					$stmt->execute ();
					
					$stmt->close();
										
	  } 
	  
	  
	  
	  
	  public function FuegeToiletteEin($name, $geschlecht)
		{
			
			$stmt = $this->db->prepare ("INSERT INTO toilette(Raum, Geschlecht, besetzt) VALUES (?,?,false)");
			$stmt->bind_param ("ss", $name, $geschlecht);
			$stmt->execute ();
		}
		
		public function holeToiletten()
		{
			$stmt = $this->db->prepare ("SELECT ID, Raum, Geschlecht, besetzt FROM toilette ORDER BY Raum");
			$toiletten = array();
			$stmt->execute ();
			$stmt->bind_result ($ID, $Raum, $Geschlecht, $besetzt);
			
			
			
			
			while ($stmt->fetch())
			{
				
				$toilette = new Toilette ($ID, $Raum, $Geschlecht, $besetzt);
				
				array_push($toiletten, $toilette );
				
				
			}
			$stmt->close ();
			return $toiletten;
			
			
		}
		
		public function holeToilettenZuKlassenzimmer($klassenzimmerID)
		{
			$stmt = $this->db->prepare ("SELECT ID, Raum, Geschlecht, besetzt
										FROM toilette, klassenzimmer_toilette
										WHERE toilette.ID = klassenzimmer_toilette.ToiletteID
										AND klassenzimmer_toilette.KlassenzimmerID = ?");
			$stmt->bind_param("i", $klassenzimmerID);
			$toiletten = array();
			$stmt->execute ();
			$stmt->bind_result ($ID, $Raum, $Geschlecht, $besetzt);
			
			
			
			
			while ($stmt->fetch())
			{
				
				$toilette = new Toilette ($ID, $Raum, $Geschlecht, $besetzt);
				
				array_push($toiletten, $toilette );
				
				
			}
		
			
			$stmt->close ();
			
				
			foreach($toiletten as $toilette)
			{
				if($toilette->gebeBesetzt() != -1){
					
					
					//	echo $this->holeKlassenzimmerMitID($toilette->gebeBesetzt())->GebeRaum();
					$toilette->setzeBesetzt( $this->holeRaumZuToilette($toilette->gebeBesetzt()));	
					
				}
			}
			return $toiletten;
			
			
		}
		
		public function holeRaumZuToilette($toilettenID)
		{
			$stmt = $this->db->prepare ("SELECT Raum FROM klassenzimmer WHERE ID = ?");
				$stmt->bind_param("i", $toilettenID);
				$stmt->execute ();
				$stmt->bind_result ($Raum);
				

				if ($stmt->fetch())
				{
				
					$stmt->close ();	
					
					return $Raum;
					
					
					
				}
		}
		
		public function holeToilettenIDZuKlassenzimmer($klassenzimmerID)
		{
			$stmt = $this->db->prepare ("SELECT ID
										FROM toilette, klassenzimmer_toilette
										WHERE toilette.ID = klassenzimmer_toilette.ToiletteID
										AND klassenzimmer_toilette.KlassenzimmerID = ?");
			$stmt->bind_param("i", $klassenzimmerID);
			$toiletten = array();
			$stmt->execute ();
			$stmt->bind_result ($ID);
			
			
			
			
			while ($stmt->fetch())
			{
				
				
				
				array_push($toiletten, $ID );
				
				
			}
			$stmt->close ();
			return $toiletten;
			
			
		}
		
		
		
		public function holeToiletteMitID($ID)
		  {
			 
				$stmt = $this->db->prepare ("SELECT ID, Raum, Geschlecht, besetzt FROM toilette WHERE ID = ?");
				$stmt->bind_param("i", $ID);
				$stmt->execute ();
				$stmt->bind_result ($ID, $Raum, $Geschlecht, $besetzt);
				

				if ($stmt->fetch())
				{
				
						$stmt->close ();
					
					
					
				
					
					return new Toilette ($ID, $Raum, $Geschlecht, $besetzt);
					
					
					
				}
				
						
			
			  
		  }
		
		
		
		public function AktualisiereToilette($ID, $name, $Geschlecht)
		{

			
			$stmt = $this->db->prepare ("UPDATE toilette SET Raum=?, Geschlecht=? WHERE ID=?");
			$stmt->bind_param ("ssi", $name, $Geschlecht, $ID );
			$stmt->execute ();
			
			
		}
			
		
		public function LoescheToilette($ID){
	
		 $stmt = $this->db->prepare ("DELETE FROM toilette
													WHERE ID = ? 
							");
			
			
					$stmt->bind_param ("i", $ID);
					
					$stmt->execute ();
					
					$stmt->close();
					
						
	  } 
	  
	  
	  
	 
	  
	  
		  public function invertiereZustandToilette($ID, $klassenzimmer){
			  
			$toilette = $this->holeToiletteMitID($ID);
			
			
			//Wenn unbesetzt
			if($toilette->GebeBesetzt() == -1)
			{
				 
			  $stmt = $this->db->prepare(" UPDATE toilette 
										SET besetzt = ?
										WHERE ID = ?
											  ");
					
					$stmt->bind_param ("si",$klassenzimmer, $ID);
					
					$stmt->execute ();
					$stmt->close();
				
			}else{
				
				 $stmt = $this->db->prepare(" UPDATE toilette 
										SET besetzt = '-1'
										WHERE ID = ?
											  ");
					
					$stmt->bind_param ("i",$ID);
					
					$stmt->execute ();
					$stmt->close();
				
			}
			  
			 
			  
			  
		  }
		  
		  
		  
	  
	}  
	  
	  
	  

	
	
	class NavigationEintrag
	{
		private $text;
		private $aktion;
		private $kommentar;
		private $ebene;
		private $rechte;
		private $sortierung;
		
		public function __construct ($text, $aktion, $kommentar, $ebene, $rechte, $sortierung)
		{
			$this->text = $text;
			$this->aktion = $aktion;
			$this->kommentar = $kommentar;
			$this->ebene = $ebene;
			$this->rechte = $rechte;
			$this->sortierung = $sortierung;
		}
		
		public function TextGeben ()
		{
			return $this->text;
		}
		
		public function AktionGeben ()
		{
			return $this->aktion;
		}
		
		public function KommentarGeben ()
		{
			return $this->kommentar;
		}
		
		public function EbeneGeben ()
		{
			return $this->ebene;
		}
		
		public function RechteGeben ()
		{
			return $this->rechte;
		}
		
		public function SortierungGeben ()
		{
			return $this->sortierung;
		}
	}
	class Benutzer
	{
		private $ID;
		private $benutzername;
		private $passwort;
		private $rechte;
		private $name;
		private $vorname;
		
		public function __construct ($id, $benutzername, $passwort, $rechte, $name="", $vorname="")
		{
			$this->ID = $id;
			$this->benutzername = $benutzername;
			$this->passwort = $passwort;
			$this->rechte = $rechte;
			$this->name = $name;
			$this->vorname = $vorname;
		}
		
		public function BenutzernameGeben ()
		{
			return $this->benutzername;
		}
		
		public function IDGeben ()
		{
			return $this->ID;
		}
		
		public function PasswortGeben ()
		{
			return $this->passwort;
		}

		public function RechteGeben ()
		{
			return $this->rechte;
		}
		
		public function NameGeben ()
		{
			return $this->name;
		}
		
		public function VornameGeben ()
		{
			return $this->vorname;
		}
		
		
	}
	
	
	
	class Klassenzimmer
	{
		private $ID;
		private $Raum;
		private $Toiletten;
		
		
		 public function __construct ($ID, $Raum)
        {
			$this->ID = $ID;			
			$this->Raum = $Raum;
	
			
        }
		
		 public function GebeID ()
        {
        	return $this->ID;
        }
		
		public function SetzeID($param)
		{
			
			$this->ID = $param;
		}
		
		 public function GebeRaum ()
        {
        	return $this->Raum;
        }
		
		public function SetzeRaum($param)
		{
			
			$this->Raum = $param;
		}
		
		 public function GebeToiletten ()
        {
        	return $this->Toiletten;
        }
		
		public function SetzeToiletten($param)
		{
			
			$this->Toiletten = $param;
		}
	}
	
	
	class Toilette
	{
		private $ID;
		private $Raum;
		private $Geschlecht;
		private $besetzt;
		
		 public function __construct ($ID, $Raum, $Geschlecht, $besetzt)
        {
			$this->ID = $ID;			
			$this->Raum = $Raum;
			$this->Geschlecht = $Geschlecht;
			$this->besetzt= $besetzt;
			
	
			
        }
		
		 public function GebeID ()
        {
        	return $this->ID;
        }
		
		public function SetzeID($param)
		{
			
			$this->ID = $param;
		}
		
		 public function GebeRaum ()
        {
        	return $this->Raum;
        }
		
		public function SetzeRaum($param)
		{
			
			$this->Raum = $param;
		}
		
		 public function GebeGeschlecht ()
        {
        	return $this->Geschlecht;
        }
		
		public function SetzeGeschlecht($param)
		{
			
			$this->Geschlecht = $param;
		}
		
		 public function GebeBesetzt ()
        {
        	return $this->besetzt;
        }
		
		public function SetzeBesetzt($param)
		{
			
			$this->besetzt = $param;
		}
		
	}
	
