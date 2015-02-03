<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login Admin</title>
	<link rel="stylesheet" type="text/css" href="{{Asset("assets/css/bootstrap.css")}}">
	<link rel="stylesheet" type="text/css" href="{{Asset("assets/css/style.css")}}">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="{{Asset("assets/js/bootstrap.js")}}"></script>
</head>
<body>
<div class="container">
<div class="row ">
	<div class="col-md-4"></div>
	<div class="col-md-4 view-login">
	<h1><a href="#" class="title"></a></h1>
		@if(isset($messages)) <p class="text-center alert alert-danger">{{$messages}}</p>
		@endif	
		<form action="{{Asset('admin/login')}}" method="post" class="form-horizontal form-login" role="form">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
		    <div class="col-sm-10">
		      <input type="email" name="inputEmail" class="form-control" id="inputEmail" placeholder="Email">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
		    <div class="col-sm-10">
		      <input type="password" name="inputPassword" class="form-control" id="inputPassword" placeholder="Password">
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <div class="checkbox">
		        <label>
		          <input type="checkbox" name="remember">Remember me
		        </label>
		      </div>
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-primary">Sign in</button>
		    </div>
		  </div>
		</form>
	</div>
	<div class="col-md-4"></div>
</div>
</div>
</body>
</html>