<?php

class AuthorController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('pages.book.author');
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
		$author = new Author;
		$author->prefix = Input::get('prefix');
		$author->first_name = Input::get('first_name');
		$author->last_name = Input::get('last_name');
		$author->pseudonym = Input::get('pseudonym');
		$author->save();

		//return Response::json(array('name' =>Input::get('name')));
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
		$author = author::find($id);
		$author->name = Input::get('name');
		$author->prefix = Input::get('prefix');
		$author->first_name = Input::get('first_name');
		$author->last_name = Input::get('last_name');
		$author->pseudonym = Input::get('pseudonym');
		$author->save();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$author = author::find($id);
		Prod::where('author_id', '=', $id)->delete();
		$author->delete();
	}

}