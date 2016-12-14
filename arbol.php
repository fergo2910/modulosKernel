<?php
  function Estado($s)
  {
    $estado = "N";
    switch ($s) {
        case 0:
            $estado = "R";
            break;
        case 1:
            $estado = "S";
            break;
        case 4:
            $estado = "Z";
            break;
        case 8:
            $estado = "T";
            break;
    }
    return $estado;
  }

  function ImprimeHijo($p,$id)
  {
    foreach ($p->proceso as $proceso) 
    {
      echo '<ul class="nav nav-list nav-left-ml">';   

      if (intval($id) == intval($proceso->parentpid))
      {
        echo "<li> <label class='nav-toggle nav-header'><span class='nav-toggle-icon glyphicon glyphicon-chevron-right'>[".$proceso->pid."-".Estado($proceso->state)."] ".$proceso->comm."</span></label>";
        ImprimeHijo($p,$proceso->pid);
        echo "</li>";
      }
      echo "</ul>";
    }
  }
  $procesos = simplexml_load_file('/proc/infoproc');
?>
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <style>
      .nav-list{padding-right:15px;padding-left:15px;margin-bottom:0;}
      .nav-list-main{padding-left:0px;padding-right:0px;margin-bottom:0;}
      span.nav-toggle-icon{font-size:12px !important;top:-2px !important;}
    </style>
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
              <h1>Arbol de procesos</h1>
              <div class="span6">
                <div id="container">
                  <ul class="nav nav-list-main">
                    <li> 
                      <label class="nav-toggle nav-header">
                        <span class="nav-toggle-icon glyphicon glyphicon-chevron-right">Procesos</span>
                      </label>
                      <?php ImprimeHijo($procesos,"0"); ?>
                    </li> 
                  </ul>
                  
                  <script language="JavaScript" type="text/javascript" src="calculos.js"></script>
                  <script>
                    $('ul.nav-left-ml').toggle();
                    $('label.nav-toggle span').click(function () {
                      $(this).parent().parent().children('ul.nav-left-ml').toggle(300);
                      var cs = $(this).attr("class");
                      if(cs == 'nav-toggle-icon glyphicon glyphicon-chevron-right') {
                      $(this).removeClass('glyphicon-chevron-right').addClass('glyphicon-chevron-down');
                      }
                      if(cs == 'nav-toggle-icon glyphicon glyphicon-chevron-down') {
                      $(this).removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-right');
                      }
                    });
                  </script>
                </div>
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
