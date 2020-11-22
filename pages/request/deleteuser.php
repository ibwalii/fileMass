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
  $deleteSQL = sprintf("DELETE FROM staff WHERE s_username=%s",
                       GetSQLValueString($_POST['deleteid'], "text"));

  mysql_select_db($database_nitdafilemass, $nitdafilemass);
  $Result1 = mysql_query($deleteSQL, $nitdafilemass) or die(mysql_error());
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
if($Result1){
	echo "<h3>USER PROFILE REMOVED</h3> ";
	}
else{
	echo "<h3>FAILED TO REMOVE USER</h3>";
	}	
?>
</body>
</html>