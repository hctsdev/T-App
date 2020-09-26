<?PHP

	require_once ("incl/modellklassen.php");
	include ("incl/controllerklassen.php");

			

	//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			error_reporting(-1);
ini_set ('display_errors', 'On');
	session_start ();
	
	$db = new DBAnbindung ();
	
	$aktion = "RaeumeEinsehen";
	if (isset ($_GET["aktion"])) {
		$aktion = $_GET["aktion"];
	};
	Logfile("Aktion: ". $aktion);

	$class = "controller_" . $aktion;
	try {
        if (!class_exists($class)) {
            $controller = new controller_falscheseite ("navi.php", "fehler.php", $db, $class);
        }
        else
        {
            $controller = new $class ("navi.php", "fehler.php", $db);
        };
	} catch (DarfNichtException $darfnicht) {
		$controller = new controller_falscheseite ("navi.php", "fehler.php", $db, "verbotene Seite");
	};
		
	$controller->Aktion();
?>
