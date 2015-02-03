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
		PhotoSlide::where('vendor',$id)->delete();
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
		
		$files=Input::file('bigpic_upload');	
		foreach ($files as $file) {
			$photoslide=new PhotoSlide();
			$photoslide->vendor=Input::get('vendor');
			$photoslide->bigpic=Image::make($file->getRealPath())->resize(700, 450)->encode('jpg',80);
			$photoslide->smallpic=Image::make($file->getRealPath())->resize(80,80)->encode('jpg',80);
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
		$id=Input::get('id_image');
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
