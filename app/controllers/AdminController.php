<?php

class AdminController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('main');
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
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
	public function get_login()
	{
		return View::make("login");
	}
	public function post_login()
	{

	($remember=Input::has('remember')) ? true: false;
		$auth=Auth::attempt(array(
				"email"=> Input::get('inputEmail'),
				"password"=> Input::get('inputPassword'),
				"role_id"=> 1
				),$remember);
		if($auth)
		{
			Session::put("admin",Input::get('inputEmail'));
			return Redirect::to("admin/main");
		}	 
		
		else return View::make('login')->with("messages","Tên tài khoản hay mật khẩu không đúng hoặc bạn ko phải là admin");	
	}
	public function get_logout()
	{
		Session::forget('admin');
		return Redirect::route("login");
	}
	public function search(){
		$name=Input::get('name');
		$vendors=Vendor::where('name', 'LIKE', "%$name%")->get();
		return View::make('vendors')->with('vendors',$vendors);
	}


	// Giang ----User
	public function get_users()
	{	
		$count_user_day = 0;
		$msg = Session::get('msg');
		$users = User::orderBy('created_at', 'desc')->paginate(10);
		$day_now = Carbon::today()->toDateString();
		$arr_users = User::get();
		$count_user = $arr_users->count();
		foreach ($arr_users as $arr_user) {
			$tamp = explode(" ",$arr_user->created_at);
			if ( $day_now == $tamp[0] ) {
			 	$count_user_day = $count_user_day + 1;
			 } 
		}	
		return View::make("users")->with("users", $users)->with('msg',$msg)
														->with('count_user',$count_user)
														->with('count_user_day',$count_user_day);
	}

	public function check_email(){
		$email=Input::get('email');

		if(User::where("email", "=", $email)->count()>0){
			return "false";
		}
		else{return "true";}
	}

	public function check_email_edit($id){
		$email=Input::get('email');
		if($email==User::where("id",$id)->get()->first()->email){
			return "true";
		}
		else{
			if(User::where("email", "=", $email)->count()>0){
			return "false";
			}
			else{return "true";}
		} 
	}
	// ---search user
	public function postSearchUser(){
		$keyword=Input::get('key');


		if(empty($keyword)){
			$users = User::paginate(10);
			return View::make("users")->with("users", $users);
		}
		else{
			$users = User::where('email', 'LIKE', '%'.$keyword.'%')->paginate(8);
			return View::make("users")->with("users", $users);
		}
	}

	// ----creat user
	public function post_users(){
		$rules=array(
			"email"=>"required|email",
			"password"=>"required|min:3",
			"password_confirm"=>"required|min:3",
			"role"=>"required"
			);

		if(!Validator::make(Input::all(), $rules)->fails()){

			$avatar_default = User::where('role_id',1)->get()->first()->avatar;

			$user=new User();
			$user->firstname=Input::get('firstname');
			$user->lastname=Input::get('lastname');
			$user->email=Input::get('email');
			$user->avatar=$avatar_default;
			$user->password=Hash::make(Input::get('password_confirm'));
			$user->weddingdate=Input::get('weddingdate');
			$user->role_id=Input::get('role');
			$user->save();
			
			$msg="Creat User Success!";
			return Redirect::route("users")->with('msg',$msg);
		}else{
			$msg="Creat User Fails!";
			return Redirect::route("users")->with('msg',$msg);
		}
	}

	// ---delete user
	public function del_users($id){
		try {
			if(WeddingWebsite::where('user',$id)->get()->count() > 0){
			$idWeb = WeddingWebsite::where('user',$id)->get()->first()->id;
			TabWebsite::where('website',$idWeb)->delete();
		}
		
		WeddingWebsite::where('user',$id)->delete();
		Groups::where('user',$id)->delete();
		Guests::where('user',$id)->delete();
		PhotoTab::where('user',$id)->delete();
		Rating::where('user',$id)->delete();
		SongComment::where('user',$id)->delete();
		UserBudget::where('user',$id)->delete();
		UserTask::where('user',$id)->delete();
		VendorComment::where('user',$id)->delete();

		User::where("id", "=", $id)->delete();
		// Session::flush();

		$msg="Delete User Success!";
		return Redirect::route("users")->with('msg',$msg);
		} catch (Exception $e) {
			echo "Lỗi xoá các bảng";
		}
		
	}
	public function dels(){
		$ids=array();
		foreach(User::get() as $user){
			if(Input::get('chk-'.$user->id)==$user->id){
				$ids[]=Input::get('chk-'.$user->id);
			} //end if
		} //end foreach

		foreach ($ids as $id=>$key){
			foreach (User::get() as $user){
				if($user->id==$key){
					User::where("id", "=", $user->id)->delete();
					// Session::flush();
				}
			} // end foreach
		} //end foreach
		
		$msg="Delete User Success!";
		return Redirect::route("users")->with('msg',$msg);
	} //end function

	// ---- edit user
	public function get_edit_users($id){
		$users = User::where("id", "=", $id)->paginate(10);
		return View::make("users_edit")->with("users", $users);
	}
	public function post_edit_users($id){
		// $rules=array(
		// 	"password_old"=>"required|min:3",
		// 	"password_new"=>"required|min:3"
		// 	);

		$email = Input::get('email');
		$role_id = Input::get('role');
		$weddingdate = Input::get('weddingdate');
		$firstname = Input::get('firstname');
		$lastname = Input::get('lastname');
		$password = Hash::make(Input::get('password'));
		// $password_old=Input::get('password_old');
		// $password_new=Hash::make(Input::get('password_new'));

		$pass=User::where('id', "=", $id)->get()->first()->password;

		// if (Hash::check($password_old, $pass)) {
		    $user=User::where("id", "=", $id)->update(
				array("email"=>$email,
					"role_id"=>$role_id,
					"weddingdate"=>$weddingdate,
					"firstname"=>$firstname,
					"lastname"=>$lastname,
		    		"password"=>$password));
					// "password"=>$password_new));

		    $msg="Edit User Success!";
			return Redirect::route("users")->with('msg',$msg);
		// }
		// else{
		// 	$msg="Edit User Fails!";
		// 	return Redirect::route("users")->with('msg',$msg);
		// }
	}


}
