@extends('main')
@section('title')
	Bình luận
@endsection
@section('content')
<div class="row">
	<div class="col-xs-10 col-md-offset-1">
		<h3 >Chi tiết bình luận</h3>
	</div>
	<div class="col-xs-10 col-md-offset-1 detail-from">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="font-weight: bold;">
          <span>Từ User: {{$comment->user_name}}</span> 
          <span>--> Vendor: {{Vendor::where('id',$comment->vendor)->get()->first()->name}}</span>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 time-inbox">
           <span>{{$comment->updated_at}}</span> 
           <a href="{{URL::route('comment')}}" data-toggle="tooltip" data-placement="bottom" title="Quay lại" style="margin-left:3%;"><span class="fa fa-reply"></span></a>
        </div>
  	</div>
	 <div class="col-xs-10 col-md-offset-1 content-inbox">
	    {{$comment->content}}
	</div>
</div>
@endsection
@stop