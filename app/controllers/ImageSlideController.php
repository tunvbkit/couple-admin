<?php

class ImageSlideController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function post_upload()
	{
		
	}

	public static function deleteImageVendor($id)
	{	
		$name1 =	PhotoSlide::where('id',$id)->get()->first()->bigpic;
		$name2 =	PhotoSlide::where('id',$id)->get()->first()->smallpic;
		$path_delete1 = base_path('../'.$name1);
		$path_delete2 = base_path('../'.$name2);
		File::delete($path_delete1);
		File::delete($path_delete2);		
		PhotoSlide::where('id',$id)->delete();
	}
	public static function deleteImageVendorLocation($id_vendor)
	{
		PhotoSlide::where('vendor',$id_vendor)->delete();
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function post_addImage()
	{
		$year=date("Y");
		$month=date('m');
		File::makeDirectory(base_path('../images/slide/'.$year.'/'.$month),$mode = 0775,true,true);
		$files=Input::file('bigpic_upload');	
		foreach ($files as $file) {
			$filename1 =str_random(10) . '.' .$file->getClientOriginalExtension();
			$filename2 =str_random(10) . '.' .$file->getClientOriginalExtension();
			$path1 = base_path('../images/slide/'.$year.'/'.$month.'/'.$filename1);
			$path2 = base_path('../images/slide/'.$year.'/'.$month.'/'.$filename2);
			$pathsave1='images/slide/'.$year.'/'.$month.'/'.$filename1;
			$pathsave2='images/slide/'.$year.'/'.$month.'/'.$filename2;
			Image::make($file->getRealPath())->resize(700, 450)->save($path1);
			Image::make($file->getRealPath())->resize(80, 80)->save($path2);
			$photoslide=new PhotoSlide();
			$photoslide->vendor=Input::get('vendor');
			$photoslide->bigpic=$pathsave1;
			$photoslide->smallpic=$pathsave2;
			$photoslide->save();
		}
			
		return Redirect::route('imageslide');

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showImageSlide()
	{	
		$imageslides=PhotoSlide::where('id','>',0)->orderBy('vendor','ASC')->paginate(10);
		return View::make('imageslide')->with('imageslides',$imageslides);
	}
	public function showAdd()
	{
		return View::make('add-imageslide');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showUpdate()
	{
		return View::make('edit-imageslide');
	}
	public function edit($id)
	{
		$imageslide=PhotoSlide::where('id','=',$id)->get()->first();
		return View::make('edit-imageslide')->with('imageslide',$imageslide);
	}

	public function checkImageSlide()
	{
		$id_vendor=Input::get('id_vendor');
		$name_vendor=Vendor::where('id',$id_vendor)->get()->first()->name;

		$check=PhotoSlide::where("vendor",$id_vendor)->get()->count();
		echo json_encode(array('check'=>$check,'name_vendor'=>$name_vendor));
		exit;
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$photoslide=PhotoSlide::find($id);
		$photoslide->vendor=Input::get('vendor');
		if(Input::hasfile('bigpic_upload')) $photoslide->bigpic=Image::make(Input::file('bigpic_upload')->getRealPath())->resize(700, 450)->encode('jpg',80);
		$photoslide->smallpic=Image::make(Input::file('bigpic_upload')->getRealPath())->resize(80,80)->encode('jpg',80);
		$photoslide->save();

		return Redirect::route('imageslide');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function sentIdImage()
	{
		$id_image=Input::get('id_image');
		$id_vendor=PhotoSlide::where('id',$id_image)->get()->first()->vendor;
		$name_vendor=Vendor::where('id',$id_vendor)->get()->first()->name;
		$number_image=Input::get('number_image');
		echo json_encode(array('name_vendor'=>$name_vendor, 'number_image'=>$number_image));
		exit;
	}
	public function delete()
	{	
		$id = Input::get('id_image');
		$name1 =	PhotoSlide::where('id',$id)->get()->first()->bigpic;
		$name2 =	PhotoSlide::where('id',$id)->get()->first()->smallpic;
		$path_delete1 = base_path('../'.$name1);
		$path_delete2 = base_path('../'.$name2);
		File::delete($path_delete1);
		File::delete($path_delete2);
		PhotoSlide::find($id)->delete();
		echo json_encode(array('id'=>$id));
		exit;
		
	}
	public function delSelectImages()
	{
		$ids=array();
		foreach(PhotoSlide::get() as $imageslide){
			if(Input::get('chk-'.$imageslide->id)==$imageslide->id){
				$ids[]=Input::get('chk-'.$imageslide->id);
			} //end if
		} //end foreach

		foreach ($ids as $id=>$key){
			foreach (PhotoSlide::get() as $imageslide){
				if($imageslide->id==$key){
					$name1 = PhotoSlide::where('id',$imageslide->id)->get()->first()->bigpic;
					$name2 = PhotoSlide::where('id',$imageslide->id)->get()->first()->smallpic;
					$path_delete1 = base_path('../'.$name1);
					$path_delete2 = base_path('../'.$name2);
					File::delete($path_delete1);
					File::delete($path_delete2);
					PhotoSlide::where("id", "=", $imageslide->id)->delete();
				}
			} // end foreach
		} //end foreach
		
		$msg="Delete User Success!";
		return Redirect::route("imageslide");
	}
	public function search(){
		$name=Input::get('search_name');
		$counts=Vendor::where('name', 'LIKE', "%$name%")->get()->count();
		if($counts>0)
		{
			$vendors=Vendor::where('name', 'LIKE', "%$name%")->get();		
			foreach ($vendors as $vendor) 
			{
				$id_vendors[]=$vendor->id;
			}
		
			$imageslides=PhotoSlide::whereIn('vendor',$id_vendors)->get();
			return View::make('search_image')->with('imageslides',$imageslides);
		}
		else
		{
			return View::make('search_image');
		}
		
	
				
		
	}

}
