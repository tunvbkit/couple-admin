@extends('main')
@section('title')
	Edit Location
@endsection
@section('content')
<div class="container">
	<form id="edit-task" action="{{URL::route('task/update',array($task->id))}}" method="post">
		<div class="row">
			<div class="col-xs-12">
				<h1>Edit location:</h1>
				<div class="row form-group">

					<div class="col-xs-6">
		   				<label>Title:</label><input type="text" class="form-control" name="title" id="title" value="{{$task->title}}">
		   				<input type="text" hidden  name="idTitle" value="{{$task->id}}"> 
					</div>	
				</div>
				<div class="row form-group">
					<div class="col-xs-6">
		   				<label>Description:</label><textarea class="form-control" name="description" id="description" >{{$task->description}}</textarea>
		   				
					</div>	
				</div>
				<div class="row form-group">
					<div class="col-xs-6">
		   				<label>Category:</label><select name="category" class="form-control">
										                    @foreach(Category::get() as $category)
										                        <option value="{{$category->id}}" 
										                            @if($category->id==$task->category) {{"selected"}}
										                            @endif
										                        >{{$category->name}}</option>
								                        	@endforeach
                    								</select>
					</div>	
				</div>
				<div class="row form-group">
					<div class="col-xs-6">
		   				<label>Startdate:</label><input type="text" class="form-control" name="startdate" id="startdate" value="{{$task->startdate}}">
					</div>	
				</div>
				<div class="row form-group">
					<div class="col-xs-6">
		   				<label>Link:</label><input type="text" class="form-control" name="link" id="link" value="{{$task->link}}">
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
			$("#edit-task").validate({
				rules:{
					title:{
						required:true,
						minlength:3,
						remote:{
                                url:'{{URL::route('edit-check-task',array($task->id))}}',
                                type:"POST"
                            }
                  		},
                  	description:{
						required:true,
						minlength:3
						
                  		},
                  	
                  	startdate:{
						required:true,
						minlength:1,
						number:true
                  		},
                  	link:{
						
						minlength:3,
						
                  		}
				},
				messages:{
					title:{
						required:"Please, enter name of title!",
						minlength:"Length than 3 word!",
						remote:"Title is exist!"
						},
					
					description:{
						required:"Please, enter description!",
						minlength:"Length than 3 word!",
						},
					
					startdate:{
						required:"Please, enter startdate!",
						minlength:"Length than 1 word!",
						number:"Must enter number!",
						},
					link:{
						
						minlength:"Length than 3 word!",
						},	

					}
					
			});
	</script>
@endsection