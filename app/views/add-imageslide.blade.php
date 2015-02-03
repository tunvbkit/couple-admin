@extends('main')
@section('title')
    Add Image Slide
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-8">
            <h1>Upload Image Slide</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-5">
            <form action="{{URL::route('upload')}}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" role="form">
              
                <div class="form-group">
                    <label for="">Vendor</label>
                    <input type="hidden" name="input_id_vendor" id="input_id_vendor" class="form-control" value="">
                    <select name="vendor"  id="vendor" class="form-control" >
                        @foreach(Vendor::get() as $vendor)
                        <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Photo:</label>
                    <input name="bigpic_upload[]" id="bigpic_upload" type="file"  multiple="true" accept="image/*" data-max-size="1048576" required >

                </div>
                 

                <div class="row form-group">
                    <div class="col-xs-6">
                        <button type="reset" class="btn btn-default">Reset</button>
                        <button type="submit" class="btn btn-primary" id="submit_upload">Upload</button>
                    </div>
                </div>
                 <div class="row form-group">
                    <div class="col-xs-12">
                       <b style="color:red">Mỗi vendor upload nhiều nhất 9 ảnh.</b>
                    </div>
                </div>                 
                
            
                
            </form>
            <script type="text/javascript">
                $( "#vendor" ).change(function() {
                    var str=$(this).val();                  
                    $("#input_id_vendor").val(str);
                });
                $("#bigpic_upload").change(function(){
                   var files = $(this)[0].files;
                   var fileInput = $('#bigpic_upload');
                   var maxSize = fileInput.data('max-size');    
                    if(files.length > 9){
                        swal("Chỉ được upload tối đa 9 ảnh!");
                        $("#bigpic_upload").val("");
                    }else{
                        var fileName = $("#bigpic_upload").val().toLowerCase();
                        if(fileName.lastIndexOf("png")===fileName.length-3 | fileName.lastIndexOf("jpeg")===fileName.length-3 |fileName.lastIndexOf("gif")===fileName.length-3|fileName.lastIndexOf("jpg")===fileName.length-3)
                         {   $.ajax({
                                type:"POST",
                                url:"{{URL::route('check_imageslide')}}",
                                data:{
                                    id_vendor:$("#input_id_vendor").val()
                                },
                                success:function(data)
                                {
                                    var obj=JSON.parse(data);
                                    if(obj.check+files.length>=9)
                                    {
                                        $("#bigpic_upload").val("");
                                        swal("Tổng số ảnh của nhà cung cấp "+obj.name_vendor + " lớn 9, vui lòng chọn lại!"); 
                                    }
                                    else
                                    {
                                        for (var j=0; j<files.length; j++) 
                                        {                                                          
                                        var fileSize = files[j].size; // in bytes
                                            if(fileSize>maxSize){
                                                swal("Dung lượng của mỗi bức ảnh phải nhỏ hơn 1MB(mega byte), vui lòng chọn lại!"); 
                                                $("#bigpic_upload").val("");
                                                
                                            }
                                                                                                                                                       
                                        }       
                                    }
                                }
                            });
                           } 
                        else
                        {
                            $("#bigpic_upload").val("");                        
                            swal("Vui lòng chọn đúng định dạng file Ảnh!");                                                                                 
                            
                        }                                 
                    }                                                                         
                                                                                                                
                });     

            </script>
        </div>
    </div>

</div>
@endsection