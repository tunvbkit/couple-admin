@extends('main')

@section('title')
Users
@endsection
@section('content')
<div class="row">
	<div class="col-xs-12 col-md-8 col-lg-6">
		<h1>User</h1>
	</div>
	<div class="col-xs-12 col-md-6 col-lg-4 search">
		<form action="{{URL::to('admin/users/search')}}" method="post">
			<div class="input-group">
		      <input type="text" class="form-control" name="key" placeholder="Enter user need search">
		      <span class="input-group-btn">
		        <button class="btn btn-default" type="submit">Search!</button>
		      </span>
		    </div><!-- /input-group -->
		</form>
	</div>
</div>
<div class="row">
    <div class="col-xs-12">
    	<ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i><a href="{{Asset('admin/main')}}">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-edit"></i> User
            </li>
        </ol>
    </div>
</div>
<div class="row">
	<div class="col-xs-4">
		<a href="#" class="btn btn-info" data-toggle="modal" data-target="#myModalCreatUser">Create User</a>
		<button id="del_user" class="btn btn-danger" type="submit">Delete User</button>
	</div>
	<div class="col-xs-2 text-center" style="font-weight:bold;">
		Tổng người dùng: {{$count_user}}
	</div>
	<div class="col-xs-2 text-center" style="font-weight:bold;">
		Đăng kí mới: {{$count_user_day}}
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		@if(isset($msg))
			<!-- <label class="error">{{$msg}}</label> -->
			<h3><span class="label label-success">{{$msg}}</span></h3>
		@endif
	</div>
</div>
<form action="dels" method="post" id="dels">
<table class="table table-striped">
	<thead>
		<th></th>
		<th>#</th>
		<th>Email</th>
		<th>Firstname</th>
		<th>Lastname</th>
		<th>Weddingdate</th>
		<th>Role</th>
	</thead>
	<tbody>
	@foreach($users as $index => $user)
		<tr>
			<td>
				@if ( ($user->role_id)==1 )
					<i style="color: #C9302C;" class="fa fa-user"></i>
				@else
					<input type="checkbox" value="{{$user->id}}">
					<input type="hidden" name="chk-{{$user->id}}" value="" >
				@endif
			</td>
			<td>{{$index+1}}</td>
			<td id="email-user">
				{{$user->email}}
				
				@if ( ($user->role_id)==1 )
					<p>
						{{HTML::linkRoute('users/edit', 'Edit', $user->id)}}
					</p>
				@else
					<p>
						{{HTML::linkRoute('users/edit', 'Edit', $user->id)}}
						 | 
						<a href="#" data-toggle="modal" data-target="#myModalDeleteUser{{$index}}">Delete</a>
					</p>
				@endif
			</td>
			<td>{{$user->firstname}}</td>
			<td>{{$user->lastname}}</td>
			<td>{{$user['weddingdate']}}</td>
			<td>
				@if ( $user['role_id']==1 )
					Admin
				@else
					User
				@endif
			</td>

			<!-- Modal Delete User -->
			<div class="modal fade" id="myModalDeleteUser{{$index}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h3 class="modal-title" id="myModalLabel">Delete User</h3>
			      </div>
			      <div class="modal-body">
			      	{{$user->email}}
			      </div>
			      <div class="modal-footer">
			      	<a href="{{URL::to('admin/users/delete', array('id'=>$user->id))}}">
			      		<button type="button" class="btn btn-primary">OK</button>
			      	</a>
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			      </div>
			    </div>
			  </div>
			</div>
			<!-- end modal delete user -->

		</tr>
	@endforeach()
	</tbody>
</table>
</form>
<div class="per_page">{{ $users->links() }}</div>

<!-- Modal Creat User -->

<div class="modal fade" id="myModalCreatUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="myModalLabel">Creat User</h3>
      </div>
      <div class="modal-body">
        <form id="form_addUser" action="{{Asset('admin/users')}}" method="post">
		    <div class="row form-group">
				<div class="col-xs-6">
				   	<input type="text" class="form-control" name="firstname" id="firstname" placeholder="First name">
				</div>
				<div class="col-xs-6"></div>
			</div>
			<div class="row form-group">
				<div class="col-xs-6">
				    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last name">
				</div>
				<div class="col-xs-6"></div>
			</div>
			<div class="row form-group">
				<div class="col-xs-6">
				    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
				    @if(isset($msg_check_email))
				    	<label class="error">{{$msg_check_email}}</label>
				    @endif
				</div>
				<div class="col-xs-6"></div>
			</div>
			<div class="row form-group">
				<div class="col-xs-6">
				    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
				</div>
				<div class="col-xs-6"></div>
			</div>
			<div class="row form-group">
				<div class="col-xs-6">
				    <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Confirm Password">
				</div>
				<div class="col-xs-6"></div>
			</div>
			<div class="row form-group">
		        <div class='col-sm-6'>
		            <div class='input-group date' id='datetimepicker5' data-date-format="YYYY/MM/DD">
		                <input type="text" class="form-control" name="weddingdate" id="weddingdate" placeholder="Weddingdate" />
		                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						<script type="text/javascript" src="{{Asset('assets/js/script-giang.js')}}"></script>
		            </div>
		        </div>
		    </div>
		  	<div class="row form-group">
				<div class="col-xs-6">
				    <select name="role" class="form-control">
						<option value="2">User</option>
						<option value="1">Admin</option>
					</select>
				</div>
			</div>
		  	<div class="row form-group">
		  		<div class="col-xs-6">
		  			<button type="reset" class="btn btn-default">Reset</button>
			    	<button type="submit" class="btn btn-primary" id="submit_add">OK</button>
		  		</div>
		  	</div>

		</form>
    </div> <!-- end modal body -->
</div> <!-- end modal content -->
</div> <!-- end modal dialog -->
</div> <!-- end modal fade -->
<!-- end modal creat user -->

<!-- script of validate -->
<script type="text/javascript">
	$("#form_addUser").validate({
		rules:{
			email:{
				required:true,
				email:true,
				remote:{
					url:"{{URL::route('check_email')}}",
					type:"post"
				}
			},
			password:{
				required:true,
				minlength:3
			},
			password_confirm:{
				equalTo:"#password"
			},
			role:{
				required:true
			}
		},
		messages:{
			email:{
				required: "Please, enter email of user!",
				email: "Format email not true!",
				remote: "Email had!"
			},
			password:{
				required:"Please, enter password for user!",
				minlength:"Length than 3 word!"
			},
			password_confirm:{
				equalTo:"Confirm password not true!"
			},
			role:{
				required:"Please, choosse role for user!"
			}
		}
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		var $i=0;
		$('input[type="checkbox"]').click(function(){
			if($(this).is(':checked')) {
				var id= $(this).val();
			 	$(this).next().val(id);
				$i++;
			}else{
				$(this).next().val("");
				$i--;
			}
		});
		$('#del_user').click(function(){
			if ($i<1) {
				alert('You must check user need delete!');
				return false;
			}else{
				$("#dels").submit();
			}
		});
	});
</script>

@endsection