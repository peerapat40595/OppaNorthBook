<?php

	class Order extends Eloquent
	{

		public function order_list(){
			return $this->hasMany('OrderList','order_id','id');
		}
		public function user(){
			return $this->belongTo('User','user_id');
		}


	}