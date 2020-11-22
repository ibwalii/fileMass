<?php require_once('../Connections/nitdafilemass.php'); ?>
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

mysql_select_db($database_nitdafilemass, $nitdafilemass);
$query_alldepartment = "SELECT department.*, count(unit.dept) FROM department, unit WHERE department.dept_name = unit.dept GROUP BY department.d_id";
$alldepartment = mysql_query($query_alldepartment, $nitdafilemass) or die(mysql_error());
$row_alldepartment = mysql_fetch_assoc($alldepartment);
$totalRows_alldepartment = mysql_num_rows($alldepartment);

mysql_select_db($database_nitdafilemass, $nitdafilemass);
$query_units = "SELECT unit.unit_name FROM unit WHERE unit.dept = 'a'";
$units = mysql_query($query_units, $nitdafilemass) or die(mysql_error());
$row_units = mysql_fetch_assoc($units);
$totalRows_units = mysql_num_rows($units);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>NITDA</title>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="../css/nitda.css" rel="stylesheet" type="text/css">
</head>
<body onload="window.open('', '_self', '');">
<div class="top-bar nav">
	<div class="col-lg-1">
	<img src="../img/ng.jpg" width="70" height="60" alt="" class="img-responsive img-rounded" />
    </div>
    <div class="col-lg-10">
  <h1 class="text-center top-title">NATIONAL INFORMATION TECHNOLOGY DEVELOPMENT AGENCY (NITDA)
  </h1>
  <h3 class="text-center top-title">File Management System (FMS)
  </h3>
  	</div>
    <div class="col-lg-1">
  	<img src="../img/nitda.jpg" width="60" height="65" alt="" class="img-responsive img-rounded"/>
    </div>
