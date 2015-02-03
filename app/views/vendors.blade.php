@extends('main')
@section('title')
	Vendors
@endsection
@section('content')
<div class="container vendor">
<div class="row">
	<div class="col-xs-12 col-md-8 col-lg-6">
		<h1>Vendors</h1>
	</div>
	<div class="col-xs-10 col-md-6 col-lg-4 search">
		<form id="search-vendor" role="form" action="{{URL::route('search')}}" method="post">
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
    <div class="col-xs-10">
    	<ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="{{URL::route('main')}}">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-edit"></i> Vendors
            </li>
        </ol>
    </div>      
</div>
<form id="form-submit" method="post" action="{{URL::route('delete-vendors')}}">
<div class="row">
    <div class="col-xs-4 menu-vendor">
        <a href="{{URL::route('add-vendor')}}" class="btn btn-primary">Add Vendor</a>
        <button id="button-submit" type"submit" class="btn btn-danger" data-toggle="modal" >Delete Vendors</button>
        <div class="modal fade" id="no-selected" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Thông báo</h4>
              </div>
              <div class="modal-body">
                <p>Vui lòng chọn Vendor để xóa</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-10">
        @if(Session::has('messages')) <p class="alert alert-success">{{Session::get('messages')}}</p> 
        @endif    
    </div>
</div>
    <div class="row">
    	<div class="col-xs-10">
            <input type="hidden" id="count" name="a" value="0">
    		<div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Category</th>
                            <th>Location</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($vendors as $index=> $vendor)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{$vendor->id}}" class='  compare-title'>
                                <input type="hidden" name="checkbox-{{$vendor->id}}" value="" >
                            </td>
                            <td>{{$index+1}}</td>
                            <td>{{$vendor->name}}
                            <ul class="menu list-unstyled" role="menu">
                            	<li><a href="{{URL::route('edit-vendor',array($vendor->id))}}">Edit</a></li>
                            	<li><a class="confirm" href="" data-toggle="modal" data-target="#bs-delele-modal-sm-{{$index}}">Delete</a>
                                </li>
                            </ul>
                            </td>
                            <td>{{$vendor->address}}</td>
                            <td>{{$vendor->phone}}</td>
                            <td>{{$vendor->email}}</td>
                            <td>{{Vendor::find($vendor->id)->category()->get()->first()->name}}</td>
                            <td>{{Vendor::find($vendor->id)->location()->get()->first()->name}}</td>
                            
                        </tr>
                        <div class="modal fade" id="bs-delele-modal-sm-{{$index}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                             <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Thông báo</h4>
                                  </div>
                                  <div class="modal-body">
                                    <p>Bạn có chắc chắn muốn xóa <strong>{{$vendor->name}}</strong> ra khỏi hệ thống</p>
                                  </div>
                                  <div class="modal-footer">
                                    <a href="{{URL::route('delete-vendor',array($vendor->id))}}" class="btn btn-primary">Yes</a>
                                    <a class="btn btn-default" data-dismiss="modal">No</a>
                                  </div>
                                </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                        </div>
                        <script type="text/javascript">
                            $(document).ready(function(){
                        var $i=$('#count').val();
                                $('input[type="checkbox"]').click(function(){
                                if($(this).is(':checked')) {
                                    var id= $(this).val();
                                     $(this).next().val(id);
                                        $i++;
                                    $("#count").val($i);
                                }
                                else{
                                     $(this).next().val("");
                                     $i--;
                                     $("#count").val($i);
                                    }
                            });
                            $("#button-submit").click(function(){
                            if($i==0){
                                $('#no-selected').modal('show')
                                return false;
                            }
                           else{ $("#form-submit").submit();}
                            });
                        });
                        </script>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- /.table-responsive -->
    	   <div class="per_page">{{ $vendors->links() }}</div>
        </div><!-- /.col-xs-10 -->
    </div><!-- /.row -->
    </form>
@endsection
