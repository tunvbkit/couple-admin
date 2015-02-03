<?php

class CategoriesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('CategoryEdit')->with('category',Category::find($id));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	public function UpdateCategory(){
		$rules=array(
			"NameCategory"=>"required|min:3",
			"editor4"=>"required|min:15"
			);
		$validator 			= Validator::make(Input::all(),$rules);
		$id 				= Input::get('IdCategory');
		$name 				= Input::get('NameCategory');
		$descreption 		= strip_tags(Input::get('editor4'));
		if($validator->passes()){
			Category::where('id',$id)->update(array('name' => $name,'description'=>$descreption,'slug'=>Str::slug($name)));
		return Redirect::to("admin/categories")->with('message','Đã lưu thành công');
		}
		else
		{
			$category=Category::where("id","=",$id)->get()->first();
			$errors=$validator->messages();
			return View::make('CategoryEdit')->with('category',$category)->with("errors",$errors);
		}
		
	}
	public function ListCategory(){
		$results= Category::where('id',">",0)->paginate(10);
		return View::make('categories')->with("results",$results);
	}
	public function AddCategory(){
		return View::make('AddCategory');

	}
	public function NewCategory(){
		$name 			= Input::get('NameCategory');
		$description 	= strip_tags(Input::get('editor4'));
		$rules 			= array(
							"NameCategory"=>"required|min:3",
							"editor4"=>"required|min:15"
							);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->passes()){
		Category::insert(array('name' => $name,'description'=>$description,'slug'=>Str::slug($name)));
		return Redirect::to("admin/categories")->with('message','Đã thêm thành công');
		}
		else
		{
			$errors=$validator->messages();
			return View::make('AddCategory')->with("errors",$errors);
		}
	}
	public function DeleteCategory($id){
		$check=Vendor::where('category',$id)->get()->count();
		if($check>0)
		{
			$delete_vendors=Vendor::where('category',$id)->get();
			foreach ($delete_vendors as $delete_vendor) 
			{
				$id_vendor=$delete_vendor->id;
				ImageSlideController::deleteImageVendorLocation($id_vendor);
			}		
			
			VendorController::deleteVendorCategory($id);		
			Category::find($id)->delete();
		}	
		else{
			Category::find($id)->delete();
		}
		
		return Redirect::to("admin/categories")->with('message','Đã xoá thành công');
	}
	public function check_Categories(){
		return (Category::where("name",Input::get('NameCategory'))->count()==0? "true": "false");
	}
	public function dels_category(){
		foreach(Category::get() as $category){
			if(Input::get('chk-'.$category->id)==$category->id)
			{
				$check=Vendor::where('category',$category->id)->get()->count();
				if($check>0)
				{
					$delete_vendors=Vendor::where('category',$category->id)->get();
					foreach ($delete_vendors as $delete_vendor) 
					{
						$id_vendor=$delete_vendor->id;
						ImageSlideController::deleteImageVendorLocation($id_vendor);
					}		
					
					VendorController::deleteVendorCategory($category->id);		
					Category::find($category->id)->delete();
				}	
				else
				{
					Category::find($category->id)->delete();
				}
			}
		}

		
		
		$msg="Delete Categry Success!";
		return Redirect::route("categories")->with('message',$msg);
	} //end function

	public function updateCate1()
	{	
		$id=Input::get('id');
		$range1=Input::get('range1');
		$category=Category::find($id);
		$category->range1=$range1;
		$category->save();
	}
	public function updateCate2()
	{	
		$id=Input::get('id');
		$range2=Input::get('range2');
		$category=Category::find($id);
		$category->range2=$range2;
		$category->save();
	}
	public function updateCate3()
	{	
		$id=Input::get('id');
		$range3=Input::get('range3');
		$category=Category::find($id);
		$category->range3=$range3;
		$category->save();
	}
	public function updateCate4()
	{	
		$id=Input::get('id');
		$range4=Input::get('range4');
		$category=Category::find($id);
		$category->range4=$range4;
		$category->save();
	}
	public function updateCate5()
	{	
		$id=Input::get('id');
		$range5=Input::get('range5');
		$category=Category::find($id);
		$category->range5=$range5;
		$category->save();
	}
	public function search(){
		$name=Input::get('search_name');
		$category=Category::where('name', 'LIKE', "%$name%")->get();
		return View::make('search_categories')->with('results',$category);
	}

	}