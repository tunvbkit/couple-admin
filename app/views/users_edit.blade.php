@extends('main')

@section('title')
Admin > User > Edit | Thuna.vn
@endsection
@section('content')
<h2>Edit User</h2>
<form action="" method="post" id="form_edit">
	<table class="table table-striped">
	<thead>
			<th>#</th>
			<th>Email</th>
			<th>Role</th>
			<th>Weddingdate</th>
			<th>Firstname</th>
			<th>Lastname</th>
			<th>Password</th>
	</thead>
	<tbody>
		@foreach($users as $user)
		<tr>
			<td class="danger">1</td>
			<td class="danger"><input class="form-control" type="email" name="email" id="email" value="{{$user->email}}">
				@if(isset($msg_check_email))
			    	<label class="error">{{$msg_check_email}}</label>
			    @endif
			</td>
			<td class="danger">
				<select name="role" class="form-control">
					<option value="2">User</option>
					<option value="1">Admin</option>
				</select>
			</td>
			<td class="danger">
				<input class="form-control" type="text" name="weddingdate" id="weddingdate" value="{{$user->weddingdate}}">
				<script type="text/javascript" src="{{Asset('assets/js/script-giang.js')}}"></script>
			</td>
			<td class="danger"><input class="form-control" type="text" name="firstname" id="firstname" value="{{$user->firstname}}"></td>
			<td class="danger"><input class="form-control" type="text" name="lastname" id="lastname" value="{{$user->lastname}}"></td>
			<input type="hidden" name="id" value="{{$user->id}}">
			<td class="danger">
				<input class="form-control" type="password" name="password" id="password" value="{{$user->password}}">
			</td>
		</tr>
		@endforeach()
	</tbody>
	</table>
<!-- <div class="row">
	<div class="col-xs-6">
		<input class="form-control" type="password" name="password_old" id="password_old" placeholder="Old Password">
	</div>
	<div class="col-xs-6">
		<input class="form-control" type="password" name="password_new" id="password_new" placeholder="New Password">
	</div>
</div> -->
<div class="row">
	<div class="col-xs-12">
		Are you ready update this user?
		<button class="btn btn-default" type="submit">OK</button>
		<a class="btn btn-default" href="{{URL::to('admin/users')}}" role="button">Cancel</a>
	</div>
</div>
</form>

<script type="text/javascript">
	$("#form_edit").validate({
		rules:{
			email:{
				email:true,
				remote:{
					url:"{{URL::route('check_email_edit',array($user->id))}}",
					type:"post"
				}
			},
			password_old:{
				required:true,
				minlength:3
			},
			password_new:{
				required:true,
				minlength:3
			}
		},
		messages:{
			email:{
				email: "Format email not true!",
				remote: "Email had!"
			},
			password_old:{
				required:"Please, enter password of user and lenght than 3 word!",
				minlength:"Length than 3 word!"
			},
			password_new:{
				required:"Please, enter password of user and lenght than 3 word!",
				minlength:"Length than 3 word!"
			}
		}
	});
</script>
@endsection