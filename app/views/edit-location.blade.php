@extends('main')
@section('title')
	Edit Location
@endsection
@section('content')
<div class="container">
	<form id="edit-location" action="{{URL::route('update',array($location->id))}}" method="post">
		<div class="row">
			<div class="col-xs-12">
				<h1>Edit location:</h1>
				<div class="row form-group">
					<div class="col-xs-6">
		   				<input type="text" class="form-control" name="NameLocation" id="NameLocation" value="{{$location->name}}">
		   				<input type="text" hidden  name="IdLocation" value="{{$location->id}}"> 
					</div>	
				</div>
				<div class="row form-group">
			  		<div class="col-xs-6">
			  			<button type="reset" class="btn btn-default">Reset</button>
				    	<button type="submit" class="btn btn-primary" id="submit_update">Update</button>
			  		</div>
			  	</div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">	
			$("#edit-location").validate({
				rules:{
					NameLocation:{
						required:true,
						minlength:3,
						remote:{
                                url:'{{URL::route('edit-check-location',$location->id)}}',
                                type:"POST"
                            }
					}
				},
				messages:{
					NameLocation:{
						required:"Please, enter name of location!",
						minlength:"Length than 3 word!",
						remote:"Location existing!"
						}
					}
			});
		</script>
@endsection