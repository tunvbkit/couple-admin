@extends('main')
@section('title')
	Edit {{$vendor->name}}
@endsection
@section('content')
<div class="container">
<div class="row">
<div class="col-xs-8">
	<h1>Edit Vendor: {{$vendor->name}}</h1>
    @if(isset($messages)) <p class="alert alert-danger">{{$messages}}</p>
    @endif
</div>
</div>
	<div class="row">
		<div class="col-xs-8">
        @if(isset($vendor))
			<form id="edit-vendor" method="post" action="{{URL::route('update-vendor',array($vendor->id))}}" accept-charset="UTF-8" enctype="multipart/form-data" role="form">

                <div class="form-group">
                    <label>Name</label>
                    <input name='name' id='name' class="form-control" value="{{$vendor->name}}">
                    @foreach ($errors->get('name') as $message)
                    <p class="text-left alert alert-danger">{{$message}}</p>
                    @endforeach
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input name='address' id='address' value="{{$vendor->address}}" placeholder="Enter text" class="form-control">
                    @foreach ($errors->get('address') as $message)
                    <p class="text-left alert alert-danger">{{$message}}</p>
                    @endforeach
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name='email' id='email' value="{{$vendor->email}}" placeholder="Enter text" class="form-control">
                    @foreach ($errors->get('email') as $message)
                    <p class="text-left alert alert-danger">{{$message}}</p>
                    @endforeach
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input name='phone' id='phone' value="{{$vendor->phone}}" placeholder="Enter text" class="form-control">
                    @foreach ($errors->get('phone') as $message)
                    <p class="text-left alert alert-danger">{{$message}}</p>
                    @endforeach
                </div>

                <div class="form-group">
                    <label>Website</label>
                    <input name='website' value="{{$vendor->website}}" placeholder="Enter text" class="form-control">
                </div>
                 <div class="form-group">
                    <label>Map</label>                   
                    <input name='map' value="{{$vendor->map}}" placeholder='Copy phần src=" " (<iframe src="Nội dung copy"></iframe>) của Google Map' class="form-control">
                </div>
                 <div class="form-group">
                    <label>Video</label>
                    <input name='video' value="{{$vendor->video}}" placeholder='Copy phần src=" " (<iframe src="Nội dung copy"></iframe>) của Youtube' class="form-control">
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category" class="form-control">
                    	@foreach(Category::get() as $category)
                        <option value="{{$category->id}}" 
                            @if($category->id==$vendor->category) {{"selected"}}
                            @endif
                        >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Location</label>
                    <select name="location" class="form-control">
                    	@foreach(Location::get() as $location)
                        <option value="{{$location->id}}"
                            @if($location->id==$vendor->location) {{"selected"}}
                            @endif
                        >{{$location->name}}</option>
                    	@endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Avatar</label>
                    <input name="avatar" id='avatar' type="file" accept="image/*" data-max-size="1048576" >

                    <!-- display images vendor -->
                    {{VendorController::getImagesVendor($vendor->photo)}}
                    
                    @foreach ($errors->get('avatar') as $message)
                    <p class="text-left alert alert-danger">{{$message}}</p>
                    @endforeach
                    
                </div>
                <div class="form-group">
                <label>About Us</label>
                <textarea name="editor4" class="ckeditor form-control" cols="80" id="editor4" rows="10" tabindex="1">{{$vendor->about}}</textarea>
                 @foreach ($errors->get('editor4') as $message)
                    <p class="text-left alert alert-danger">{{$message}}</p>
                    @endforeach
                </div>
                <button type="reset" class="btn btn-default">Reset</button>
                <button class="btn btn-default" type="submit">Edit Vendor</button>
                
            </form>
            @endif
            <script type="text/javascript">
                 $("#avatar").change(function(){
                           var files = $(this)[0].files;
                           var fileInput = $('#avatar');
                           var maxSize = fileInput.data('max-size'); 
                            var fileName = $("#avatar").val().toLowerCase();
                                if(fileName.lastIndexOf("png")===fileName.length-3 | fileName.lastIndexOf("jpeg")===fileName.length-3 |fileName.lastIndexOf("gif")===fileName.length-3|fileName.lastIndexOf("jpg")===fileName.length-3)
                                {                                                                                    
                                    var fileSize = files[0].size; // in bytes
                                        if(fileSize>maxSize){
                                            swal("Dung lượng của mỗi bức ảnh phải nhỏ hơn 1MB(mega byte), vui lòng chọn lại!"); 
                                            $("#avatar").val("");
                                            
                                        }
                                                                                                                                                   
                                         
                                       
                                   } 
                                else
                                {
                                    $("#avatar").val("");                        
                                    swal("Vui lòng chọn đúng định dạng file Ảnh!");                                                                                 
                                    
                                }                                 
                                                                                                    
                                                                                                                        
                        });     
                $('#edit-vendor').validate({
                rules:{
                    name:{
                    required:true,
                    minlength:3,
                    remote:{
                                url:'{{URL::route('edit-check-vendor',array($vendor->id))}}',
                                type:"POST"
                            }
                    },
                    address:{
                        required:true,
                        minlength:5
                    },
                    email:{
                        
                        email:true,
                        remote:{
                                url:'{{URL::route('edit-check-vendor-email',array($vendor->id))}}',
                                type:"POST"
                            }
                    },
                    phone:{
                        required:true,
                        minlength:9
                    },
                    editor4:{
                        required:true,
                        minlength:10
                    }
                },
                messages:{
                    name:{
                        required:"Chưa điền thông tin",
                        minlength: "Yêu cầu nhập trên 3 kí tự",
                        remote:"Tên Vendor đã tồn tại"
                    },
                    address:{
                        required:"Chưa điền thông tin",
                        minlength:"Yêu cầu nhập trên 5 kí tự"
                    },
                    email:{
                       
                        email:"Không đúng định dạng email",
                        remote:"Email đã tồn tại"
                    },
                    phone:{
                        required:"Chưa điền thông tin",
                        minlength:"Yêu cầu nhập trên 9 kí tự"
                    },
                    editor4:{
                        required:"Chưa điền thông tin",
                        minlength:"Yêu cầu nhập trên 10 kí tự"
                    }
                }
            })
        </script>
		</div>
		<div class="col-xs-4"></div>
	</div>
</div>
@endsection