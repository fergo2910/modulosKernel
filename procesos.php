<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-responsive.css">
    <link rel="stylesheet" href="css/custom-styles.css">
    <link rel="stylesheet" href="css/component.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/font-awesome-ie7.css">

    <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
    <body>
      <!--[if lt IE 7]>
          <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
      <![endif]-->

      <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->
      <div class="wrap-bg">
        <div class="site-header">
          <div class="logo">
            <h1>Sistemas Operativos 2</h1>
          </div>
        </div>
      </div>
      <div class="menu">
        <div class="navbar">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <i class="fw-icon-th-list"></i>
          </a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="memoria.php">Memoria</a></li>
              <li class="active border-left"><a href="procesos.php">Procesos</a></li>
              <li><a href="arbol.php">Arbol de procesos</a></li>
              <li><a href="modulos.php">Modulos de kernel</a></li>
            </ul>
            </div><!--/.nav-collapse -->
          </div>
          <div class="mini-menu">
            <label>
              <select class="selectnav">
              <option value="#" selected="">Memoria</option>
              <option value="#">Procesos</option>
              <option value="#">Arbol de procesos</option>
              <option value="#">Modulos de kerne</option>
              </select>
            </label>
          </div>
        </div>
        <div class="container bg-light-gray">
          <div class="main-content">
            <div class="featured-heading">
              <h1>Procesos en ejecución</h1>
              <div class="span3"> </div>
              <div class="span6">
                <table class="table">
                  <thead>
                    <tr>
                      <th>PID</th>
                      <th>Usuario</th>
                      <th>ESTADO</th>
                      <th>% CPU</th>
                      <th>% RAM</th>
                      <th>Nombre del proceso</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    exec("top -b -n 1 | sed -n '8, 80{s/^ *//;s/ *$//;s/  */,/gp;};80q' > /var/www/html/proc.txt");
                    $fp = fopen("/var/www/html/proc.txt", "r");
                    while(!feof($fp)) {
                      $linea = fgets($fp);
                      $lsplit = explode(",", $linea);
                      echo '<tr class="danger">';
                      echo '<th>'.$lsplit[0].'</th>'.'<th>'.$lsplit[1].'</th>'.'<th>'.$lsplit[7].'</th>'.'<th>'.$lsplit[8].'</th>'.'<th>'.$lsplit[9].'</th>'.'<th>'.$lsplit[11].'</th>';
                      echo '</tr>';
                    }
                    fclose($fp);
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="site-footer">
          <div class="container">
            <div class="row-fluid">
              <div class="span8 offset2">
                <div class="copy-rights">
                  Copyright (c) websitename. All rights reserved. 
                </div>
              </div>
            </div>
          </div>
        </div>                  
        <!-- /container -->
      <script src="js/jquery-1.9.1.js"></script> 
    <script src="js/bootstrap.js"></script>
  </body>
</html>
