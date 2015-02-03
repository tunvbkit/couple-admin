@extends('main')
@section('title')
	Add Range
@endsection
@section('content')
	<div class="row">
		<div class="col-xs-10 col-md-offset-1">
			<div class="row">
				<div class="col-xs-6 ">
					<h1>Add Range</h1>
				</div>
			</div>
			<div class="form-range">
					<form action="{{URL::route('add-range')}}" class="form-horizontal" method="post" id="add-range">
						<div class="form-group">
							<label class="col-sm-2 control-label">Min</label>
							<div class="col-sm-10">
							<input type="text" class="form-control" id="min" name="min" >
							</div>
						</div>
						<div class="form-group">
						 <label class="col-sm-2 control-label">Max</label>
						 <div class="col-sm-10">
							<input type="text" class="form-control" id="max" name="max" >
							</div>
						</div>
						<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<p>Đơn vị: Triệu VND</p>
						</div>
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-primary">Lưu</button>
							</div>
						</div>
					</form>
				
			<script type="text/javascript">
			$.validator.addMethod('moreThanEqual', function(value, element, param) {
			    if (this.optional(element)) return true;
			    var i = parseInt(value);
			    var j = parseInt($(param).val());
			    return j < i;
			}, "Giá trị max phải lớn hơn min");
            $('#add-range').validate({
                rules:{
                	min:{
                		required:true,
                		number:true
                	},
                	max:{
                		required:true,
                		number:true,
                		moreThanEqual: "#min"
                	}
                },
                messages:{
                    min:{
                    	required: "Chưa nhập thông tin",
                    	number: "Yêu cầu nhập định dạng số"
                    },
                    max:{
                    	required: "Chưa nhập thông tin",
                    	number: "Yêu cầu nhập định dạng số"
                    }
                }
		            });
		        </script>
		        <script type="text/javascript">
		        </script>
			</div>
		</div>
	</div>
@endsection