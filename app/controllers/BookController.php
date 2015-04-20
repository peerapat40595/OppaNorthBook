<?php

class bookController extends BaseController {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
	}
	public function index()
	{
		$books = Book::All();	
		$category_all = Category::All();
		return View::make('pages.book.index',array( 'books'=> $books,  'category_all' => $category_all ) );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$category_all = Category::All();
		return View::make('pages.book.create',array(  'category_all' => $category_all ) );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
		$validator = Validator::make(Input::all(), Book::$rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('book/create')
			->withErrors($validator)
			->withInput();
		} else {
			// store
			$book = new Book;
			$book->name          = Input::get('name');
			$book->price         = Input::get('price');
			$book->brand_id      = Input::get('brand');
			$book->category_id   = Input::get('category');


			if(Input::hasFile('book_pic')){

				$image = Input::file('book_pic');
				$filename = date('Y-m-d-H-i-s')."-".$image->getClientOriginalName();
				Image::make($image->getRealPath())->save(public_path().'/img/books/'.$filename);
				$book->book_pic = 'img/books/'.$filename;

			}else if (Input::has('book_pic')) {
				$book->book_pic = Input::get('book_pic');
			}
			$book->description   = Input::get('description');
			$book->save();
			//waiting for edit

			
			for ($i=0; Input::has('type_'.$i); $i++) { 
				for ($j=0; Input::has('att_'.$i.$j); $j++) { 
					$att = new Attribute;
					$att->name = Input::get('att_'.$i.$j);
					$att->type = Input::get('type_'.$i);
					$att->book_id = $book->id;
					$att->save();
				}
			}




			Session::flash('message', 'Successfully created book!');
			return Redirect::to('book/create');
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{	Attribute::unguard();
		$book = Book::find($id);
		$temp = Attribute::where('book_id', '=', $id)
		->get()
		->toJson();

		$temp = json_decode($temp);
		$atts = array();
		foreach ($temp as $value) {
			$index = count($atts);
			for ($i=0; $i <count($atts) ; $i++) { 
				if($value->type == $atts[$i]['name']) {
					$index = $i;
					break;
				}
			}

			if($index == count($atts)) $atts[] = array('name' => $value->type, 'data' => array( $value->name) );
			else $atts[$index]['data'][] = $value->name;

		}

		return View::make('pages.book.show')
		->with(array('book'=> $book, 'atts'=>$atts ));

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$book = Book::find($id);

		$brand_all = Brand::All();
		$category_all = Category::All();


		$temp = Attribute::where('book_id', '=', $id)
		->get()
		->toJson();

		$temp = json_decode($temp);
		$atts = array();
		foreach ($temp as $value) {
			$index = count($atts);
			for ($i=0; $i <count($atts) ; $i++) { 
				if($value->type == $atts[$i]['name']) {
					$index = $i;
					break;
				}
			}

			if($index == count($atts)) $atts[] = array('name' => $value->type, 'data' => array( $value->name) );
			else $atts[$index]['data'][] = $value->name;

		}

		// var_dump(json_encode($atts));
		return View::make('pages.book.edit',array( 'book'=> $book, 'brand_all' => $brand_all, 'category_all' => $category_all, 'atts' => $atts ) );

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
		$validator = Validator::make(Input::all(), Book::$rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('book/create')
			->withErrors($validator)
			->withInput();
		} else {
			// store
			$book = Book::find($id);
			$book->name          = Input::get('name');
			$book->price         = Input::get('price');
			$book->brand_id      = Input::get('brand');
			$book->category_id   = Input::get('category');
			
			
			
			if(Input::hasFile('book_pic')){

				$image = Input::file('book_pic');
				$filename = date('Y-m-d-H-i-s')."-".$image->getClientOriginalName();
				Image::make($image->getRealPath())->save(public_path().'/img/books/'.$filename);
				$book->book_pic = 'img/books/'.$filename;

			}else if (Input::has('book_pic')) {
				if(File::exists(public_path().$book->book_pic))
					File::delete(public_path().$book->image);
				$book->book_pic = Input::get('book_pic');
			}

			$book->description   = Input::get('description');
			$book->save();

			Attribute::where('book_id','=',$id)->delete();
			
			for ($i=0; Input::has('type_'.$i); $i++) { 
				for ($j=0; Input::has('att_'.$i.$j); $j++) { 
					$att = new Attribute;
					$att->name = Input::get('att_'.$i.$j);
					$att->type = Input::get('type_'.$i);
					$att->book_id = $book->id;
					$att->save();
				}
			}


			// redirect
			Session::flash('message', 'Successfully update book!');
			return Redirect::to('book');
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
		$book = Book::find($id);
		if ($book) {
			File::delete(public_path().$book->image);
			$book->delete();
			Session::flash('message', 'Successfully deleted the book!');
			return Redirect::to('book');
		}
		

		// redirect
		Session::flash('message', 'Something went wrong, please try again');
		return Redirect::to('book');
	}



	

}