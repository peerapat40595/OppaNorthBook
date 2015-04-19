<?php

	class OrderList extends Eloquent
	{

		protected $table = 'order_lists';
		protected $fillable = array('order_id','product_id','amount','total_cost');

		public function order_list_attribute() {
	    	 return $this->hasMany('OrderListAttribute');
	    }

	    public function product(){
	    	return $this->belongsTo('Prod');
	    }


	}