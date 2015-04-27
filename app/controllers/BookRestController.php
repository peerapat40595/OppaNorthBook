<?php

class BookRestController extends \BaseController {

	public function getData($search=null,$cat=null)
	{
		$search = Input::get('search');
		$cat = Input::get('category_id');
		$books = Book::with('SubCategory')
		->with('category')
		->with('author')
		->with('translator')
		->with('tag')
		->with('supplier')
		->orderBy('title','desc');

		if($cat)
		{
			$books = $books->where('category_id','=',$cat);
		}
		if($search)
		{
			$books = $books->where('title', 'LIKE', '%'.$search.'%');
		}

		return $books->paginate(15)->toJson();

		// if (Input::has('category_id')) {
		// 	$cat_id = Input::get('category_id');
		// 	if(!$search){
		// 		$books = Book::where('category_id','=',$cat_id)
		// 			->orderBy('title','desc')
		// 			->paginate($limit = 15)
		// 			->toJson();
		// 			return $books;
		// 		}else{
		// 			$books = Book::where('title', 'LIKE', '%'.$search.'%')
		// 			->where('category_id','=',$cat_id)
		// 			->orderBy('title','desc')
		// 			->paginate(15)
		// 			->toJson();
		// 			return $books;
		// 		}
		// 	} else{

		// 		if(!$search){
		// 			$books = Book::orderBy('category_id','desc')
		// 			->orderBy('title','desc')
		// 			->paginate($limit = 15)
		// 			->toJson();
		// 			return $books;
		// 		}else{
		// 			$books = Book::where('title', 'LIKE', '%'.$search.'%')
		// 			->orderBy('title','desc')
		// 			->paginate(15)
		// 			->toJson();
		// 			return $books;
		// 		}
		// 	}



		}



		public function getTag()
		{
			$tags = Tag::All()->toJson();
			return $tags;

		}

		public function getCategory()
		{
			$categories = Category::All()->toJson();
			return $categories;
		}
		public function getSubCategory()
		{
			$sub_categories = SubCategory::All()->toJson();
			return $sub_categories;
		}
		public function getAuthor()
		{
			$tags = Author::All()->toJson();
			return $tags;

		}
		public function getTranslator()
		{
			$tags = Author::All()->toJson();
			return $tags;

		}


	}