</div>
<div class="content">
<div class="row">
    <div class="col-md-3">
		 <div class="list-group">
         	
              <a href="admindep.php" class="list-group-item "><span class="glyphicon glyphicon-user"> Department </span> </a>	
              <a href="adminstaff.php" class="list-group-item"><span class="glyphicon glyphicon-book"> Staff</span> <span class="badge"></span> </a>
              
              <a href="#" class="list-group-item">
              	<form class="form-wrapper cf" method="post" name="searchform" id="searchform">
  				<input type="text" name="q" id="q" placeholder="Search file here...">
	  			<button type="submit" name="searchbtn" id="searchbtn"><span class="glyphicon glyphicon-search"></span></button>
				</form>
              </a>
		</div>
        <div class="jumbotron text-center">
        	<p class="box-title"></p>
            <a href="request/logout.php"><h5 class="glyphicon glyphicon-log-out btn btn-link"> <strong>LOGOUT</strong></h5></a>
        </div>    
    </div>
    <div class="col-md-9" style="border-left:thin solid #B4B2B2;">
    	<p class="box-title">Departments</p>
        <h4 class="text-success cursor" data-toggle="modal" data-target="#newdepartment"><span class="glyphicon glyphicon-plus"></span> NEW DEPARTMENT</h4>
        <!--new Department Modal -->
		<div id="newdepartment" class="modal fade" role="dialog">
  			<div class="modal-dialog">
    		<!-- Modal content-->
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal">&times;</button>
        			<h4 class="modal-title">NEW DEPARTMENT INFORMATION</h4>
      			</div>
      			<div class="modal-body">
            		
                     <form method="POST" role="form" name="newdepartmentform" id="newdepartmentform">
                      <div class="form-group">
                        <label for="deptname">Department Name:</label>
                        <input type="text" class="form-control" name="deptname" id="deptname" required>
                      </div>
                      <div class="form-group">
                        <label for="deptunits">Department Units:</label>
                        <input id="units" name="units" class="form-control" placeholder="Enter e.g unit1, unit2" value="[Unit1, Unit2]">
                      </div>
                      <button type="submit" name="submitbtn" id="submitbtn" class="btn btn-default">Submit</button>
                      <input type="hidden" name="MM_insert" value="newdepartmentform">
                    </form>
          		</div>
          		<div class="modal-footer">
            		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          		</div>
        	</div>
      		</div>
    	</div>
        <!-- End department modal -->
        <!-- Delete Department Modal -->
		<div id="deletedepartmentmodal" class="modal fade" role="dialog">
  			<div class="modal-dialog">
    		<!-- Modal content-->
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal">&times;</button>
        			<h4 class="modal-title">Delete department</h4>
      			</div>
      			<div class="modal-body">
            		
          		</div>
          		<div class="modal-footer">
           		  <button type="button" id="confirmdeletedpt" name="confirmdeletedpt" class="btn btn-default">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          		</div>
        	</div>
      		</div>
    	</div>
        <!-- End department modal -->
        <!-- Edit Department Modal -->
	  <div id="editdepartmentmodal" class="modal fade" role="dialog">
  			<div class="modal-dialog">
    		<!-- Modal content-->
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal">&times;</button>
        			<h4 class="modal-title">UPDATE DEPARTMENT INFORMATION</h4>
      			</div>
      			<div class="modal-body">
            		
                     <form role="form" name="editdepartmentform" id="editdepartmentform">
                      <div class="form-group">
                        <label for="deptname">Department Name:</label>
                        <input type="text" class="form-control" name="deptname" id="deptname">
                      </div>
                      <div class="form-group">
                        <label for="deptunits">Department Units:</label>
                        <input id="units" class="units" name="units" class="form-control" placeholder="Enter e.g unit1, unit2" value="[Unit1, Unit2]">
                      </div>
                      <button type="submit" name="submitbtn" id="submitbtn" class="btn btn-default">Submit</button>
                    </form>
          		</div>
          		<div class="modal-footer">
            		<button type="button" id="confirmeditdpt" name="confirmeditdpt" class="btn btn-default">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          		</div>
        	</div>
      		</div>
    	</div>
        <!-- End Edit department modal -->
        
        <table class="table table-responsive table-hover">
              <tr>
                <th scope="col">Department No</th>
                <th scope="col">Department Name</th>
                <th scope="col">Units</th>
                <th scope="col">&nbsp;</th>
              </tr>
              <?php 
			  $count = 1;
			  do{ 
			  	$dept = $row_alldepartment['dept_name'];
			    mysql_select_db($database_nitdafilemass, $nitdafilemass);
				$query_units = "SELECT unit.unit_name FROM unit WHERE unit.dept = '{$dept}'";
				$units = mysql_query($query_units, $nitdafilemass) or die(mysql_error());
				$row_units = mysql_fetch_assoc($units);
				$totalRows_units = mysql_num_rows($units);
			  ?>
              <tr>
                <th scope="row"><?php echo $row_alldepartment['d_id']; ?></th>
                <td><?php echo $row_alldepartment['dept_name']; ?></td>
                <td><?php do{ echo ($row_units['unit_name'].", "); }while($row_units = mysql_fetch_assoc($units)); ?></td>
                <td>
                	<span class="glyphicon glyphicon-trash" data-toggle="modal" data-target="#deletedepartmentmodal" data-did=<?php echo $row_alldepartment['d_id']; ?> data-dptname="<?php echo $row_alldepartment['dept_name']; ?>"></span>
                </td>
              </tr>
              <?php }while($row_alldepartment = mysql_fetch_assoc($alldepartment)); ?>
			</table>
 
    </div>
</div>
</div>
<div class="footer">
<div class="row">
<div class="col-md-4 col-md-offset-4">NITDA 2017</div>
<div class="col-md-4"><img src="../img/techvalley.png" class="img-responsive pull-right" height="50" width="40" > Design by techvally (+2348039194120) </div>
</div>
</div>

<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="../js/multiple-emails.js"></script>
<script src="../js/nitda.js"></script>
	
</body>
</html>
<?php
mysql_free_result($alldepartment);

mysql_free_result($units);
?>
