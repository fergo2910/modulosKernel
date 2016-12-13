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
            echo "ajaj";
        echo $valorRam[$j];
    }
?>