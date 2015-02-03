@extends('main')
@section('title')
	Category-{{$category->name}}-Thuna.vn
@endsection
@section('content')

	<div class="row">
		<div class="col-xs-10 col-md-offset-1">
			<div class="row">
				<div class="col-xs-6 ">
					<h1>Category Edit</h1>
				</div>
				
			</div>
			<div class="row">
				<div>
					@if(!empty($category))
					<form action="{{ Asset('admin/UpdateCategory')}}" method="post" id="from-edit-category">
						<div class="form-group">
							<label>Tên</label>
							<input type="text" class="form-control" id="NameCategory" name="NameCategory" value="{{$category->name}}">
							@foreach ($errors->get('NameCategory') as $message)
								<p class="text-left alert alert-danger">{{$message}}</p>
							@endforeach
						</div>
	                    <div class="form-group">
			                <label>Mô tả</label>
			                <textarea name="editor4" class="ckeditor form-control" cols="80" id="editor4" rows="10" tabindex="1">{{$category->description}}</textarea>
			                 @foreach ($errors->get('editor4') as $message)
			                    <p class="text-left alert alert-danger">{{$message}}</p>
			                 @endforeach
		                </div>
					    <input type="text" hidden  name="IdCategory" value="{{$category->id}}"> 
					  
					  	<button type="submit" class="btn btn-primary">Lưu</button>
					  	<a href="{{Asset('admin/categories')}}"> Huỷ</a>
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