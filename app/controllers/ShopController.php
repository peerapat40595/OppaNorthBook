<?php

class ShopController extends \BaseController {

	public function shop(){

		$id = Input::get('category_id');

		if(Category::find($id)!=null){
			return View::make('pages.shop.main')->with('cat_id',$id);
		}

		return View::make('pages.shop.main');

	}

	public function addtocart(){
		
		try {

			$order_list_input = json_decode(Input::get('order_list'));
			if (!Order::where('user_id','=',Auth::user()->id)
				->where('status','=',0)->get()->first()){
				$order = new Order;
			$order->status = 0;
			$order->user_id = $order_list_input->user_id;
			$order->save();

			$order_list = new OrderList;
			$order_list->amount = $order_list_input->amount;
			$order_list->order_id = $order->id;
			$order_list->product_id = $order_list_input->product_id;
			$order_list->total_cost = Prod::find($order_list_input->product_id)->price * $order_list_input->amount;
			$order_list->save();

			//attributes
			if (!is_null($order_list_input->attribute)) 
				foreach ($order_list_input->attribute as $key => $value) {
					try {
						OrderListAttribute::unguard();
						$order_att = new OrderListAttribute;
						$order_att->name = $value;
						$order_att->type = $key;
						$order_att->order_list_id = $order_list->id;
						$order_att->save();


					} catch (Exception $e) {
						echo $e->getMessage();	
					}

				}

				echo "ไม่มีออเดอร์ค้าง";

			//no order in the list share same product
			} else if(!Order::where('user_id','=',Auth::user()->id)
				->where('status','=',0)
				->wherehas('order_list',function($q){

				if(count((array)json_decode(Input::get('order_list'))->attribute)!=0) // att exists
				foreach (json_decode(Input::get('order_list'))->attribute as $key => $value) {

					$q = $q->where('product_id','=',json_decode(Input::get('order_list'))->product_id)
					->wherehas('order_list_attribute',function($r) use ($key,$value){
						$r->where('name','=',$value)->where('type','=',$key);		
					});

				}
				else $q = $q->where('product_id','=',json_decode(Input::get('order_list'))->product_id);

				return $q;

			})->get()->first())

			{
				$order = Order::where('status','=',0)
							->where('user_id','=',Auth::user()->id)->get()->first(); //use
							echo 'ไม่เคยมีสินค้าที่เหมือนกันค้างอยู่';

							$order_list = new OrderList;
							$order_list->amount = $order_list_input->amount;
							$order_list->order_id = $order->id;
							$order_list->product_id = $order_list_input->product_id;
							$order_list->total_cost = Prod::find($order_list_input->product_id)->price * $order_list_input->amount;
							$order_list->save();

							//attributes
							if (!is_null($order_list_input->attribute))
								foreach ($order_list_input->attribute as $key => $value) {
									try {
										OrderListAttribute::unguard();
										$order_att = new OrderListAttribute;
										$order_att->name = $value;
										$order_att->type = $key;
										$order_att->order_list_id = $order_list->id;
										$order_att->save();


									} catch (Exception $e) {
										echo $e->getMessage();	
									}
								}


							}else{

								echo "สินค้าซ้ำ";

							// if (!$order_list_input->attribute) echo 'no att';

								$order = Order::where('status','=',0)
								->where('user_id','=',Auth::user()->id)->get()->first();

								$order_list = OrderList::where('product_id','=',$order_list_input->product_id)
								->where('order_id','=',$order->id)
								->where(function($q){

								if(count((array)json_decode(Input::get('order_list'))->attribute)!=0) // att exists
								foreach (json_decode(Input::get('order_list'))->attribute as $key => $value) {

									$q = $q->where('product_id','=',json_decode(Input::get('order_list'))->product_id)
									->wherehas('order_list_attribute',function($r) use ($key,$value){
										$r->where('name','=',$value)->where('type','=',$key);		
									});

								}
								else $q = $q->where('product_id','=',json_decode(Input::get('order_list'))->product_id);

								return $q;

								
							})
								->get()->first();

								$order_list->amount = $order_list_input->amount+$order_list->amount;
								$order_list->order_id = $order->id;
								$order_list->product_id = $order_list_input->product_id;
								$order_list->total_cost = Prod::find($order_list_input->product_id)->price * $order_list->amount;
								$order_list->save();

							}

						} catch (Exception $e) {
							echo $e->getMessage();
						}


					}


					public function attributes(){
						Attribute::unguard();
						$id = Input::get('product_id');
						$product = Prod::find($id);
						$temp = Attribute::where('product_id', '=', $id)
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

						return json_encode($atts);
					}




					public function cart(){


						if(!is_null(Order::where('user_id','=',Auth::user()->id)
							->where('status','=',0)
							->get()->first()))
						{
							$ordertest = Order::where('user_id','=',Auth::user()->id)
							->where('status','=',0)
							->get()->first();

							if (OrderList::where('order_id','=',$ordertest->id)->get()->All()) 
							{
								$order = Order::where('user_id','=',Auth::user()->id)
								->where('status','=',0)
								->get()->first();

								$order_list = OrderList::where('order_id','=',$order->id)
								->get()->All();

								return View::make('pages.shop.cart')->with(array('order_list'=>$order_list, 'orderall'=> $order));
							}


						}

						return View::make('pages.shop.cart')->with('order_list',null);



					}

					public function deleteorder($id){
						OrderList::find($id)->delete();
						return Redirect::to('/shop/cart');
					}

					public function tos1($id){
						if (!is_null(Input::get('recv_location'))) {
							$order = Order::find($id);
							$order->status = 3;
							$order->recv_location = Input::get('recv_location');
							$order->touch();
							$order->ordered_at = $order->updated_at;
							$order->save();
							return Redirect::to('/doorder');
						}
						Session::flash('error','เลือกสถานที่ด้วยนะคะ');
						return Redirect::to('/shop/cart');
						
						
					}
				}