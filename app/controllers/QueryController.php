<?php

class QueryController extends \BaseController {

	public function getKK()
	{
		$books = Book::with('category')->get();
		foreach($books as $book)
		{
			$category = Category::where('name','=',$book->category->name)->first();
			if($book->category_id != $category->id)
			{
				$book->category->delete();
				$book->category_id = $category->id;
				$book->save();
			}			
		}
	}
	public  function getNewBook()
	{

		$query = DB::table('books')->orderBy('id','desc')->take(10)->get();
		return $query;
	}
	public function getTTT()
	{
		$query = DB::table('order_has_book')
			->join('orders','orders.id','=','order_has_book.order_id')
			
			->selectRaw('user_id , sum(total_cost) as  grand_cost')
			->groupBy('user_id')
			->orderBy('grand_cost','desc')
			->get();
return $query;
	}


	public function getBestBookAmount()
	{
		$books = DB::table('order_has_book')
		->join('orders','orders.id','=','order_has_book.order_id')
		->join('books','books.id','=','order_has_book.book_id')
		->where('status','>=','5')
			->selectRaw('book_id,title,sell_price,cover_pic , sum(amount) as  grand_amount')

			->groupBy('book_id')
			->orderBy('grand_amount','desc')
			->take(10)
			->get();
		return View::make('pages.analytic.BestBookAmount',array( 'books'=> $books ) );
		}
	public function getBestBookIncome()
	{

		$books = DB::table('order_has_book')
		->join('orders','orders.id','=','order_has_book.order_id')
		->join('books','books.id','=','order_has_book.book_id')
		->where('status','>=','5')
			->selectRaw('book_id,title,sell_price,cover_pic , sum(total_cost) as  grand_cost, sum(amount) as  grand_amount')

			->groupBy('book_id')
			->orderBy('grand_cost','desc')
			->take(10)
			->get();
		return View::make('pages.analytic.BestBookIncome',array( 'books'=> $books ) );
		}
		
	public function getBestPublisherIncome()
	{
		$books = DB::table('order_has_book')
		->join('orders','orders.id','=','order_has_book.order_id')
		->where('status','>=','5')
			->join('books','books.id','=','order_has_book.book_id')

			->selectRaw('publisher_name , sum(total_cost) as  grand_cost')
			->groupBy('publisher_name')
			->orderBy('grand_cost','desc')
			->take(10)
			->get();
	return View::make('pages.analytic.BestPublisherIncome',array( 'books'=> $books ) );
		}
	public function getBestUserIncome()
	{
		$books = DB::table('order_has_book')
		->join('orders','orders.id','=','order_has_book.order_id')
		->where('status','>=','5')
			->selectRaw('user_id , sum(total_cost) as  grand_cost')
			->groupBy('user_id')
			->orderBy('grand_cost','desc')
			->take(10)
			->get();
	return View::make('pages.analytic.BestUserIncome',array( 'books'=> $books ) );
	}
		public function getBestProvice()
	{
		$query = DB::table('orders')
		->where('status','>=','5')
			->join('order_has_book','order_has_book.order_id','=','orders.id')
			->join('users','users.id','=','orders.user_id')
			->select(DB::raw('provice , sum(total_cost) as  grand_cost'))
			->groupBy('provice')
			->orderBy('grand_cost','desc')
			->get();
			return $query;

	}
	public function getBestDistinctIncome()
	{
		$books = DB::table('orders')
		->where('status','>=','5')
			// ->join('order_has_book','order_has_book.order_id','=','orders.id')
			->join('users','users.id','=','orders.user_id')
			->select(DB::raw('provice , sum(total_price) as  grand_cost'))
			->groupBy('provice')
			->orderBy('grand_cost','desc')
			->get();
		return View::make('pages.analytic.BestDistinctIncome',array( 'books'=> $books ) );
	}
	public function getBestDistinctUser()
	{
		$books = DB::table('orders')
		->where('status','>=','5')
			// ->join('order_has_book','order_has_book.order_id','=','orders.id')
			->join('users','users.id','=','orders.user_id')
			->select(DB::raw('provice , sum(1) as  amount'))
			->groupBy('provice')
			->orderBy('amount','desc')
			->get();
		return View::make('pages.analytic.BestDistinctUser',array( 'books'=> $books ) );
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