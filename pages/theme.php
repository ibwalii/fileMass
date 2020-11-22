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
  <h3 class="text-center top-title">FILEMASS
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
    	<p class="box-title">Incoming files </p>
   		<div class="col-md-4 col-sm-12" id="itemslist">
        <h3>TOOLS</h3>
        	 <ul class="list-group">
             	<li class="list-group-item">Dep 1</li>
                <li class="list-group-item">Dep 2</li>
                <li class="list-group-item">Dep 2</li>
             </ul>
        </div>
        <div class="col-md-5">
       
        <div class="row">
        	<span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
        </div>
        </div>
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
<script src="../js/nitda.js"></script>
	
</body>
</html>
