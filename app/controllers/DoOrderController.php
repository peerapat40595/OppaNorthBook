<?php

class DoOrderController extends \BaseController {

	public function __construct()
    {
        $this->beforeFilter(function()
        {
            //
            if (Auth::guest()) return Redirect::to('user/login');
        });
    }
    public function getIndex()
	{
		$userId = Auth::user()->id;
		$orders = Order::where('user_id',$userId)->orderBy('id','desc')->get();
		return View::make('userOrder.index',array( 'orders'=> $orders));
	}


	//public function getAdminProfile() {}
	public function getShowOrderlist($id)
	{
		//
		$orderlists = OrderList::where('order_id',$id)->get(); 
		$books = Book::All();	
		$category_all = Category::All();
		$order= Order::find($id);
		 return View::make('userOrder.showorderlist',array( 'order' =>$order,  'books'=> $books,'orderlists' =>$orderlists, 'category_all' => $category_all ));
	}
	public function postShowOrderlist($id) {

		//$address = Auth::user()->address;
		//return View::make('try.confirmAd')->with('address',$address);

		//redirect to page that show status of order
		return Redirect::to('doorder/show-orderlist/'.$id);

	}
	public function postDeleteOrderlist($id) {

		$orderlist = OrderList::find($id);
		$orderId=$orderlist->order_id;
		if ($orderlist) {
			
			$orderlist->delete();
			Session::flash('message', 'Successfully deleted the OrderList!');
			return Redirect::to('doorder/show-orderlist/'.$orderId);
		}
		

		// redirect
		Session::flash('message', 'Something went wrong, please try again');
		return Redirect::to('doorder/show-orderlist/'.$orderId);

	}
	public function postDeleteOrder($id) {

		$order = Order::find($id);
		if ($order) {
			
			$order->delete();
			Session::flash('message', 'Successfully deleted the Order!');
			return Redirect::to('doorder');
		}
		

		// redirect
		Session::flash('message', 'Something went wrong, please try again');
		return Redirect::to('doorder');

	}

	public function getUserAddress($orderId) {


		$user = Auth::user();
		return View::make('userOrder.confirmAd')->with('user',$user)->with('orderId',$orderId);

	}

	public function postUserAddress($orderId) {



		//redirect to page that show status of order


		//$userId = Auth::user()->id;
		
		$order = Order::find($orderId);

		//set up status to be first status
		$order->status = 3;
		$order->save();

		
		return Redirect::to('doorder');


	}

	public function getEditUserAddress($orderId) {

		$user = Auth::user();
		//return View::make('try.confirmAd')->with('address',$address);

		return View::make('userOrder.editAd')->with('user',$user)->with('orderId',$orderId);

	}
	public function postEditUserAddress($orderId) {

		//$address = Auth::user()->address;
		//return View::make('try.confirmAd')->with('address',$address);
		$user = Auth::user();

		$validator = Validator::make(
		    array('zip_code' => Input::get('zip_code')),
		    array('zip_code' => 'required')
		);

		if ($validator->fails())
		{
		    // The given data did not pass validation
		   
			return Redirect::to('doorder/edit-user-address/'.$orderId)
			->withErrors($validator);
		}else{
			//store
			$user->room_number = Input::get('room_number');
            $user->floor = Input::get('floor');
            $user->building = Input::get('building');
            $user->address_no = Input::get('address_no');
            $user->street = Input::get('street');
            $user->sub_distinct = Input::get('sub_distinct');
            $user->distinct = Input::get('distinct');
            $user->provice = Input::get('provice');
            $user->zip_code = Input::get('zip_code');
			$user->updateUniques();

			Session::flash('message', 'Successfully update address!');
        	return Redirect::to('doorder/user-address/'.$orderId);

		}

	
        
	}

	////////////////////////////////Peerapat zone/////////////////////////
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getConfirmation($id)
	{
		//

		$order = Order::find($id);

		 return View::make('userOrder.confirmation',array( 'order' =>$order));
	}
	public function postConfirmation($id)
	{
		//
		$rules = array(
			'image_path'=>'required|image|mimes:jpeg,jpg,bmp,png,gif'
		);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return Redirect::to('doorder/confirmation/'.$id)
			->withErrors($validator)
			->withInput();
		} else {
		$order=Order::find($id);
		if(Input::hasFile('image_path')){

				$image = Input::file('image_path');
				$filename = date('Y-m-d-H-i-s')."-".$image->getClientOriginalName();
				Image::make($image->getRealPath())->save(public_path().'/img/orders/'.$filename);
				$order->image_path = 'img/orders/'.$filename;

			}else if (Input::has('image_path')) {
				$order->image_path = Input::get('image_path');
			}
			$order->confirmed = 1;
			$order->status = 4;
			$order->save();
			Session::flash('message', 'Successfully sent!');

			return Redirect::to('doorder');

		}

	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */

}