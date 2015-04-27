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
	public function getTTT()
	{
		return DB::table('order_has_book')
			->join('orders','orders.id','=','order_has_book.order_id')
			
			->selectRaw('user_id , sum(total_cost) as  grand_cost')
			->groupBy('user_id')
			->orderBy('grand_cost','desc')
			->get();

		}
		public function getTopProvice()
	{
		return DB::table('orders')
			->join('order_has_book','order_has_book.order_id','=','orders.id')
			->join('users','users.id','=','orders.user_id')
			->select(DB::raw('provice , sum(total_cost) as  grand_cost'))
			->groupBy('provice')
			->orderBy('grand_cost','desc')
			->get();

	}
	public function getTopDistinct()
	{
		return DB::table('orders')
			->join('order_has_book','order_has_book.order_id','=','orders.id')
			->join('users','users.id','=','orders.user_id')
			->select(DB::raw('distinct , sum(total_cost) as  grand_cost'))
			->groupBy('distinct')
			->orderBy('grand_cost','desc')
			->get();
	}
	public function getTopUserCost()
	{
		return DB::table('order_has_book')
			->join('orders','orders.id','=','order_has_book.order_id')
			
			->selectRaw('user_id , sum(total_cost) as  grand_cost')
			->groupBy('user_id')
			->orderBy('grand_cost','desc')
			->get();

		}
	public function getTopPublisherCost()
	{
		return DB::table('order_has_book')
			->join('books','books.id','=','order_has_book.book_id')
			->selectRaw('publisher_name , sum(total_cost) as  grand_cost')
			->groupBy('publisher_name')
			->orderBy('grand_cost','desc')
			->get();

		}
	public function getTopBookSellCost()
	{
		return DB::table('order_has_book')
			->selectRaw('book_id , sum(total_cost) as  grand_cost')
			->groupBy('book_id')
			->orderBy('grand_cost','desc')
			->get();

		}
	public function getTopBookSellAmount()
	{
		return DB::table('order_has_book')
			->selectRaw('book_id , sum(amount) as  grand_amount')
			->groupBy('book_id')
			->orderBy('grand_amount','desc')
			->get();

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