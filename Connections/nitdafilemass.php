<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_nitdafilemass = "localhost";
$database_nitdafilemass = "nitdadb";
$username_nitdafilemass = "root";
$password_nitdafilemass = "";
$nitdafilemass = mysql_pconnect($hostname_nitdafilemass, $username_nitdafilemass, $password_nitdafilemass) or trigger_error(mysql_error(),E_USER_ERROR); 
?>