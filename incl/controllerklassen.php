<?PHP
	class DarfNichtException extends Exception {}
    
	class controller_basis
	{
		protected $tpl_navigation;
		protected $tpl_content;
		protected $db;
		protected $data = array();
		
		public function __construct ($tpl_navigation, $tpl_content, $db, $darf)
		{
			if (($darf != "") && (!Darf($darf)))
            {
				throw new DarfNichtException();
			}
			$this->tpl_navigation = $tpl_navigation;
			$this->tpl_content = $tpl_content;
			$this->db = $db;
		}
		
		public function Aktion ()
		{
			if (isset($_SESSION["benutzer"]))
			{
				$admin = $_SESSION["benutzer"]->RechteGeben();
			}
			else
			{
				$admin="normal";
			}
			$this->data["navigationdata"] = $this->db->NavigationHolen ($admin);
			$tpl_navigation = $this->tpl_navigation;
			$tpl_content = $this->tpl_content;
			$data = $this->data;
			include ("template.php");
		}
	}
    
	class controller_falscheseite extends controller_basis
	{
		
		public function __construct ($tpl_navigation, $tpl_content, $db, $grund)
		{
			parent:: __construct ($tpl_navigation, $tpl_content, $db, "");
            $this->data["grund"] = $grund;
		}
		
		public function Aktion ()
		{
			$this->tpl_content = "falsch.php";
			parent::Aktion();
		}
	}
	
	class controller_start extends controller_basis
	{
		
		public function __construct ($tpl_navigation, $tpl_content, $db)
		{
			parent:: __construct ($tpl_navigation, $tpl_content, $db, "");
		}
		
		public function Aktion ()
		{
			if (isset ($_SESSION["benutzer"]))
			{
				
				if($_SESSION['benutzer']->RechteGeben()=="admin")
				{
					$this->tpl_content = "admin_start.php";
				}
				
				
			}
			else
			{
				$this->tpl_content = "start.php";
			}
			parent::Aktion();
		}
	}

	class controller_anmelden extends controller_basis
	{
		
		public function __construct ($tpl_navigation, $tpl_content, $db)
		{
			parent:: __construct ($tpl_navigation, $tpl_content, $db, "");
		}
		
		public function Aktion ()
		{
			
			$username = "";
			$passwort = "";
			
			
			
			
			if (isset($_POST["benutzername"])) {
				$username = $_POST["benutzername"];
				
			};
			if (isset($_POST["benutzerpasswort"])) {
				$passwort = $_POST["benutzerpasswort"];
			};
			if ($username != "" ) {
				$res = $this->db->Anmelden ($username, $passwort);
				if ($res)
				{
                    $controller = new controller_start($this->tpl_navigation, "start.php", $this->db);
                    $controller->Aktion();
				}else{
					
					$this->data["fehler"] = "Fehler beim Anmelden";
            $this->tpl_content = "anmelden.php";
			parent::Aktion();
				};
			}else {
				
				if( !isset($_GET['Start'])){
					$this->data["fehler"] = "Fehler beim Anmelden";
				}
				$this->tpl_content = "anmelden.php";
				parent::Aktion();
				
			}
		}
	}
    
	class controller_abmelden extends controller_basis
	{
		
		public function __construct ($tpl_navigation, $tpl_content, $db)
		{
			parent:: __construct ($tpl_navigation, $tpl_content, $db, "");
		}
		
		public function Aktion ()
		{
			session_destroy();
			unset ($_SESSION["benutzer"]);
			unset ($_SESSION["normal_admin"]);
			unset ($_SESSION["admin_admin"]);
			$this->tpl_content = "anmelden.php";
			parent::Aktion();
		}
        
	}
	
	
	/*
	class controller_adminBenutzer extends controller_basis
	{
		
		public function __construct ($tpl_navigation, $tpl_content, $db)
		{
			parent:: __construct ($tpl_navigation, $tpl_content, $db, "admin");
		}
		
		public function Aktion ()
		{
			
			
			if(isset($_POST['BenutzerEinbinden'])){
					
					$this->db->FuegeBenutzerEin($_POST['Vorname'],$_POST['Nachname'],$_POST['Benutzername'],$_POST['Passwort'],$_POST['Nutzerrecht']);
			
			}	
			
			
			if(isset($_GET['delete'])){
					
				$this->db->loescheBenutzer($_GET['delete']);
			}
		
			
			
			if(isset($_GET['sortierung'])){
				$sortierung = $_GET['sortierung'];
				
			}else{
				
				$sortierung = "benutzername";
			}
			if(isset($_GET['reihenfolge'])){
				$reihenfolge = $_GET['reihenfolge'];
			}else{
				
				$reihenfolge = "ASC";
			}
			
			
			$this->data['AlleBenutzer'] = $this->db->AlleBenutzerHolen($sortierung, $reihenfolge);
			
			 $this->tpl_content = "admin_Benutzer.php";
			
			
			parent::Aktion();
		}
	}
	
	
	
	
	class controller_adminBenutzerEinfuegen extends controller_basis
	{
		
		public function __construct ($tpl_navigation, $tpl_content, $db)
		{
			parent:: __construct ($tpl_navigation, $tpl_content, $db, "admin");
		}
		
		public function Aktion ()
		{
			
			
			
			
			 $this->tpl_content = "admin_BenutzerEinfuegen.php";
			
			parent::Aktion();
		}
	}
	*/
	
	class controller_adminKlassenzimmer extends controller_basis
	{
		
		public function __construct ($tpl_navigation, $tpl_content, $db)
		{
			parent:: __construct ($tpl_navigation, $tpl_content, $db, "admin");
		}
		
		public function Aktion ()
		{
			
			
			if(isset($_POST['KlassenzimmerEinbinden']))
			{
			
				$this->db->FuegeKlassenzimmerEin($_POST['Name']);
				$this->db->ordneToilettenZuKlassenzimmer($this->db->holeIDzuKlassenzimmer($_POST['Name']), $_POST['toiletten']);
				
			}
			
			if(isset($_GET['delete']))
			{
				$this->db->LoescheKlassenzimmer($_GET['delete']);
			
				
			}
			
			
			$this->data['Toiletten']=$this->db->holeToiletten();
		
			$this->data['Klassenzimmer']=$this->db->holeKlassenzimmer();
			
			
			
			 $this->tpl_content = "admin_Klassenzimmer.php";
			
			parent::Aktion();
		}
	}
	
	
	class controller_adminKlassenzimmerUmbenennen extends controller_basis
	{
		
		public function __construct ($tpl_navigation, $tpl_content, $db)
		{
			parent:: __construct ($tpl_navigation, $tpl_content, $db, "admin");
		}
		
		public function Aktion ()
		{
			
			
			if(isset($_POST['KlassenzimmerAktualisieren'])){
					
					$this->db->AktualisiereKlassenzimmer($_GET['ID'], $_POST['neuerName']);
					$this->db->ordneToilettenZuKlassenzimmer($this->db->holeIDzuKlassenzimmer($_POST['neuerName']), $_POST['toiletten']);
				
			}	
			
			$this->data['Klassenzimmer']=$this->db->holeKlassenzimmerMitID($_GET['ID']);
			$this->data['Toiletten']=$this->db->holeToiletten();
			$this->data['aktivierteToiletten'] = $this->db->holeToilettenIDZuKlassenzimmer($_GET['ID']);
			
			
			 $this->tpl_content = "admin_KlassenzimmerUmbenennen.php";
			
			parent::Aktion();
		}
	}
	
	
	
	
	class controller_adminToiletten extends controller_basis
	{
		
		public function __construct ($tpl_navigation, $tpl_content, $db)
		{
			parent:: __construct ($tpl_navigation, $tpl_content, $db, "admin");
		}
		
		public function Aktion ()
		{
			
			
			if(isset($_POST['ToiletteEinbinden']))
			{
				$this->db->FuegeToiletteEin($_POST['Name'], $_POST['Geschlecht']);
			
				
			}
			
			if(isset($_GET['delete']))
			{
				$this->db->LoescheToilette($_GET['delete']);
			
				
			}
			
			
			
		
			$this->data['Toiletten']=$this->db->holeToiletten();
			
			
			
			 $this->tpl_content = "admin_Toiletten.php";
			
			parent::Aktion();
		}
	}
	
	
	class controller_adminToiletteUmbenennen extends controller_basis
	{
		
		public function __construct ($tpl_navigation, $tpl_content, $db)
		{
			parent:: __construct ($tpl_navigation, $tpl_content, $db, "admin");
		}
		
		public function Aktion ()
		{
			
			
			if(isset($_POST['ToiletteAktualisieren'])){
					
					$this->db->AktualisiereToilette($_GET['ID'], $_POST['neuerName'], $_POST['Geschlecht']);
			
			}	
			
			$this->data['Toilette']=$this->db->holeToiletteMitID($_GET['ID']);
			
			
			
			 $this->tpl_content = "admin_ToiletteUmbenennen.php";
			
			parent::Aktion();
		}
	}
	
	
	
	
	class controller_RaeumeEinsehen extends controller_basis
	{
		
		public function __construct ($tpl_navigation, $tpl_content, $db)
		{
			parent:: __construct ($tpl_navigation, $tpl_content, $db, "");
		}
		
		public function Aktion ()
		{
			
			
			
			
			$this->data['Klassenzimmer']=$this->db->holeKlassenzimmer();
			
			$this->tpl_content = "RaeumeEinsehen.php";
			
			parent::Aktion();
		}
	}
	
	
	class controller_RaumEinsehen extends controller_basis
	{
		
		public function __construct ($tpl_navigation, $tpl_content, $db)
		{
			parent:: __construct ($tpl_navigation, $tpl_content, $db, "");
		}
		
		public function Aktion ()
		{
			
			if(isset($_GET['ToilettenID']))
			{
				
				$this->db->invertiereZustandToilette($_GET['ToilettenID'], $_GET['ID']);
				
			}
			
			
			$this->data['Klassenzimmer']=$this->db->holeKlassenzimmerMitID($_GET['ID']);
			
			$this->tpl_content = "RaumEinsehen.php";
			
			parent::Aktion();
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>
