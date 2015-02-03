<?php

class TaskController extends \BaseController {

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
	public function addTask()
	{
		
			$task =new Task();
			$task->title=Input::get('title');
			$task->description=Input::get('description');
			$task->category=Input::get('category');
			$task->startdate=Input::get('startdate');
			$task->link=Input::get('link');
			$task->save();
			$task=Task::get();
			return Redirect::to('admin/task');
		
	}

	public function checkTitle()
	{
		return (Task::where("title",Input::get('title'))->count()==0? "true": "false");
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showTask()
	{
		$tasks=Task::where('id','>',0)->paginate(10);
		return View::make('task')->with('tasks',$tasks);
	}
	public function showAdd()
	{
		return View::make('add-task');
	}
	public function showEdit()
	{
		return View::make('edit-task');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editTask($id)
	{
		$task=Task::where("id","=",$id)->get()->first();
		return View::make('edit-task')->with("task",$task);
	}

	public function editCheckTask($id){		
		if(Input::get('title')==Task::where("id",$id)->get()->first()->title){
			return "true";
		}
		else{
			if(Task::where("title",Input::get('title'))->count()==0){
				return "true";
			}
			else return "false";
		} 
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateTask($id)
	{
		
			$id=Input::get('idTitle');
			$title = Input::get('title');
			$description=Input::get('description');
			$category=Input::get('category');
			$startdate=Input::get('startdate');
			$link=Input::get('link');
			$task=Task::where('id',$id)->update(array(
											'title' => $title,
											'description'=>$description,
											'category'=>$category,
											'startdate'=>$startdate,
											'link'=>$link
											));

			return Redirect::to("admin/task");
		
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function deleteTask($id)
	{
		Task::find($id)->delete();

		return Redirect::route("task");
	}

	public function delSelectTask(){
		$ids=array();
		foreach(Task::get() as $task){
			if(Input::get('chk-'.$task->id)==$task->id){
				$ids[]=Input::get('chk-'.$task->id);
			} //end if
		} //end foreach

		foreach ($ids as $id=>$key){
			foreach (Task::get() as $task){
				if($task->id==$key){
					Task::where("id", "=", $task->id)->delete();
				}
			} // end foreach
		} //end foreach
		
		$msg="Delete User Success!";
		return Redirect::route("task");
	} //end function
	public function searchTask()
	{
		$name=Input::get('search_name');
		$tasks=Task::where('title', 'LIKE', "%$name%")->paginate(5);
		return View::make('task')->with('tasks',$tasks);
	}
}
