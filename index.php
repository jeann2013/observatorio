<?php
	include ("db.php"); 
	$conn = phpmkr_db_connect(HOST, USER, PASS, DB, PORT);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Observatorio</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
</head>
 <body>

    <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Observatorio</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
               
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Datos <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="valores_view.php">Valores</a></li>
                    <!-- <li><a href="#">Entidades</a></li> -->
                    <li><a href="indicadores_view.php">Indicadores</a></li>
                    <!-- <li role="separator" class="divider"></li>
                    <li class="dropdown-header">test1</li>
                    <li><a href="#">test2</a></li>
                    <li><a href="#">test3</a></li> -->
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js" ></script>
  </body>
</html>