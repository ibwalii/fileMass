<?php require_once('../../Connections/nitdafilemass.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if ((isset($_POST['deleteid'])) && ($_POST['deleteid'] != "")) {
	
  $deleteSQL = sprintf("DELETE FROM unit WHERE dept=%s",
                       GetSQLValueString($_POST['deleteid'], "text"));

  mysql_select_db($database_nitdafilemass, $nitdafilemass);
  $Result1 = mysql_query($deleteSQL, $nitdafilemass) or die(mysql_error());	
  
  $deleteSQL = sprintf("DELETE FROM department WHERE dept_name=%s",
                       GetSQLValueString($_POST['deleteid'], "text"));

  mysql_select_db($database_nitdafilemass, $nitdafilemass);
  $Result1 = mysql_query($deleteSQL, $nitdafilemass) or die(mysql_error());
   if($Result1){
			  $message = "<h3>Department and Related unit deleted</h3>";
			  }
		  else{
			  $message = "Failed to Delete";
			  }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php 
echo $message;
?>

</body>
</html>