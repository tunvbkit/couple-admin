@extends('main')
@section('title')
	Add Location
@endsection
@section('content')
<div class="container">
	<form id="add-location" action="{{Asset('admin/location/add')}}" method="post">
		<div class="row">
			<div class="col-xs-12">
				<h1>Add Location</h1>
				<div class="row form-group">
					<div class="col-xs-6">
		   				<input type="text" class="form-control" name="locationname" id="locationname" placeholder="">
					</div>	
				</div>
				<div class="row form-group">
			  		<div class="col-xs-6">
			  			<button type="reset" class="btn btn-default">Reset</button>
				    	<button type="submit" class="btn btn-primary" id="submit_add">Add</button>
			  		</div>
			  	</div>
			</div>
		</div>
	</form>
</div>
	<script type="text/javascript">	
			$("#add-location").validate({
				rules:{
					locationname:{
						required:true,
						minlength:3,
						remote:{
                                url:'{{URL::route('check-location')}}',
                                type:"POST"
                            }
                  
					}
				},
				messages:{
					locationname:{
						required:"Please, enter name of location!",
						minlength:"Length than 3 word!",
						remote:"Location existing!"
						}
					}
			});
	</script>
@endsection
		