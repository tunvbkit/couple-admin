@extends('main')
@section('title')
	Chi tiết bài viết
@endsection
@section('content')
<div class="row">
	<div class="col-xs-10 col-md-offset-1">
		<div class="row">		
			<h1>{{$article->title}}</h1>					
		</div>
		<div class="row">
			{{$article->content}}
		</div>		
	</div>
</div>
@endsection