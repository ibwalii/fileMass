<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>NITDA</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/nitda.css" rel="stylesheet" type="text/css">
</head>
<body class="homebody" onload="window.open('', '_self', '');">
<div class="top-bar nav">
	<div class="col-lg-1">
	<img src="img/ng.jpg" width="70" height="60" alt="" class="img-responsive img-rounded" />
    </div>
    <div class="col-lg-10">
  <h1 class="text-center top-title">NATIONAL INFORMATION TECHNOLOGY DEVELOPMENT AGENCY (NITDA)
  </h1>
  <h3 class="text-center top-title">File Management System (FMS)
  </h3>
  	</div>
    <div class="col-lg-1">
    <img src="img/nitda.jpg" width="60" height="65" alt="" class="img-responsive img-rounded"/> </div>
</div>
<div class="container">
<div class="row">
    <div class="col-md-4"></div>
    <div id="logindiv" class="col-md-4 login-box">
    	<p class="box-title">Login Panel</p>
        
        <p class="text-danger"><span class="glyphicon glyphicon-alert"></span> Incorrect USERNAME/PASSWORD</p>
        

        <form role="form" name="loginform" id="loginform" method="POST" action="">
        <div class="form-group">
        <label for="username" class="login-label">Username</label>
        <input class="form-control" id="username" name="username" type="text" required>
        </div>
        <div class="form-group">
        <label for="password" class="login-label">Password</label>
        <input class="form-control" id="password" name="password" type="password" required>
        </div>
        <div class="form-group">
        <input name="loginbtn" type="submit" value="Login" class="btn btn-success login-bt form-control">
        <input name="resetbtn" type="reset" value="Reset" class="btn btn-block bt login-bt">
        </div>
        </form>
    </div>
</div>
</div>
<div class="footer">
<div class="row">
<div class="col-md-4 col-md-offset-4">NITDA 2017</div>
<div class="col-md-4"><img src="img/techvalley.png" class="img-responsive pull-right" height="50" width="40" > Design by techvally (+2348039194120) </div>
</div>
</div>

</body>
</html>