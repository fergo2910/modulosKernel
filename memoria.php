<!DOCTYPE html>
<html class="no-js"> <!--<![endif]-->
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script>
      $(function () {
        Highcharts.chart('grafica', {
            chart: {
                type: 'areaspline'
            },
            title: {
                text: 'Utilizacion de memoria RAM'
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                x: 10,
                y: 0,
                floating: true,
                borderWidth: 1,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            xAxis: {
                categories: [],
                plotBands: [{ // visualize the weekend
                    from: 0,
                    to: 0,
                    color: 'rgba(68, 170, 213, .2)'
                }]
            },
            yAxis: {
                title: {
                    text: '% UTILIZACION KB'
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
                name: 'RAM',
                data: [
                        <?php

                          $archivo = "/var/www/html/grafica.txt";
                          $ram = simplexml_load_file('/proc/infomem');
                          $dato = $ram->memoria->totalram - $ram->memoria->freeram;
                          $actual = file_get_contents($archivo);
                          file_put_contents($archivo, $dato."\n".$actual);
                          $contador = 0;
                          $fp = fopen($archivo, "r");
                          while(!feof($fp) && $contador < 20) {
                              $linea = fgets($fp);
                              $valorRam[$contador] = $linea;
                              $contador++;
                          }
                          fclose($fp);
                          for ($i = $contador; $i < 20; $i++) {
                              $valorRam[$i] = "0";
                          }
                          for ($j = 19; $j >= 0; $j--) {
                              if($j != 19)
                              {
                                  echo ",";
                              }
                              if($valorRam[$j] == '')
                                echo "0";
                              echo $valorRam[$j];
                          }
                        ?>
                      ]
            }]
        });
    });
    </script>
    <script>
      $(function () {
          $.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=usdeur.json&callback=?', function (data) {

              Highcharts.chart('graficaa', {
                  chart: {
                      zoomType: 'x'
                  },
                  title: {
                      text: 'Utilizacion de memoria RAM'
                  },
                  subtitle: {
                      text: document.ontouchstart === undefined ?
                              'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
                  },
                  xAxis: {
                      type: 'datetime'
                  },
                  yAxis: {
                      title: {
                          text: '% UTILIZACION KB'
                      }
                  },
                  legend: {
                      enabled: false
                  },
                  plotOptions: {
                      area: {
                          fillColor: {
                              linearGradient: {
                                  x1: 0,
                                  y1: 0,
                                  x2: 0,
                                  y2: 1
                              },
                              stops: [
                                  [0, Highcharts.getOptions().colors[0]],
                                  [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                              ]
                          },
                          marker: {
                              radius: 2
                          },
                          lineWidth: 1,
                          states: {
                              hover: {
                                  lineWidth: 1
                              }
                          },
                          threshold: null
                      }
                  },

                  series: [{
                      type: '%',
                      name: 'RAM',
                      data: [
                              <?php

                                $archivo = "/var/www/html/grafica.txt";
                                $ram = simplexml_load_file('/proc/infomem');
                                $dato = $ram->memoria->totalram - $ram->memoria->freeram;
                                $actual = file_get_contents($archivo);
                                file_put_contents($archivo, $dato."\n".$actual);
                                $contador = 0;
                                $fp = fopen($archivo, "r");
                                while(!feof($fp)) {
                                    $linea = fgets($fp);
                                    $valorRam[$contador] = $linea;
                                    $contador++;
                                }
                                fclose($fp);
                                $inicio = $contador;
                                for ($j = $contador; $j >= 0; $j--) {
                                    if($j != $inicio)
                                    {
                                        echo ",";
                                    }
                                    if($valorRam[$j] == '')
                                      echo "0";
                                    echo $valorRam[$j];
                                }
                              ?>
                            ]
                  }]
              });
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
            </div>
              <div class="ruler"></div>
              <div class="featured-blocks">
                <div class="row-fluid">
                  <div class="span2">
                    <div class="media">
                      <i class="fw-icon-refresh icon"></i>
                      <div class="media-body">
                        <h1 class="media-heading">Memoria RAM</h1>
                      </div>
                      <?php
                          $ram = simplexml_load_file('/proc/infomem');
                        ?>
                        <hr>
                        <div id="container">
                          <table class="table">
                            <tr>
                              <th>Target</th><th>Memoria (Kb)</th>
                            </tr>
                            <tr style="color: #f76e5d">
                              <td>Usado</td><td><?php echo $ram->memoria->totalram - $ram->memoria->freeram; ?></td>
                            </tr>
                            <tr style="color: #f76e5d">
                              <td>Libre</td><td><?php echo $ram->memoria->freeram; ?></td>
                            </tr>
                          </table>
                        </div>
                    </div>
                  </div>
                  <div class="span3">
                    <div class="media">
                      <i class="fw-icon-headphones icon"></i>
                      <div class="media-body">
                        <h1 class="media-heading">Memoria SWAP</h1>
                      </div>
                      <?php
                          $ram = simplexml_load_file('/proc/infomem');
                        ?>
                        <hr>
                        <div id="container">
                          <table class="table">
                            <tr>
                              <th>Target</th><th>Memoria (Kb)</th>
                            </tr>
                            <tr style="color: #f76e5d">
                              <td>Usado</td><td><?php echo $ram->memoria->totalswap ; ?></td>
                            </tr>
                            <tr style="color: #f76e5d">
                              <td>Libre</td><td><?php echo $ram->memoria->freeswap; ?></td>
                            </tr>
                          </table>
                        </div>
                    </div>
                  </div>
                  <div class="span2">
                    <div class="media">
                      <i class="fw-icon-headphones icon"></i>
                      <div class="media-body">
                        <h1 class="media-heading">CPU</h1>
                      </div>
                      <?php
                          $cpu = simplexml_load_file('/proc/infocpu');
                        ?>
                        <hr>
                        <div id="container">
                          <table class="table">
                            <tr>
                              <th>Target</th><th>Tiempo</th>
                            </tr>
                            
                            <tr style="color: #f76e5d">
                              <td>user</td><td><?php echo $cpu->cpu->user; ?></td>
                            </tr>
                            
                            <tr style="color: #f76e5d">
                              <td>iowait</td><td><?php echo $cpu->cpu->iowait; ?></td>
                            </tr>

                            <tr style="color: #f76e5d">
                              <td>system</td><td><?php echo $cpu->cpu->system; ?></td>
                            </tr>

                            <tr style="color: #f76e5d">
                              <td>nice</td><td><?php echo $cpu->cpu->nice; ?></td>
                            </tr>

                            <tr style="color: #f76e5d">
                              <td>idle</td><td><?php echo $cpu->cpu->idle; ?></td>
                            </tr>
                          </table>
                        </div>
                    </div>
                  </div>
                  <div class="span5">
                    <div class="media">
                      <i class="fw-icon-headphones icon"></i>
                      <div class="media-body">
                        <h1 class="media-heading">grafica</h1>
                      </div>
                        <hr>
                        <div id="grafica" style="min-width: 310px; height: 200px; margin: 0 auto"></div>
                    </div>
                  </div>
              </div>
            </div>
            <div class="ruler"></div>
                        
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
