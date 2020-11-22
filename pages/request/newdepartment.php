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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "newdepartmentform")) {
  $insertSQL = sprintf("INSERT INTO department (dept_name) VALUES (%s)",
                       GetSQLValueString($_POST['deptname'], "text"));

  mysql_select_db($database_nitdafilemass, $nitdafilemass);
  $Result1 = mysql_query($insertSQL, $nitdafilemass) or die(mysql_error());
  if($_POST['units']==='[Unit1, Unit2]'){// Default Value for input in admindept.php
	  	$insertSQL = sprintf("INSERT INTO unit (unit_name, dept) VALUES (%s, %s)",
                       GetSQLValueString($_POST['deptname'], "text"),
                       GetSQLValueString($_POST['deptname'], "text"));

		mysql_select_db($database_nitdafilemass, $nitdafilemass);
  		$Result1 = mysql_query($insertSQL, $nitdafilemass) or die(mysql_error());
	  }
  else{
  $units = json_decode($_POST['units']);// DECODE UNITS TO A VARIABLE
	
	foreach($units as $key => $value){
		$insertSQL = sprintf("INSERT INTO unit (unit_name, dept) VALUES (%s, %s)",
                       GetSQLValueString($value, "text"),
                       GetSQLValueString($_POST['deptname'], "text"));

		mysql_select_db($database_nitdafilemass, $nitdafilemass);
  		$Result1 = mysql_query($insertSQL, $nitdafilemass) or die(mysql_error());
	}
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
<?php if($Result1){
	echo "<h3>New Department {$_POST['deptname']} Added. </h3>";
	} ?>
</body>
</html>