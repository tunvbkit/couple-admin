@extends('main')
@section('title')
	Bình luận
@endsection
@section('content')
 <div class="row">
 	<div class="col-xs-10 col-md-offset-1">
 		<div class="row">
			<div class="col-xs-6 ">
				<h3>Bình luận</h3>
			</div>
			<div class="col-xs-6 ">
				
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4"> 
				<button id="del_category" class="btn btn-danger" type="submit"> Xóa bình luận </button>
			</div>
			<div class="col-xs-8">
				<form id="search-category" role="form" action="{{URL::route('search_comment')}}" method="post">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div class="input-group">
				            	<select class="name_search" name="name_search" style="width:100%;height:34px;">
				            		@foreach($vendors as $vendor)
				            			<option value="{{$vendor->id}}">{{$vendor->name}}</option>
				            		@endforeach
				            	</select>
					            
					            <span class="input-group-btn">
					            <button class="btn btn-default" type="submit">Tìm kiếm!</button>
					            </span>
				            </div><!-- /input-group -->
						</div>
					</div>
	           </form>
			</div>
		</div>
		@if(Session::has("message"))				
			<h3><span class="label label-success">{{ Session::get('message')}}</span></h3>
		@endif
		<div class="row">
			<div class="table-responsive">
				<table class="table table-hover text-center">
					<thead>
						<tr>
							<th class="text-center"><input type="checkbox"></th>
							<th class="text-center">Từ User</th>
							<th class="text-center">Đến Vendor</th>
							<th class="text-center">Nội dung</th>
							<th class="text-center">Thời gian</th>
							<th class="text-center">Duyệt</th>
							<th class="text-center">Xóa</th>
						</tr>
					</thead>
					<tbody>
						@if (!empty($comments)) 
						@foreach($comments as $comment)
							<tr class="tr_comment{{$comment->id}}">
								<td><input type="checkbox"></td>
								<td>{{$comment->user_name}}</td>
								<td>{{Vendor::where('id',$comment->vendor)->get()->first()->name}}</td>
								<td><a style='t' href="{{URL::route('detail_comment',array($comment->id))}}">{{substr($comment->content, 0,50)."..."}}</a></td>
								<td>{{$comment->created_at}}</td>
								<td>
									@if($comment->active == 0) 
				                        <a onclick="activeComment({{$comment->id}})" href="javascript:void(0);">
				                          <span class="c-active{{$comment->id}} fa fa-check-square-o"></span>
				                        </a> 
				                      @else
				                         <a onclick="activeComment({{$comment->id}})" href="javascript:void(0);">
				                          <span class="c-active{{$comment->id}} fa fa-square-o"></span>
				                        </a> 
				                      @endif
								</td>
								<td>
									<a href="javascript:void(0);" onclick="getContentComment({{$comment->id}})" class="delete-comment" data-toggle="modal" data-target='#c-delete'>
										<span class="fa fa-trash-o"></span>
									</a>

								</td>	
							</tr>
						@endforeach
						@endif
					</tbody>
				</table>
			</div>
			<div class="text-center">{{$comments->links()}}</div>
		</div>
 	</div>
 </div>

<div class="modal fade " id="c-delete">
  <div class="modal-dialog modal-md model-delete">
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-center">Xóa bình luận từ user: <span class="f_user"></span> ->vendor: <span class="t_vendor"></span></h4>
      </div>
      <div class="modal-body">
        <p class="content-comment text-center"></p>         
      </div>
      <div class="modal-footer" style="text-align:center;">
            <a onclick="deleteComment()" class="btn btn-primary btn-responsive" type="button" data-dismiss="modal" class="btn btn-primary" >Xóa</a>
            <input class='btn-delete-comment' type='hidden' value="">
            <button  type="button" data-dismiss="modal" class="btn btn-primary" >Đóng</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

 <script type="text/javascript">
    function activeComment(id_comment){
      $.ajax({
          type:"post",
          data:{id_comment:id_comment},
          url:"{{URL::route('active_comment')}}",
          success:function(data){
            if (data.active == 0) {
              $('.c-active'+id_comment).removeClass('fa-square-o');
              $('.c-active'+id_comment).addClass('fa-check-square-o');
            } else{
              $('.c-active'+id_comment).removeClass('fa-check-square-o');
              $('.c-active'+id_comment).addClass('fa-square-o');
            };          
          }
        }); 
    }
    function getContentComment(id_comment){
    	$('.btn-delete-comment').val(id_comment);
    	$.ajax({
          type:"post",
          data:{id_comment:id_comment},
          url:"{{URL::route('get_comment')}}",
          success:function(data){
                $('.f_user').text(data.comment.user_name);
                $('.t_vendor').text(data.name_vendor);
                $('.content-comment').text(data.comment.content);
          }
        }); 
    }
    function deleteComment(){
    	var id_comment = $('.btn-delete-comment').val();
    	$.ajax({
          type:"post",
          data:{id_comment:id_comment},
          url:"{{URL::route('delete_comment')}}",
          success:function(data){
          		$('.tr_comment'+id_comment).remove();
          }
        }); 
    }
	</script>
@endsection
@stop