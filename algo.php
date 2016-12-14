<html>
    <head>
    <title>Ejemplo</title>
    </head>
    <body>
       <form action="" method="post">
         <input type="submit" value="boton" name="hola" />
      </form>
    </body>
</html>
<?php
 
if(isset($_POST['hola'])){
   echo "hola";
}

?>