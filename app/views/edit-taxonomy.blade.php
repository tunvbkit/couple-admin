@extends('main')
@section('title')
	Taxonomy-{{$taxonomy->name}}
@endsection
@section('content')

	<div class="row">
		<div class="col-xs-10 col-md-offset-1">
			<div class="row">
				<div class="col-xs-6 ">
					<h1>Taxonomy Edit</h1>
				</div>
				
			</div>
			<div class="row">
				<div>
					@if(!empty($taxonomy))
					<form action="{{URL::route('update_taxonomy',array($taxonomy->id))}}" method="post" id="from-edit-category">
						<div class="form-group">
							<label>Tên</label>
							<input type="text" class="form-control" id="NameCategory" name="NameCategory" value="{{$taxonomy->name}}">
							@foreach ($errors->get('NameCategory') as $message)
								<p class="text-left alert alert-danger">{{$message}}</p>
							@endforeach
						</div>
	                    <div class="form-group">
			                <label>Mô tả</label>
			                <textarea name="editor4" class="ckeditor form-control" cols="80" id="editor4" rows="10" tabindex="1">{{$taxonomy->description}}</textarea>
			                 @foreach ($errors->get('editor4') as $message)
			                    <p class="text-left alert alert-danger">{{$message}}</p>
			                 @endforeach
		                </div>
					    <input type="text" hidden  name="IdCategory" value="{{$taxonomy->id}}"> 
					  
					  	<button type="submit" class="btn btn-primary">Lưu</button>
					  	<a href="{{URL::route('taxonomy')}}"> Huỷ</a>
					</form>
					<script type="text/javascript">
		                $('#from-edit-category').validate({
		                rules:{
		                    NameCategory:{
		                    required:true,
		                    minlength:3,
		                    },
		                    editor4:{
		                    	required:true,
		                    	minlength:15,
		                    }
		                },
		                messages:{
		                    NameCategory:{
		                        required:"Chưa điền thông tin",
		                        minlength: "Yêu cầu nhập trên 3 kí tự",
		                        remote:"Tên Vendor đã tồn tại"
		                    },
		                    editor4:{
		                    	required:"Bạn chưa nhập mô tả",
		                    	minlength:'Mô tả phải trên 15 kí tự ',
		                    }
		                }
		            })
		        </script>
					@endif
				</div>
			</div>
			
		</div>

	</div>
@endsection