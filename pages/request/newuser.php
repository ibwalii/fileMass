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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "newuserform")) {
  $insertSQL = sprintf("INSERT INTO staff (s_name, s_username, s_password, s_department, s_previlege, designation) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['staffname'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['userdepartment'], "text"),
                       GetSQLValueString($_POST['previlege'], "text"),
                       GetSQLValueString($_POST['designation'], "text"));

  mysql_select_db($database_nitdafilemass, $nitdafilemass);
  $Result1 = mysql_query($insertSQL, $nitdafilemass) or die(mysql_error());
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php if($Result1){ 
echo "<h3>Staff Profile Created</h3>";
}else{
echo "<h3>Failed to Add User</h3>";	
	}
?>
</body>
</html>