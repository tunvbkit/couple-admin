@extends('main')
@section('title')
	Article-{{$article->title}}
@endsection
@section('content')

	<div class="row">
		<div class="col-xs-10 col-md-offset-1">
			<div class="row">
				<div class="col-xs-6 ">
					<h1>Chỉnh sửa bài viết</h1>
				</div>
				
			</div>
			<div class="row">
				<div>
					@if(!empty($article))
					<form action="{{URL::route('update_article',array($article->id))}}" method="post" id="from-edit-category">
						<div class="form-group">
							<label>Thuộc chủ đề</label>
							<select name="taxonomy" id="taxonomy" class="taxonomy">
		                    	@foreach(Taxonomy::get() as $taxonomy)
		                        <option value="{{$taxonomy->id}}" 
		                            @if($taxonomy->id==$article->taxonomy) {{"selected"}}
		                            @endif
		                        >{{$taxonomy->name}}</option>
		                        @endforeach
		                    </select>
							@foreach ($errors->get('taxonomy') as $message)
								<p class="text-left alert alert-danger">{{$message}}</p>
							@endforeach
						</div>
						<div class="form-group">
							<label>Tiêu đề</label>
							<input type="text" class="form-control" id="NameCategory" name="NameCategory" value="{{$article->title}}">
							@foreach ($errors->get('NameCategory') as $message)
								<p class="text-left alert alert-danger">{{$message}}</p>
							@endforeach
						</div>
						 <div class="form-group">
						  	<label>Mô tả</label>
						    <textarea type="text" class="description form-control" name="description" style="display:block;width:100%;">{{$article->description}}</textarea>
						  </div>
	                    <div class="form-group">
			                <label>Nội dung</label>
			                <textarea name="editor4" class="ckeditor form-control" cols="80" id="editor4" rows="10" tabindex="1">{{$article->content}}</textarea>
			                 @foreach ($errors->get('editor4') as $message)
			                    <p class="text-left alert alert-danger">{{$message}}</p>
			                 @endforeach
		                </div>
					    <input type="text" hidden  name="IdCategory" value="{{$article->id}}"> 
					  
					  	<button type="submit" class="btn btn-primary">Lưu</button>
					  	<a href="{{URL::route('article')}}"> Huỷ</a>
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