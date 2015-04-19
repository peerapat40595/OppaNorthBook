<?php

class PostController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = Post::orderBy('created_at', 'DESC')->paginate(10);
		$posts->setBaseUrl('posts');
        return View::make('posts.index')->with('posts', $posts);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('posts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// $post = new Post;
		// $post->title = Input::get('title');
		// $post->body = Input::get('body');
		// $post->m_keyw = Input::get('m_keyw');
		// $post->m_desc = Input::get('m_desc');
		// $post->slug = Str::slug(Input::get('title'));
		// $post->save();

		// if($post->id){
		// 		return Redirect::route('posts.index');
		// }else{

		// 	     $error = $user->errors()->all(':message');

  //                return Redirect::action('PostController@create')
  //               ->withInput(Input::all())
  //               ->with( 'error', $error );
		// }

		$input = Input::all();
		$rules = array(
	    	'title' => 'required|unique:posts',
	    	'body' => 'required'
	    );

		$validator = Validator::make($input,$rules);

		if ($validator->fails())
		{
    		// The given data did not pass validation
                 return Redirect::action('PostController@create')
                ->withInput(Input::all())
                ->withErrors($validator);

		}else{
				$post = new Post;
				$post->title = Input::get('title');
				$post->body = Input::get('body');
				$post->m_keyw = Input::get('m_keyw');
				$post->m_desc = Input::get('m_desc');
				$post->slug = Str::slug(Input::get('title'));
				$post->save();

				return Redirect::route('posts.index');
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
		$post = Post::find($id);

		$date = $post->created_at;
		//setlocale(LC_TIME, 'America/New_York');
		$date = $date->formatlocalized('%A %d %B %Y');

        return View::make('posts.show')->with('post', $post)->with('date', $date);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$post = Post::find($id);

		if(is_null($post))
		{
			return Redirect::route('posts.index');
		}

        return View::make('posts.edit')->with('post', $post);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// $input = array_except(Input::all(),'_method');
		// Post::find($id)->update($input);
		// return Redirect::route('posts.index');

		$input = array_except(Input::all(),'_method');
		$rules = array(
	    	'title' => 'required',
	    	'body' => 'required'
	    );

		$validator = Validator::make($input,$rules);

		if ($validator->fails())
		{
    		// The given data did not pass validation
                //  return Redirect::action('PostController@create')
                // ->withInput(Input::all())
                // ->withErrors($validator);

                return Redirect::route('posts.index')->withErrors($validator);;

		}else{
				Post::find($id)->update($input);
				return Redirect::route('posts.index');
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
		Post::find($id)->delete();

		return Redirect::route('posts.index');
	}

}