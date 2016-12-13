<html>
    <head>
        <<script src="js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript">
            $("#btnMostrar").click(function(){
                <?php echo 'hola';?>
        });
    </script>
    <title>Ejemplo</title>
    </head>
    <body>
         <input type="button" value="Ejecutar Funcion" id="btnMostrar" />
         <?php
            
            function subirMem(){
                echo "hola";
               exec("cd /var/www/html/Modulos/memoria");
               exec("make");
               exec("sudo insmod modulomem.ko < /var/www/html/psw'");
               exec("cd /var/www/html/Modulos/cpu");
               exec("make");
               exec("sudo insmod modulocpu.ko < /var/www/html/psw");
            }
        ?>
    </body>
</html>