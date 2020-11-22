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
$query_department = "SELECT department.dept_name FROM department ORDER BY department.dept_name asc";
$department = mysql_query($query_department, $nitdafilemass) or die(mysql_error());
$row_department = mysql_fetch_assoc($department);
$totalRows_department = mysql_num_rows($department);

mysql_select_db($database_nitdafilemass, $nitdafilemass);
$query_userlist = "SELECT * FROM staff ORDER BY staff.s_name asc";
$userlist = mysql_query($query_userlist, $nitdafilemass) or die(mysql_error());
$row_userlist = mysql_fetch_assoc($userlist);
$totalRows_userlist = mysql_num_rows($userlist);
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
         	
              <a href="home.php" class="list-group-item "><span class="glyphicon glyphicon-dashboard"> Staff </span> </a>	
              <a href="files.php" class="list-group-item"><span class="glyphicon glyphicon-book"> Department</span> <span class="badge"></span> </a>
              
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
    	<p class="box-title">staff List</p>
        <h4 class="text-success cursor" data-toggle="modal" data-target="#newuser"><span class="glyphicon glyphicon-plus"></span> NEW USER</h4>
        <!--NEW STAFF MODAL -->
		<div id="newuser" class="modal fade" role="dialog">
  			<div class="modal-dialog">
    		<!-- Modal content-->
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal">&times;</button>
        			<h4 class="modal-title">NEW USER INFORMATION</h4>
      			</div>
      			<div class="modal-body">
                     <form action="" method="POST" role="form" name="newuserform" id="newuserform">
                      <div class="form-group">
                        <label for="staffname">STAFF NAME:</label>
                        <input type="text" class="form-control" name="staffname" id="staffname" required>
                      </div>
                      <div class="form-group">
                        <label for="username">USERNAME:</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                      </div>
                      <div class="form-group">
                        <label for="password">PASSWORD:</label>
                        <input type="text" class="form-control" name="password" id="password" required>
                      </div>
                      <div class="form-group">
                        <label for="userdepartment">DEPARTMENT NAME:</label>
                        <select name="userdepartment" id="userdepartment" class="form-control" required>
                          <option value="">SELECT DEPT</option>
                          <?php
do {  
?>
                          <option value="<?php echo $row_department['dept_name']?>"><?php echo $row_department['dept_name']?></option>
                          <?php
} while ($row_department = mysql_fetch_assoc($department));
  $rows = mysql_num_rows($department);
  if($rows > 0) {
      mysql_data_seek($department, 0);
	  $row_department = mysql_fetch_assoc($department);
  }
?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="previlege">STAFF PREVILEGE:</label>
                        <select name="previlege" id="previlege" class="form-control" required> 
                          <option value="">SELECT PREVILEGE</option>
                          <option value="ADMINISTRATION">ADMINISTRATION</option>
                          <option value="DG">DG</option>
                          <option value="DIRECTOR">DIRECTOR</option>
                          <option value="STAFF">STAFF</option>
                          <option value="CLERK">CLERK</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="disgnation">DESIGNATION:</label>
                        <input type="text" class="form-control" name="designation" id="designation" required>
                      </div>
                      <button type="submit" name="submitbtn" id="submitbtn" class="btn btn-default">Submit</button>
                      <input type="hidden" name="MM_insert" value="newuserform">
                    </form>
          		</div>
          		<div class="modal-footer">
            		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          		</div>
        	</div>
      		</div>
    	</div>
        <!-- END STAFF MODAL -->
        <!-- REMOVE STAFF MODAL -->
		<div id="deleteusermodal" class="modal fade" role="dialog">
  			<div class="modal-dialog">
    		<!-- Modal content-->
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal">&times;</button>
        			<h4 class="modal-title">REMOVE INFORMATION</h4>
      			</div>
      			<div class="modal-body">
            		
                     Delete
          		</div>
          		<div class="modal-footer">
            		<button type="button" id="confirmdeleteuser" name="confirmdeleteuser" class="btn btn-default">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          		</div>
        	</div>
      		</div>
    	</div>
        <!-- END REMOVE STAFF -->
        <!-- EDIT STAFF MODAL -->
		<div id="editusermodal" class="modal fade" role="dialog">
  			<div class="modal-dialog">
    		<!-- Modal content-->
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal">&times;</button>
        			<h4 class="modal-title">UPDATE DEPARTMENT INFORMATION</h4>
      			</div>
      			<div class="modal-body">
            		
                     <form role="form" name="edituserform" id="edituserform">
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
        <!-- END EDIT STAFF modal -->
        
        <table class="table table-responsive table-hover">
              <tr>
                <th scope="col">S/No</th>
                <th scope="col">NAME</th>
                <th scope="col">USERNAME</th>
                <th scope="col">DEPARTMENT</th>
                <th scope="col">DESIGNATION</th>
                <th scope="col">PREVILEGE</th>
              </tr>
              <?php $count = 1; do{ ?>
              <tr>
                <th scope="row"><?php echo $count; ?></th>
                <td><?php echo $row_userlist['s_name']; ?></td>
                <td><?php echo $row_userlist['s_username']; ?></td>
                <td><?php echo $row_userlist['s_department']; ?></td>
                <td><?php echo $row_userlist['designation']; ?></td>
                <td><?php echo $row_userlist['s_previlege']; ?></td>
                <td> 
                	<span class="glyphicon glyphicon-trash" data-toggle="modal" data-target="#deleteusermodal" data-id=<?php echo $row_userlist['s_username']; ?> data-name="<?php echo $row_userlist['s_username']; ?>"></span>
                 </td>
              </tr>
              <?php }while($row_userlist = mysql_fetch_assoc($userlist)); ?>            
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
mysql_free_result($department);

mysql_free_result($userlist);
?>
