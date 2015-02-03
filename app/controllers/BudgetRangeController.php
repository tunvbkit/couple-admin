<?php

class BudgetRangeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$results=BudgetRange::paginate(10);
		return View::make('range')->with('results',$results);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('add-range');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules=array(
			"min"=>"required",
			"max"=>"required"
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->passes())
		{
			$range= new BudgetRange();
			$range->min=Input::get('min');
			$range->max=Input::get('max');
			$range->save();
			return Redirect::route('range')->with('messages',"Thêm Range thành công");

		}
		else
		{
			$errors=$validator->messages();
			return View::make('add-range')->with('errors',$errors);
		}
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


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$range=BudgetRange::where("id",$id)->get()->first();
		return View::make('edit-range')->with("range",$range);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules=array(
			"min"=>"required",
			"max"=>"required"
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->passes())
		{
			$range=BudgetRange::find($id);
			$range->min=Input::get('min');
			$range->max=Input::get('max');
			$range->save();
			return Redirect::route('range')->with('messages',"Chỉnh sửa Range thành công");

		}
		else
		{
			$errors=$validator->messages();
			return View::make('edit-range')->with('errors',$errors);
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		BudgetRange::find($id)->delete();
		return Redirect::route('range')->with('messages',"Đã xóa thành công");
	}

	public function delete_ranges(){
		foreach(BudgetRange::get() as $range){
			if(Input::get('checkbox-'.$range->id)==$range->id){
				BudgetRange::find($range->id)->delete();
			}
		}
		return Redirect::route('range')->with('messages',"Xoa range thanh cong");
	}


}
