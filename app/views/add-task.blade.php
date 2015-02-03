@extends('main')
@section('title')
	Add-Task
@endsection
@section('content')
	<div class="container">
	<form id="add-task" action="{{Asset('admin/task/add')}}" method="post">
		<div class="row">
			<div class="col-xs-12">
				<h1>Add Task</h1>
				<div class="row form-group">
					<div class="col-xs-6">
		   				<label>Title:</label><input type="text" class="form-control" name="title" id="title" placeholder="">
					</div>	
				</div>
				<div class="row form-group">
					<div class="col-xs-6">
		   				<label>Description:</label><textarea class="form-control" name="description" id="description" ></textarea>
					</div>	
				</div>
				<div class="row form-group">
					<div class="col-xs-6">
		   				<label>Category:</label><select name="category" class="form-control">
								                    	@foreach(Category::get() as $category)
								                       		 <option value="{{$category->id}}">{{$category->name}}</option>
								                        @endforeach
						                    		</select>
					</div>	
				</div>
				<div class="row form-group">
					<div class="col-xs-6">
		   				<label>Startdate:</label><input type="text" class="form-control" name="startdate" id="startdate" placeholder="">
					</div>	
				</div>
				<div class="row form-group">
					<div class="col-xs-6">
		   				<label>Link:</label><input type="text" class="form-control" name="link" id="link" placeholder="">
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
			$("#add-task").validate({
				rules:{
					title:{
						required:true,
						minlength:3,
						remote:{
                                url:'{{URL::route('checkTitle')}}',
                                type:"POST"
                            }
                  		},
                  	description:{
						required:true,
						minlength:3
						
                  		},
                  	category:{
						required:true,
						minlength:1,
						
                  		},
                  	startdate:{
						required:true,
						minlength:1,
						number:true
                  		},
                  	
				},
				messages:{
					title:{
						required:"Please, enter name of title!",
						minlength:"Length than 3 word!",
						remote:"Title existing!"
						},
					
					description:{
						required:"Please, enter description!",
						minlength:"Length than 3 word!",
						},
					category:{
						required:"Please, enter number category!",
						minlength:"Length than 1 word!",
						},
					startdate:{
						required:"Please, enter startdate!",
						minlength:"Length than 1 word!",
						number:"Must enter number!",
						}
					
					}
					
			});
	</script>
@endsection