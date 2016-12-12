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

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script>
      $(function () {
        Highcharts.chart('grafica', {
            chart: {
                type: 'areaspline'
            },
            title: {
                text: 'Average fruit consumption during one week'
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                x: 150,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            xAxis: {
                categories: [
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                    'Saturday',
                    'Sunday'
                ],
                plotBands: [{ // visualize the weekend
                    from: 4.5,
                    to: 6.5,
                    color: 'rgba(68, 170, 213, .2)'
                }]
            },
            yAxis: {
                title: {
                    text: 'Fruit units'
                }
            },
            tooltip: {
                shared: true,
                valueSuffix: ' units'
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                areaspline: {
                    fillOpacity: 0.5
                }
            },
            series: [{
                name: 'John',
                data: [3, 4, 3, 5, 4, 1, 12]
            }, {
                name: 'Jane',
                data: [1, 3, 4, 3, 3, 5, 4]
            }]
        });
    });
    </script>
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
              <li class="active border-left"><a href="memoria.php">Memoria</a></li>
              <li><a href="procesos.php">Procesos</a></li>
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
              <h1>Memoria del servidor</h1>
              <h2>asdf</h2>
            </div>
              <div class="ruler"></div>
              <div class="featured-blocks">
                <div class="row-fluid">
                  <div class="span6">
                    <div class="media">
                      <i class="fw-icon-refresh icon"></i>
                      <div class="media-body">
                        <h1 class="media-heading">Memoria RAM</h1>
                        <?php
                          $ram = simplexml_load_file('/proc/infomem');
                        ?>
                        <hr>
                        <div id="container">
                          <table class="table">
                            <tr>
                              <th>Target</th><th>Memoria (Kb)</th>
                            </tr>
                            <tr style="color: #0DA068">
                              <td>Usado</td><td><?php echo $ram->memoria->totalram - $ram->memoria->freeram; ?></td>
                            </tr>
                            <tr style="color: #194E9C">
                              <td>Libre</td><td><?php echo $ram->memoria->freeram; ?></td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="span6">
                    <div class="media">
                      <i class="fw-icon-headphones icon"></i>
                      <div class="media-body">
                        <h1 class="media-heading">Memoria SWAP</h1>
                        
                        <?php
                          $ram = simplexml_load_file('/proc/infomem');
                        ?>
                        <hr>
                        <div id="container">
                          <table class="table">
                            <tr>
                              <th>Target</th><th>Memoria (Kb)</th>
                            </tr>
                            <tr style="color: #0DA068">
                              <td>Usado</td><td><?php echo $ram->memoria->totalswap ; ?></td>
                            </tr>
                            <tr style="color: #194E9C">
                              <td>Libre</td><td><?php echo $ram->memoria->freeswap; ?></td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            <div class="ruler"></div>
            <div id="grafica" style="min-width: 310px; height: 400px; margin: 0 auto"></div>            
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
