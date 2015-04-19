<?php

class SpCheckOrderController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	  public function getIndex()
	{
		$ordersYes = array();
		$orders = Order::where('status','=',5)->get(); 
		$spnotbanneds = User::where('id','=',Auth::user()->id)->get();
		$users = User::All();
		
		 return View::make('checkOrder.spstatus5yes',array( 'orders' =>$orders,'spnotbanneds'=>$spnotbanneds,'users'=>$users));
	}

	public function getShowOrderlist($id)
	{
		$orderlists = OrderList::where('order_id',$id)->get(); 
		$products = Prod::All();	
		$brand_all = Brand::All();
		$category_all = Category::All();
		$order= Order::find($id);
		 return View::make('checkOrder.showorderlist',array( 'order' =>$order,  'products'=> $products,'orderlists' =>$orderlists, 'brand_all' => $brand_all, 'category_all' => $category_all ));
	}
}