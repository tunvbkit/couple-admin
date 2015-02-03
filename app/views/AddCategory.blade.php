@extends('main')
@section('title')
	CategoryAdd-Thuna.vn
@endsection
@section('content')
	<div class="row">
		<div class="col-xs-10 col-md-offset-1">
			<div class="row">
				<div class="col-xs-6 ">
					<h1>Category Add</h1>
				</div>
				
			</div>
			<div class="row">
				<div>
					<form action="{{ Asset("admin/NewCategory")}}" method="post" id="add-category">
					  <div class="form-group">
					  	<label>Tên Category</label>
					    <input type="text" class="form-control" id="NameCategory" name="NameCategory" >
					  </div>
					  <div class="form-group">
			                <label>Mô tả</label>
			                <textarea name="editor4" class="ckeditor form-control" cols="80" id="editor4" rows="10" tabindex="1"></textarea>
			                 @foreach ($errors->get('editor4') as $message)
			                    <p class="text-left alert alert-danger">{{$message}}</p>
			                 @endforeach
		                </div>
					  <button type="submit" class="btn btn-default">Lưu</button>
					</form>
				</div>
				
			<script type="text/javascript">
		                $('#add-category').validate({
		                rules:{
		                	NameCategory:{
		                    required:true,
		                    minlength:3,
		                    remote:{
	                                url:'{{URL::route('check_Categories')}}',
	                                type:"POST"
	                            }
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
			</div>
		</div>
	</div>
@endsection