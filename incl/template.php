<?php header("Content-Type: text/html; charset=utf-8"); ?>
<html>
<head>

<title>Toilettensystem Karl-Ritter-von-Frisch Gymnasium</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Michael Heinelt">
	
	<?php //<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >?>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
 
 <link rel="icon" type="image/png" href="bootstrap/favicon.png">
<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css" >



<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
 <!-- Latest compiled and minified JavaScript -->


      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container-fluid">
	<div class="row mb-3">
	  <div class="col-12 "><h1 class="text-center">Toilettensystem Karl-Ritter-von-Frisch-Gymnasium</h1></div>
	  
	</div>

	<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
	<div class="row">
	  <div class="col-md-2 "><?php include("incl/".$tpl_navigation);?></div>
	  <div class=" col-md-10"><?php include("incl/".$tpl_content);?></div>

	</div>
</div>

<?php
	//Logfile ("Template: content=" . $tpl_content);
?>

</body>
</html>
