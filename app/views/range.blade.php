@extends('main')
@section('title')
	Range
@endsection
@section('content')
<div class="row">
		<div class="col-xs-10 col-md-offset-1">
			<div class="row">
				<div class="col-xs-6 ">
					<h1>Range</h1>
				</div>
				<div class="col-xs-6 ">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-8"> 
					<a href="{{URL::route('add-range')}}" class="btn btn-primary">Add Range</a>
					<button id="del_range" class="btn btn-danger" type="submit" data-toggle="modal"> Delete Range </button>
					<div class="modal fade" id="no-selected" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			          <div class="modal-dialog">
			            <div class="modal-content">
			              <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			                <h4 class="modal-title">Thông báo</h4>
			              </div>
			              <div class="modal-body">
			                <p>Vui lòng chọn Range để xóa</p>
			              </div>
			              <div class="modal-footer">
			                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
			              </div>
			            </div><!-- /.modal-content -->
			          </div><!-- /.modal-dialog -->
			        </div>
				</div>
			</div>
			
			@if(Session::has("messages"))				
				<h3><p class="label label-success">{{ Session::get('messages')}}</p></h3>
			@endif
			<div class="row">
			<div class="col-sm-6">
				<div class="table-responsive">
					<form action="{{URL::route('delete-ranges')}}" method="post" id="dels_range">
					<table class="table table-hover ">
						<thead>
						<tr>
							<th></th>
							<th> ID </th>
							<th> Min </th>
							<th> Max </th>
						</tr>
					</thead>
						<tbody>
						@if(!empty($results))
						@foreach($results as $range)
							<tr>
								<td>
	                                <input type="checkbox" value="{{$range->id}}" class='  compare-title'>
	                                <input type="hidden" name="checkbox-{{$range->id}}" value="" >
	                            </td>
								<td>{{$range->id}}</td>
								<td>{{$range->min}}
									<ul class="menu list-unstyled" role="menu">
                            			<li><a href="{{URL::route('edit-range',array($range->id))}}">Edit</a></li>
                            			<li><a href="" data-toggle="modal" data-target="#bs-delele-modal-sm-{{$range->id}}">Delete</a></li>
                            			
                            		</ul>
                            	</td>
                            	<td>
                            		{{$range->max}}
                            	</td>
							</tr>
							<div class="modal fade" id="bs-delele-modal-sm-{{$range->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                             <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Thông báo</h4>
                                  </div>
                                  <div class="modal-body">
                                    <p>Bạn có chắc chắn muốn xóa range này ra khỏi hệ thống</p>
                                  </div>
                                  <div class="modal-footer">
                                    <a href="{{URL::route('delete-range',array($range->id))}}" class="btn btn-primary">Yes</a>
                                    <a class="btn btn-default" data-dismiss="modal">No</a>
                                  </div>
                                </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                        </div>
						@endforeach
						@else <p class="empty">Không tìm thấy kết quả</p></div>
						@endif
					</tbody>
						
					</table>
				</form>		
					<div class="per_page">{{$results->links()}}	</div>
				</div>
			</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$(document).ready(function(){
		var mybtn = document.getElementById('edit_user');
		var $i=0;
		$('input[type="checkbox"]').click(function(){
			if($(this).is(':checked')) {
				var id= $(this).val();
			 	$(this).next().val(id);
				$i++;
			}else{
				$(this).next().val("");
				$i--;
			}
			$("#count").val($i);
		});
		$('#del_range').click(function(){
			if ($i<1) {
				$("#no-selected").modal("show");
				return false;
			}else{
				$("#dels_range").submit();
			}
		});
	});
</script>
@endsection