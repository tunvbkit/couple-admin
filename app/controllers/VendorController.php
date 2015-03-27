<?php

class VendorController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('vendors')->with("vendors",Vendor::paginate(10));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
			$year=date("Y");
			$month=date('m');
			File::makeDirectory(base_path('../images/avatar/'.$year.'/'.$month),$mode = 0775,true,true);
			$image = Input::file('avatar');
			$filename =str_random(10) . '.' .$image->getClientOriginalExtension();
			$path = base_path('../images/avatar/'.$year.'/'.$month.'/'.$filename);
			$pathsave='images/avatar/'.$year.'/'.$month.'/'.$filename;
			Image::make($image->getRealPath())->resize(300, 300)->save($path);
			if (Input::get('email') == true) {
				$user = new User();
				$user->email = Input::get('email');
				$user->role_id = 3;
				$user->password = Hash::make('123456');
				$user->save();
			}			
			$vendor=new Vendor();
			$vendor->name=Input::get('name');
			if (Input::get('email') == true) {
				$vendor->user = User::where('email',Input::get('email'))->get()->first()->id;
			}			
			$vendor->address=Input::get('address');
			$vendor->phone=Input::get('phone');
			$vendor->website=Input::get('website');
			$vendor->map=Input::get('map');
			$vendor->video=Input::get('video');
			$vendor->category=Input::get('category');
			$vendor->location=Input::get('location');
        	$vendor->about=strip_tags(Input::get('editor4'));
        	$vendor->slug=Str::slug(Input::get('name'));
        	$vendor->save();
        	$id_vendor = Vendor::where('user',User::where('email',Input::get('email'))->get()->first()->id)->get()->first()->id;
        	$avatar = new Avatar();
        	$avatar->avatar = $pathsave;
        	$avatar->vendor = $id_vendor;
        	$avatar->active = 1;
        	$avatar->save();
        	return Redirect::to('admin/vendors')->with('messages',"Tao Vendor thanh cong");
		
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	public static function deleteVendorLocation($id)
	{
		Vendor::where('location',$id)->delete();
	}
	public static function deleteVendorCategory($id)
	{
		Vendor::where('category',$id)->delete();
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$vendor = Vendor::where("id","=",$id)->get()->first();
		return View::make('edit-vendor')->with("vendor",$vendor);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
			$year=date("Y");
			$month=date('m');

			$photo_vendor = Vendor::where('id', $id)->get()->first()->avatar;

			if(Input::hasFile('avatar')) 
			{

				$path_delete = base_path("../".$photo_vendor);
				File::delete($path_delete);

				File::makeDirectory(base_path('../images/avatar/'.$year.'/'.$month),$mode = 0775,true,true);
				$image = Input::file('avatar');
				$filename =str_random(10) . '.' .$image->getClientOriginalExtension();
				$path = base_path('../images/avatar/'.$year.'/'.$month.'/'.$filename);
				$pathsave='images/avatar/'.$year.'/'.$month.'/'.$filename;
				Image::make($image->getRealPath())->resize(300, 300)->save($path);
			}

			$vendor=Vendor::find($id);
			$vendor->name=Input::get('name');
			$vendor->address=Input::get('address');
			$vendor->user=Input::get('user');
			$vendor->phone=Input::get('phone');
			$vendor->website=Input::get('website');
			$vendor->map=Input::get('map');
			$vendor->video=Input::get('video');
			$vendor->category=Input::get('category');
			$vendor->location=Input::get('location');
			
			if(Input::hasFile('avatar')) 
			{
				$vendor->avatar=$pathsave;
			} else {
				$photo_vendor = Vendor::where('id', $id)->get()->first()->avatar;
				$vendor->avatar=$photo_vendor;
			}

			
        	$vendor->about=strip_tags(Input::get('editor4'));
        	$vendor->slug=Str::slug(Input::get('name'));
        	$vendor->save();
        	return Redirect::to('admin/vendors')->with('messages',"Edit Vendor thanh cong");
	
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function deleteOneVendor($id){
		$name = Vendor::where('id',$id)->get()->first()->avatar;
		$path_delete = base_path('../'.$name);
		File::delete($path_delete);
		Vendor::find($id)->delete();
	}
	public static function deleteManyImage($id){
		$counts=PhotoSlide::where('vendor',$id)->get()->count();		
		if($counts>0)
		{	
			foreach (PhotoSlide::where('vendor',$id)->get() as $photo)
			 {
				ImageSlideController::deleteImageVendor($photo->id);
			}
			
			VendorController::deleteOneVendor($id);
		}
		else
		{	
			VendorController::deleteOneVendor($id);
		}
	}
	public function destroy($id)
	{
		VendorController::deleteManyImage($id);
		return Redirect::to('admin/vendors')->with('messages',"Xoa vendor thanh cong");
	}
	public function delete_vendors(){
		$ids=array();
		foreach(Vendor::get() as $vendor){
			if(Input::get('checkbox-'.$vendor->id)==$vendor->id){
				$ids[]=Input::get('checkbox-'.$vendor->id);
						
			}
		}
		foreach ($ids as $id=>$key){
			foreach (Vendor::get() as $vendor){
				if($vendor->id==$key){
				VendorController::deleteManyImage($vendor->id);
				}
			} // end foreach
		} //end foreach
		return Redirect::to('admin/vendors')->with('messages',"Xoa vendor thanh cong");
		
	}
	public function check_vendor(){
		return (Vendor::where("name",Input::get('name'))->count()==0? "true": "false");
	}
	public function edit_check_vendor($id){
		//return (Vendor::where("name",Input::get('name'))->count()==0&&Input::get('name')==Input::get('name_old'))? "true": "false";
		if(Input::get('name')==Vendor::where("id",$id)->get()->first()->name){
			return "true";
		}
		else{
			if(Vendor::where("name",Input::get('name'))->count()==0){
				return "true";
			}
			else return "false";
		} 
	}
	public function check_vendor_email(){
		return (User::where("email",Input::get('email'))->count()==0? "true": "false");

	}

	public function edit_check_vendor_email($id){
		if(Input::get('email')==Vendor::where("id",$id)->get()->first()->email){
			return "true";
		}
		else{
			if(Vendor::where("email",Input::get('email'))->count()==0){
				return "true";
			}
			else return "false";
		}
	}
	public function search(){
		$name=Input::get('search_name');
		$vendors=Vendor::where('name', 'LIKE', "%$name%")->get();
		return View::make('search_vendors')->with('vendors',$vendors);
	}


	// get images
	public static function getImagesVendor($image)
	{
		// $path = base_path().'/'.$image;
		$path = base_path('../'.$image);
		
		// Read image path, convert to base64 encoding
		$imageData = base64_encode(file_get_contents($path));

		// Format the image SRC:  data:{mime};base64,{data};
		$src = 'data: '.mime_content_type($path).';base64,'.$imageData;

		// Echo out a sample image
		echo '<img src="',$src,'">';

	}
	public function comment(){
		$vendors = Vendor::get();
		$comments = VendorComment::orderBy('created_at','DECS')->paginate(10);
		return View::make('comment')->with('comments',$comments)
									->with('vendors',$vendors);
	}
	public function detailComment($id_comment){
		$comment = VendorComment::where('id',$id_comment)->get()->first();
		return View::make('detail-comment')->with('comment',$comment);
	}
	public function ActiveComment(){
		$id_comment = Input::get('id_comment');
		$active = VendorComment::where('id',$id_comment)->get()->first()->active;
		if ($active == 1) {
			VendorComment::where('id',$id_comment)->update(array('active'=>0));
			return Response::json(array('active'=>0));
		} else {
			VendorComment::where('id',$id_comment)->update(array('active'=>1));
			return Response::json(array('active'=>1));
		}		
	}
	public function getComment(){
		$id_comment = Input::get('id_comment');
		$comment = VendorComment::where('id',$id_comment)->get()->first();
		$name_vendor = Vendor::where('id',$comment->vendor)->get()->first()->name;
		return Response::json(array('comment'=>$comment,'name_vendor'=>$name_vendor));
	}
	public function deleteComment(){
		$id_comment = Input::get('id_comment');
		VendorComment::where('id',$id_comment)->delete();
	}
	public function searchComment(){
		$vendors = Vendor::get();
		$id_vendor = Input::get('name_search');
		$comments = VendorComment::where('vendor',$id_vendor)->orderBy('created_at','DECS')->paginate(10);
		return View::make('comment')->with('comments',$comments)
									->with('vendors',$vendors);
	}

}
