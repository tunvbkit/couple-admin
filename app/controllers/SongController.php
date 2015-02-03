<?php

class SongController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// return view songs
		$songs = Song::orderBy('id','DESC')->paginate(10);
		return View::make('songs')->with('songs', $songs);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//create song
		$name 		= Input::get('name');
		$category 	= Input::get('category');
		$artist 	= Input::get('artist');
		$genre 		= Input::get('genre');
		$link 		= Input::get('link');
		$lyric 		= Input::get('lyric');

		switch ($genre) {
			case 1:
				$genre="Pop";
				break;
			case 2:
				$genre="Dance";
				break;
			case 3:
				$genre="Pop, Dance";
				break;
			case 4:
				$genre="Rock";
				break;
			case 5:
				$genre="Balance";
				break;
			
			default:
				$genre="Pop";
				break;
		}

		// insert to table song
		$songs=new Song();
		$songs->name=$name;
		$songs->category=$category;
		$songs->artist=$artist;
		$songs->genre=$genre;
		$songs->link=$link;
		$songs->lyric=$lyric;
		$songs->slug=Str::slug($name);
		$songs->save();

		$msg = Lang::get('messages.create_success');
		$songs = Song::orderBy('id','DESC')->paginate(10);
		return View::make('songs')->with('songs', $songs)->with('msg', $msg);

	}
	// check song name is unique
	public function check_song_name()
	{
		$name=Input::get('name');

		if(Song::where("name", "=", $name)->count()>0){
			return "false";
		}
		else{return "true";}
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
		// edit song
		$song = Song::where('id', $id)->get();
		return View::make('song_edit')->with('song',$song);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	// check song name is unique
	public function check_song_name_edit($id)
	{
		$name=Input::get('name');
		if($name==Song::where("id",$id)->get()->first()->name){
			return "true";
		}
		else{
			if(Song::where("id",$id)->count()>0){
			return "false";
			}else{return "true";}
		}
	}

	public function update()
	{
		// update song
		$id=Input::get('id');
		$name=Input::get('name');
		$category=Input::get('category');
		$artist=Input::get('artist');
		$genre=Input::get('genre');
		$link=Input::get('link');
		$lyric=Input::get('lyric');

		$song=Song::where('id',$id)->update(
									array('name'=>$name,
										'category'=>$category,
										'artist'=>$artist,
										'genre'=>$genre,
										'link'=>$link,
										'slug'=>Str::slug($name),
										'lyric'=>$lyric)
									);

		$msg = Lang::get('messages.update_success');
		$songs = Song::orderBy('id','DESC')->paginate(10);
		return View::make('songs')->with('songs', $songs)->with('msg', $msg);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// delete song
		Song::where('id',$id)->delete();

		$msg = Lang::get('messages.delete_success');
		$songs = Song::orderBy('id','DESC')->paginate(10);
		return View::make('songs')->with('songs', $songs)->with('msg', $msg);
	}

	// delete many song
	public function destroyMany()
	{
		// delete song
		$ids=array();
		foreach(Song::get() as $song){
			if(Input::get('chk-'.$song->id)==$song->id){
				$ids[]=Input::get('chk-'.$song->id);
			} //end if
		} //end foreach

		foreach ($ids as $id=>$key){
			foreach (Song::get() as $song){
				if($song->id==$key){
					Song::where("id", "=", $song->id)->delete();
				}
			} // end foreach
		} //end foreach

		$msg = Lang::get('messages.delete_success');
		return Redirect::route("songs")->with('msg',$msg);
	}

	// display comment of songs
	public function comments()
	{

		$song_comments = SongComment::orderBy('id','DESC')->paginate(10);
		return View::make('song_comments')->with('song_comments', $song_comments);
	}
	// delete comment of songs
	public function commentsDelete()
	{

		$ids=array();
		foreach(SongComment::get() as $song_cmt){
			if(Input::get('chk-'.$song_cmt->id)==$song_cmt->id){
				$ids[]=Input::get('chk-'.$song_cmt->id);
			} //end if
		} //end foreach

		foreach ($ids as $id=>$key){
			foreach (SongComment::get() as $song_cmt){
				if($song_cmt->id==$key){
					SongComment::where("id", "=", $song_cmt->id)->delete();
				}
			} // end foreach
		} //end foreach
		
		$msg = Lang::get('messages.delete_success');
		$song_comments = SongComment::orderBy('id','DESC')->paginate(10);
		return View::make('song_comments')->with('song_comments', $song_comments)->with('msg',$msg);
	}
	public function search(){
		$name=Input::get('search_name');
		$songs=Song::where('name', 'LIKE', "%$name%")->get();
		return View::make('search_song')->with('songs',$songs);
	}

}
