<?php
$db_host="localhost";
$db_user="root";
$db_password="";
$db_name="registrocontacto";
$db_table_name="usuarios";
   $db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (!$db_connection) {
	die('No se ha podido conectar a la base de datos');
}

$subs_name = utf8_decode($_POST['nombre']);
$subs_last = utf8_decode($_POST['apellido']);
$subs_email = utf8_decode($_POST['email']);
$subs_celular = utf8_decode($_POST['celular']);
$subs_fecha = utf8_decode($_POST['fecha']);
$subs_personas = utf8_decode($_POST['cantidad']);



$resultado=mysqli_query($db_connection,"SELECT * FROM ".$db_table_name." WHERE Email = '".$subs_email."'");

if (mysqli_num_rows($resultado)>0)
{

   mysqli_free_result($resultado);
   header('Location: Fail.html');

} else {
	
	$insert_value = 'INSERT INTO `' . $db_name . '`.`'.$db_table_name.'` (`Nombre` , `Apellido` , `Email`, `Celular`, `Fecha`, `Cantidad`) VALUES ("' . $subs_name . '", "' . $subs_last . '", "' . $subs_email . '", "' . $subs_celular . '" , "' . $subs_fecha . '", "' . $subs_personas . '")';

   mysqli_select_db($db_connection, $db_name);
   $retry_value = mysqli_query($db_connection, $insert_value);

   if (!$retry_value) {
      die('Error: ' . mysqli_error());
   }
	
   mysqli_free_result($resultado);

   header('Location: Success.html');

}

mysqli_close($db_connection);

		
?>