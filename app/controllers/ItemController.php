<?php

class ItemController extends \BaseController {

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
	public function addItem()
	{

		$id=Input::get('id');
		$count=Budget::where('category',$id)->get()->count();
		if ($count) {
			$item_last=Budget::where('category',$id)->get()->last()->id;

		} else {
			$item_last=0;
               
		}
		//$item_last=Budget::where('category',$id)->get()->last();
		$budget=new Budget();
		$budget->item="New Item";
		$budget->category=$id;
		$budget->range1="0";
		$budget->range2="0";
		$budget->range3="0";
		$budget->range4="0";
		$budget->range5="0";
		$budget->save(); 
		$item=Budget::where('category',$id)->get()->last();
		$html = '';
		$html .= '<tr class="budget_item_cat'.$item->id.' budget_item_cat">
            <td>
            <input type="hidden" value="'.$item->id.'">
            </td>
            <td>
                <div>
                    <a  onclick="cl('.$item->id.')" class="'.$item->id.'_show_hide ">'.$item->item.'</a>
                    <input onchange="v_fChange('.$item->id.')" ondblclick="db('.$item->id.')"type="text" style="width:150px;display:none;" class="'.$item->id.'_slidingDiv" name="item" value="'.$budget->item.'">
                    <input type="hidden" name="'.$item->id.'" value="'.$item->id.'">
                    <p class="'.$item->id.'_mgss_item_1"style="display:none;color:red;">Must Enter Item!</p>
                 </div>
                 
            </td>
            <td>
                <div>
                    <a onclick="cl1('.$item->id.')" class="'.$item->id.'_show_hide1 ">'.$budget->range1.'</a><span class="'.$item->id.'_percent_item_show_hide1">%</span>                                                                                                                          
                    <input onkeyup="key_item_range1(event,'.$item->id.')" onchange="v_fChange1('.$item->id.')" ondblclick="db1('.$item->id.')"type="text" style="width:150px;display:none;" class="'.$item->id.'_slidingDiv1" name="range1" value="'.$budget->range1.'">
                    <input type="hidden" name="'.$item->id.'" value="'.$item->id.'">
                    <p class="'.$item->id.'_mgss_item_2"style="display:none;color:red;">Must Enter Range1!</p>
                 </div>
            </td>
            <td>
                <div>
                    <a onclick="cl2('.$item->id.')" class="'.$item->id.'_show_hide2 ">'.$budget->range2.'</a><span class="'.$item->id.'_percent_item_show_hide2">%</span>                                                                                                                           
                   <input onkeyup="key_item_range2(event,'.$item->id.')" onchange="v_fChange2('.$item->id.')" ondblclick="db2('.$item->id.')" type="text" style="width:150px;display:none;" class="'.$item->id.'_slidingDiv2" name="range2" value="'.$budget->range2.'">
                   <input type="hidden" name="'.$item->id.'" value="'.$item->id.'">  
                   <p class="'.$item->id.'_mgss_item_3"style="display:none;color:red;">Must Enter Range2!</p>
                 </div>

            </td>
            <td>
                <div>
                    <a onclick="cl3('.$item->id.')" class="'.$item->id.'_show_hide3 ">'.$budget->range3.'</a><span class="'.$item->id.'_percent_item_show_hide3">%</span>                                                                                  
                    <input onkeyup="key_item_range3(event,'.$item->id.')" onchange="v_fChange3('.$item->id.')" ondblclick="db3('.$item->id.')" type="text" style="width:150px;display:none;" class="'.$item->id.'_slidingDiv3" name="range3" value="'.$budget->range3.'">
                    <input type="hidden" name="'.$item->id.'" value="'.$item->id.'">
                    <p class="'.$item->id.'_mgss_item_4"style="display:none;color:red;">Must Enter Range3!</p>
                 </div>
            </td>
            <td>
                <div>
                    <a onclick="cl4('.$item->id.')" class="'.$item->id.'_show_hide4 ">'.$budget->range4.'</a><span class="'.$item->id.'_percent_item_show_hide4">%</span>                                                                                  
                    <input onkeyup="key_item_range4(event,'.$item->id.')" onchange="v_fChange4('.$item->id.')" ondblclick="db4('.$item->id.')" type="text" style="width:150px;display:none;" class="'.$item->id.'_slidingDiv4" name="range4" value="'.$budget->range4.'">
                    <input type="hidden" name="'.$item->id.'" value="'.$item->id.'">
                    <p class="'.$item->id.'_mgss_item_5"style="display:none;color:red;">Must Enter Range4!</p>
                 </div>
            </td>
            <td>
                <div>
                    <a onclick="cl5('.$item->id.')" class="'.$item->id.'_show_hide5 ">'.$budget->range5.'</a><span class="'.$item->id.'_percent_item_show_hide5">%</span>                                                                                  
                    <input onkeyup="key_item_range5(event,'.$item->id.')" onchange="v_fChange5('.$item->id.')" ondblclick="db5('.$item->id.')" type="text" style="width:150px;display:none;" class="'.$item->id.'_slidingDiv5" name="range5" value="'.$budget->range5.'">
                    <input type="hidden" value="'.$item->id.'">
                    <p class="'.$item->id.'_mgss_item_6"style="display:none;color:red;">Must Enter Range5!</p>
                 </div>
            </td>

			<td>
            
                <a onclick="deleteItem('.$item->id.')" class="budget_icon_trash" class="confirm" id="delete-item'.$item->id.'" href="javascript:void(0)"><i class="glyphicon glyphicon-trash"></i></a>
                <input type="hidden" class="deleteItem'.$item->id.'" name="'.$budget->id.'" value="'.$item->id.'">
            </td>
		</tr>';
		echo json_encode(array('catid'=>$item->category,'item_last'=>$item_last,'html'=>$html));
		exit();
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		$budget=Budget::where('id','>',0)->get();
		return View::make('item')->with('budget',$budget);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateItem()
	{	
		$id=Input::get('id');
		$item=Input::get('item');
		$budget=Budget::find($id);
		$budget->item=$item;
		$budget->save();
	}
	public function updateRange1()
	{
		$id=Input::get('id');
		$range1=Input::get('range1');
		$budget=Budget::find($id);
		$budget->range1=$range1;
		$budget->save();
		$range1_out=Budget::find($id)->range1;
		echo json_encode(array('range1_out'=>$range1_out));
		exit();
	}
	public function updateRange2()
	{
		$id=Input::get('id');
		$range2=Input::get('range2');
		$budget=Budget::find($id);
		$budget->range2=$range2;
		$budget->save();
	}
	public function updateRange3()
	{
		$id=Input::get('id');
		$range3=Input::get('range3');
		$budget=Budget::find($id);
		$budget->range3=$range3;
		$budget->save();
	}

	public function updateRange4()
	{
		$id=Input::get('id');
		$range4=Input::get('range4');
		$budget=Budget::find($id);
		$budget->range4=$range4;
		$budget->save();
	}

	public function updateRange5()
	{
		$id=Input::get('id');
		$range5=Input::get('range5');
		$budget=Budget::find($id);
		$budget->range5=$range5;
		$budget->save();
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function deleteItem()
	{	
		$id=Input::get('id');
		Budget::find($id)->delete();
		
	}


}
