<?php

	class OrderListAttribute extends Eloquent
	{
		protected $table = 'order_list_attributes';
		protected $fillable = array('order_list_id','name','type');

	
	}