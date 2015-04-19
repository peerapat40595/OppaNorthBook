<?php

	class Order extends Eloquent
	{

		public function order_list() {
	    	 return $this->hasMany('OrderList');
	    }


	}