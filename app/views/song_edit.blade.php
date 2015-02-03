@extends('main')

@section('title')
Songs | Edit
@endsection
@section('content')
<div class="row">
	<div class="col-xs-12 col-md-8 col-lg-6">
		<h1>Song</h1>
	</div>
	<div class="col-xs-12 col-md-6 col-lg-4 search">
		<form action="{{URL::to('admin/songs/search')}}" method="post">
			<div class="input-group">
		      <input type="text" class="form-control" name="key" placeholder="Enter song need search">
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
                <i class="fa fa-edit"></i> Song
            </li>
        </ol>
    </div>
</div>

<h2>Edit Song</h2>

<form action="{{URL::route('songs/edit')}}" method="post" id="form_edit_song">
@foreach($song as $song_item)
	<div class="row">
		<div class="col-xs-10">
			<div class="row form-group">
				<div class="col-xs-1">
					<label for="name">Name</label>
				</div>
				<div class="col-xs-10">
					<input type="hidden" class="form-control" name="id" id="id" value="{{$song_item->id}}">
					<input type="text" class="form-control" name="name" id="name" value="{{$song_item->name}}">
				</div>
			</div>
			<div class="row form-group">
				<div class="col-xs-1">
					<label for="category">Category</label>
				</div>
				<div class="col-xs-10">
					<select class="form-control" name="category" id="category">
				    	@foreach(SongCategory::get() as $category)
				    	<option value="{{$category->id}}">{{$category->name}}</option>
				    	@endforeach
				    </select>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-xs-1">
					<label for="artist">Artist</label>
				</div>
				<div class="col-xs-10">
					<input type="text" class="form-control" name="artist" id="artist" value="{{$song_item->artist}}">
				</div>
			</div>
			<div class="row form-group">
				<div class="col-xs-1">
					<label for="genre">Genre</label>
				</div>
				<div class="col-xs-10">
					<select class="form-control" name="genre" id="genre">
				    	<option value="1">Pop</option>
				    	<option value="2">Dance</option>
				    	<option value="3">Pop, Dance</option>
				    	<option value="4">Rock</option>
				    	<option value="5">Balace</option>
				    </select>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-xs-1">
					<label class="link">Link</label>
				</div>
				<div class="col-xs-10">
					<textarea cols="118" name="link" id="link" >{{$song_item->link}}</textarea>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-xs-1">
					<label class="lyric">Lyric</label>
				</div>
				<div class="col-xs-10">
					<textarea class="ckeditor" cols="38" name="lyric" id="lyric" >{{$song_item->lyric}}</textarea>
				</div>
			</div>
		</div>
	</div> <!-- class row -->
	@endforeach
	<div class="row">
		<div class="col-xs-12">
			<button class="btn btn-primary" type="submit">OK</button>
			<a class="btn btn-default" href="{{URL::to('admin/songs')}}" role="button">Cancel</a>
		</div>
	</div>
</form>

<script type="text/javascript">
	$("#form_edit_song").validate({
		rules:{
			name:{
				required:true,
				remote:{
					url:"{{URL::route('check_song_name_edit', array($song_item->id))}}",
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
				required:"Song name not null!",
				remote:"Song name had!"
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
	

@endsection