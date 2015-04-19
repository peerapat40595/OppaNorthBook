<?php

class CheckOrderController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	  public function getIndex()
	{
		
		return View::make('checkOrder.index');
	}
    public function getStatus5No()
	{
	
		$orders = Order::where('status','=',5)->orderBy('paid_at','asc')->get(); 
		$spbanneds = User::where('banned','=',1)->where('issp','=',1)->get();
		$users = User::All();
	
		 return View::make('checkOrder.status5no',array( 'orders' =>$orders,'spbanneds'=>$spbanneds,'users'=>$users));
	}
	  public function getStatus5Yes()
	{
		$ordersYes = array();
		$orders = Order::where('status','=',5)->orderBy('paid_at','asc')->get(); 
		$spnotbanneds = User::where('banned','=',0)->where('issp','=',1)->get();
		$users = User::All();
		
		 return View::make('checkOrder.status5yes',array( 'orders' =>$orders,'spnotbanneds'=>$spnotbanneds,'users'=>$users));
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


	public function getAllCheckConfirm(){

		//$orders = Order::where('status','=',4)->orderBy('id', 'DESC')->get();

		$orders = Order::where('status','=',4)->get();


		//return 'eiei';
		return View::make('CheckOrder.AllCheckConfirm',array('orders'=> $orders));
	}

	public function getCheckConfirm($orderId){

		$order = Order::find($orderId);

		$user = User::find($order->user_id);

		return View::make('CheckOrder.checkConfirm',array('order'=> $order,'user'=>$user));
	}

	public function postCheckConfirm($orderId){

		$order = Order::find($orderId);
		$order->touch();
		$order->paid_at = Order::find($orderId)->updated_at;
		$order->status = 5;
		$order->save();

		return Redirect::to('checkorder/all-check-confirm');
		
	}

}