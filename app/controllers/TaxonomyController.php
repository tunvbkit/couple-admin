<?php

class TaxonomyController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$taxonomies = Taxonomy::paginate(10);
		return View::make('taxonomy')->with('taxonomies', $taxonomies);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('create-taxonomy');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		$name 			= Input::get('NameCategory');
		$description 	= strip_tags(Input::get('editor4'));
		$rules 			= array(
							"NameCategory"=>"required|min:3",
							"editor4"=>"required|min:15"
							);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->passes()){
			$taxonomy = new Taxonomy();
			$taxonomy->name = $name;
			$taxonomy->description = $description;
			$taxonomy->slug = Str::slug($name);
			$taxonomy->save();
			return Redirect::to("admin/taxonomy")->with('message','Đã thêm thành công');
		}
		else
		{
			$errors=$validator->messages();
			return View::make('create-taxonomy')->with("errors",$errors);
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
		return View::make('edit-taxonomy')->with('taxonomy',Taxonomy::find($id));
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
			"NameCategory"=>"required|min:3",
			"editor4"=>"required|min:15"
			);
		$validator 			= Validator::make(Input::all(),$rules);
		$id 				= Input::get('IdCategory');
		$name 				= Input::get('NameCategory');
		$descreption 		= strip_tags(Input::get('editor4'));
		if($validator->passes()){
			Taxonomy::where('id',$id)->update(array('name' => $name,'description'=>$descreption,'slug'=>Str::slug($name)));
		return Redirect::to("admin/taxonomy")->with('message','Đã lưu thành công');
		}
		else
		{
			$taxonomy=Taxonomy::where("id","=",$id)->get()->first();
			$errors=$validator->messages();
			return View::make('edit-taxonomy')->with('taxonomy',$taxonomy)->with("errors",$errors);
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
		//
		$check=Article::where('taxonomy',$id)->get()->count();
		if($check>0)
		{		
			Article::where('taxonomy',$id)->delete();
			Taxonomy::find($id)->delete();
		}	
		else{
			Taxonomy::find($id)->delete();
		}
		
		return Redirect::to("admin/taxonomy")->with('message','Đã xoá thành công');
	}

	public function search(){
		$name = Input::get('search_name');
		$taxonomies = Taxonomy::where('name', 'LIKE', "%$name%")->paginate(10);
		return View::make('taxonomy')->with('taxonomies',$taxonomies);
	}

	public function article(){
		$articles = Article::paginate(10);
		return View::make('list-article')->with('articles',$articles);
	}
	public function createArticle(){
		return View::make('create-article');
	}
	public function storeArticle(){
		//
		$title 			= Input::get('NameCategory');
		$content 	= Input::get('editor4');
		$taxonomy = Input::get('taxonomy');
		$rules 			= array(
							"NameCategory"=>"required|min:3",
							"editor4"=>"required|min:15"
							);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->passes()){
			$article = new Article();
			$article->title = $title;
			$article->content = $content;
			$article->taxonomy = $taxonomy;
			$article->slug = Str::slug($title);
			$article->save();
			return Redirect::to("admin/article")->with('message','Đã thêm thành công');
		}
		else
		{
			$errors=$validator->messages();
			return View::make('create-article')->with("errors",$errors);
		}
	}
	public function searchArticle(){
		$name = Input::get('search_name');
		$articles = Article::where('title', 'LIKE', "%$name%")->paginate(10);
		return View::make('list-article')->with('articles',$articles);
	}
	public function editArticle($id){
		return View::make('edit-article')->with('article',Article::find($id));
	}
	public function updateArticle($id){
		$rules=array(
			"NameCategory"=>"required|min:3",
			"editor4"=>"required|min:15"
			);
		$validator 			= Validator::make(Input::all(),$rules);
		$id 				= Input::get('IdCategory');
		$title 				= Input::get('NameCategory');
		$content 		= Input::get('editor4');
		$taxonomy      	= Input::get('taxonomy');
		if($validator->passes()){
			Article::where('id',$id)->update(array('title' => $title,'content'=>$content,'taxonomy'=>$taxonomy,'slug'=>Str::slug($title)));
		return Redirect::to("admin/article")->with('message','Đã lưu thành công');
		}
		else
		{
			$taxonomy = Article::where("id","=",$id)->get()->first();
			$errors = $validator->messages();
			return View::make('edit-article')->with('article',$article)->with("errors",$errors);
		}
	}
	public function destroyArticle($id)
	{
		Article::find($id)->delete();		
		return Redirect::to("admin/article")->with('message','Đã xoá thành công');
	}

}
