@extends('main')

@section('title')
Songs
@endsection
@section('content')
<div class="row">
	<div class="col-xs-12 col-md-8 col-lg-6">
		<h1>Song</h1>
	</div>
	<div class="col-xs-12 col-md-6 col-lg-4 search">
		<form id="search-vendor" role="form" action="{{URL::route('search_song')}}" method="post">
            <div class="input-group">
              <input type="text" name="search_name" class="form-control">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Search!</button>
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
                <i class="fa fa-edit"></i> Song
            </li>
        </ol>
    </div>
</div>

<div class="row">
	<div class="col-xs-4">
		<a href="#" class="btn btn-info" data-toggle="modal" data-target="#myModalCreatSong">Create Song</a>
		<button id="del_song" class="btn btn-danger" type="submit">Delete Song</button>
		<a href="{{URL::route('song_comments')}}" class="btn btn-warning">Comments</a>
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
<form action="{{URL::route('song_dels')}}" method="post" id="song_dels">
<table class="table table-striped">
	<thead>
		<th></th>
		<th>#</th>
		<th>Name</th>
		<th>Category</th>
		<th>Comment</th>
	</thead>
	<tbody>
	@foreach($songs as $index => $song)
		<tr>
			<td>
				<input type="checkbox" value="{{$song->id}}">
				<input type="hidden" name="chk-{{$song->id}}" value="" >
			</td>
			<td>{{$index+1}}</td>
			<td id="email-user">{{$song->name}}
				<p>
					<a href="{{URL::route('songs-edit', array($song->id))}}">Edit</a>
					 | 
					<a href="#" data-toggle="modal" data-target="#myModalDeleteSong{{$index}}">Delete</a>
				</p>
			</td>
			<td>{{SongCategory::where('id',$song->category)->get()->first()->name}}</td>
			<td style="color:#51b5c4;">{{SongComment::where('song',$song->id)->get()->count()}} <i class="fa fa-comment"></i></td>

			<!-- Modal Delete Song -->
			<div class="modal fade" id="myModalDeleteSong{{$index}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h3 class="modal-title" id="myModalLabel">Delete Song</h3>
			      </div>
			      <div class="modal-body">
			      	{{$song->name}}
			      </div>
			      <div class="modal-footer">
			      	<a href="{{URL::to('admin/songs/delete', array('id'=>$song->id))}}">
			      		<button type="button" class="btn btn-primary">OK</button>
			      	</a>
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			      </div>
			    </div>
			  </div>
			</div>
			<!-- end modal delete song -->

		</tr>
	@endforeach()
	</tbody>
</table>
</form>
<div class="per_page">{{ $songs->links() }}</div>

<!-- Modal Creat Song -->
<div class="modal fade" id="myModalCreatSong" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="myModalLabel">Creat Song</h3>
      </div>
      <div class="modal-body">
        <form id="form_addsong" action="{{Asset('admin/songs')}}" method="post">
		    <div class="row form-group">
		    	<div class="col-xs-2">
		    		<label for="name">Name:</label>
		    	</div>
				<div class="col-xs-6">
				   	<input type="text" class="form-control" name="name" id="name" placeholder="Name">
				</div>
				<div class="col-xs-4"></div>
			</div>
			<div class="row form-group">
				<div class="col-xs-2">
		    		<label for="category">Category:</label>
		    	</div>
				<div class="col-xs-6">
				    <select class="form-control" name="category" id="category">
				    	@foreach(SongCategory::get() as $category)
				    	<option value="{{$category->id}}">{{$category->name}}</option>
				    	@endforeach
				    </select>
				</div>
				<div class="col-xs-4"></div>
			</div>
			<div class="row form-group">
				<div class="col-xs-2">
		    		<label for="artist">Artist:</label>
		    	</div>
				<div class="col-xs-6">
				    <input type="text" class="form-control" name="artist" id="artist" placeholder="Artist">
				</div>
				<div class="col-xs-4"></div>
			</div>
			<div class="row form-group">
				<div class="col-xs-2">
		    		<label for="genre">Genre:</label>
		    	</div>
				<div class="col-xs-6">
				    <select class="form-control" name="genre" id="genre">
				    	<option value="1">Pop</option>
				    	<option value="2">Dance</option>
				    	<option value="3">Pop, Dance</option>
				    	<option value="4">Rock</option>
				    	<option value="5">Balance</option>
				    </select>
				</div>
				<div class="col-xs-4"></div>
			</div>
			<div class="row form-group">
				<div class="col-xs-2">
		    		<label for="link">Link:</label>
		    	</div>
				<div class="col-xs-6">
				    <textarea cols="38" name="link" id="link" placeholder="Embed tag from Youtube.com"></textarea>
				</div>
				<div class="col-xs-4"></div>
			</div>
			<div class="row form-group">
				<div class="col-xs-2">
		    		<label for="lyric">Lyric:</label>
		    	</div>
				<div class="col-xs-6">
				    <textarea cols="38" name="lyric" id="lyric" placeholder="Song lyric"></textarea>
				</div>
				<div class="col-xs-4"></div>
			</div>
		  	<div class="row form-group">
		  		<div class="col-xs-6">
		  			<button type="reset" class="btn btn-default">Reset</button>
			    	<button type="submit" class="btn btn-primary" id="submit_add">OK</button>
		  		</div>
		  	</div>

		</form>
    </div> <!-- end modal body -->
</div> <!-- end modal content -->
</div> <!-- end modal dialog -->
</div> <!-- end modal fade -->
<!-- end modal creat song -->

<!-- script of validate -->
<script type="text/javascript">
	$("#form_addsong").validate({
		rules:{
			name:{
				required:true,
				remote:{
					url:"{{URL::route('check_song_name')}}",
					type:"post"
				}
			},
			artist:{
				required:true,
			},
			link:{
				required:true
			},
			lyric:{
				required:true
			}
		},
		messages:{
			name:{
				required:"Name not null!",
				remote:"Name exists!"
			},
			artist:{
				required:"Artist not null!"
			},
			link:{
				required:"Link not null!"
			},
			lyric:{
				required:"Lyric not null!"
			}
		}
	});
</script>

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
		$('#del_song').click(function(){
			if ($i<1) {
				alert('You must check song need delete!');
				return false;
			}else{
				$("#song_dels").submit();
			}
		});
	});
</script>

@endsection