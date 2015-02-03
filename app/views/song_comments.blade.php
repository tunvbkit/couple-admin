@extends('main')

@section('title')
Songs | Comments
@endsection
@section('content')
<div class="row">
	<div class="col-xs-12 col-md-8 col-lg-6">
		<h1>Song Comment</h1>
	</div>
	<div class="col-xs-12 col-md-6 col-lg-4 search">
		<form action="{{URL::to('admin/song_cmts/search')}}" method="post">
			<div class="input-group">
		      <input type="text" class="form-control" name="key" placeholder="Enter song_cmt need search">
		      <span class="input-group-btn">
		        <button class="btn btn-default" type="submit">Search</button>
		      </span>
		    </div><!-- /input-group -->
		</form>
	</div>
</div>
<div class="row">
    <div class="col-xs-12">
    	<ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i><a href="{{Asset('admin/main')}}">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-edit"></i> Song Comment
            </li>
        </ol>
    </div>
</div>
<div class="row">
	<div class="col-xs-4">
		<button id="del_song_cmt" class="btn btn-danger" type="submit">Delete Comments</button>
	</div>
	<div class="col-xs-8">
		
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		@if(isset($msg))
			<h3><span class="label label-info">{{$msg}}</span></h3>
		@endif
	</div>
</div>
<form action="{{URL::route('song_cmt_dels')}}" method="post" id="song_cmt_dels">
<table class="table table-striped">
	<thead>
		<th></th>
		<th>#</th>
		<th>User</th>
		<th>Song</th>
		<th>Content</th>
	</thead>
	<tbody>
	@foreach($song_comments as $index => $song_cmt)
		<tr>

			<td>
				<input type="checkbox" value="{{$song_cmt->id}}">
				<input type="hidden" name="chk-{{$song_cmt->id}}" value="" >
			</td>
			<td>{{$index+1}}</td>
			<td style="color:#51b5c4;" >{{$song_cmt->user_name}}</td>
			<td style="color:#51b5c4;" >{{Song::where('id',$song_cmt->song)->get()->first()->name}}</td>
			<td>{{$song_cmt->content}}</textarea></td>

		</tr>
	@endforeach()
	</tbody>
</table>
</form>
<div class="per_page">{{ $song_comments->links() }}</div>

<script type="text/javascript">
	$(document).ready(function(){
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
		});
		$('#del_song_cmt').click(function(){
			if ($i<1) {
				alert('You must check comment need delete!');
				return false;
			}else{
				$("#song_cmt_dels").submit();
			}
		});
	});
</script>

@endsection