<?php

class TranslatorController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('pages.book.translator');
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
		$translator = new Translator;
		$translator->prefix = Input::get('prefix');
		$translator->first_name = Input::get('first_name');
		$translator->last_name = Input::get('last_name');
		$translator->pseudonym = Input::get('pseudonym');
		$translator->save();

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
		$translator = translator::find($id);
		$translator->name = Input::get('name');
		$translator->prefix = Input::get('prefix');
		$translator->first_name = Input::get('first_name');
		$translator->last_name = Input::get('last_name');
		$translator->pseudonym = Input::get('pseudonym');
		$translator->save();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$translator = translator::find($id);
		Prod::where('translator_id', '=', $id)->delete();
		$translator->delete();
	}

}