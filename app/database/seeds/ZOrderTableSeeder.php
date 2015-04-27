<?php

class ZOrderTableSeeder extends Seeder
{


	public function run()
	{
		DB::table('orders')->delete();
		DB::table('order_has_book')->delete();

		for($i=1;$i<=100;$i++)
		{
			$order = new Order;
			$order->status = rand(1,5);
			$order->user_id = rand(1,5);
			$order->save();
			for($j=1;$j<=rand(1,10);$j++)
			{
			$order_list = new OrderList;
			$order_list->amount = rand(1,5);
			$order_list->order_id = $order->id;
			$order_list->book_id = rand(1,99);
			$order_list->total_cost = Book::find($order_list->book_id)->sell_price * $order_list->amount;
			$order_list->save();
			}
			
		}


	}
}