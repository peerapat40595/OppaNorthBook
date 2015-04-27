<?php

	class OrderList extends Eloquent
	{

		protected $table = 'order_has_book';
		protected $fillable = array('order_id','book_id','amount','total_cost');


	    public function book(){
	    	return $this->belongsTo('Book','book_id');
	    }
	     public function order(){
	    	return $this->belongsTo('Order','order_id');
	    }

	}