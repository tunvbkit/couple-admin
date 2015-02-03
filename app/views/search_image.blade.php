@extends('main')
@section('title')
	ImageSlide
@endsection
@section('content')
<div class="container location">
<div class="row">
    <div class="col-xs-12 col-md-8 col-lg-6">
        <h1>ImageSlide</h1>
    </div>
    <div class="col-xs-10 col-md-6 col-lg-4 search">
        <form id="search-vendor" role="form" action="{{URL::route('search_image')}}" method="post">
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
                <i class="fa fa-dashboard"></i><a href="{{Asset('admin/main')}}">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-edit"></i>ImageSlide
            </li>
        </ol>
    </div>
    
</div>
    <div class="row">
    	<div class="col-xs-10">
            <a href="{{URL::route('imageslide/add')}}"><button type="submit" class="btn btn-primary" >Upload Images</button></a>
            <button type="submit" class="btn btn-danger" id="del_images">Delete</button>
            <div class="table-imageslide">
                <form action="{{URL::route('delSelectImages')}}" method="POST" id="delSelectImages">
                    <table class="table table-striped table-image-slide">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Vendor</th>
                                <th>Photo</th>
                                
                            </tr>
                            
                        </thead>
                         <tbody>
                        @if(!empty($imageslides))
                        @foreach($imageslides as $i=>$imageslide)
                            <tr class="imageslide{{$imageslide->id}}">
                                <td style="width:20px;">                                
                                    <input type="checkbox" class="checkbox" value="{{$imageslide->id}}">
                                    <input type="hidden" name="chk-{{$imageslide->id}}" value="" >
                                    
                                </td>
                                <td style="width:50px;">{{$i+1}}
                                    <input type="hidden" name="number_image{{$imageslide->id}}" id="number_image{{$imageslide->id}}" class="form-control" value="{{$i+1}}">
                                </td>
                                <td>{{Vendor::where('id',$imageslide->vendor)->get()->first()->name}}                                     
                                    <div class="menu-hidden " >
                                        <a  href="{{URL::route('edit',array($imageslide->id))}}">Edit</a>
                                        <a  href=""data-toggle="modal" data-target="#modalDeleteImage" data-backdrop="static" onclick="sent_id_image({{$imageslide->id}})">Delete</a>
                                    </div>
                                    <script type="text/javascript">
                                        function sent_id_image(id)
                                        {
                                            $('.modal_delete_image').val(id);
                                            $.ajax({
                                                type:"POST",
                                                url:"{{URL::route('sent_id_image')}}",
                                                data:{
                                                    id_image:id, number_image:$('#number_image'+id).val()
                                                },
                                                success:function(data)
                                                {
                                                    var obj=JSON.parse(data);
                                                    var str="Bạn có muốn xóa ảnh "+obj.number_image+" của "+obj.name_vendor+"?";
                                                    $('.message_delete_image').text(str);
                                                }
                                            });                                     
                                        }
                                        function delete_image()
                                        {
                                            $.ajax({
                                                type:"POST",
                                                url:"{{URL::route('imageslide/delete')}}",
                                                data:{
                                                    id_image:$('.modal_delete_image').val()
                                                },
                                                success:function(data)
                                                {
                                                    var obj = JSON.parse(data);
                                                    $('.imageslide'+obj.id).remove();
                                                }
                                            });
                                        }
                                    </script>
                                </td>
                                <td> Ảnh {{$i+1}}</td>
                                
                                
                                
                    
                            </tr>
                        @endforeach()
                       
                        @endif
                                       
                    </tbody>
                        </tbody>

                    </table>
                    
                </form>
                
                <!-- /.modal -->
                <div class="modal fade" id="modalDeleteImage">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      
                      <div class="modal-body">
                        <h4 style="color:red;" class="text-center message_delete_image"></h4>
                        <input type="hidden" class="modal_delete_image" value="">
                      </div>
                      <div class="modal-footer" style="text-align:center;">
                        <button onclick="delete_image()" data-dismiss="modal" type="button" class="btn btn-primary">Có</button>
                        <button data-dismiss="modal" type="button" class="btn btn-primary" data-dismiss="modal">Không</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div>
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
            $('#del_images').click(function(){
                if ($i<1) {
                    alert('You must check task need delete!');
                    return false;
                }else{
                    $("#delSelectImages").submit();
                }
            });
        });
</script>
@endsection
