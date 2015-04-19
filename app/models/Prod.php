<?php

	class Prod extends Eloquent
	{
		protected $table = 'products';
		protected $fillable = array('name', 'price', 'brand_id', 'category_id', 'availability', 'product_pic');

		public static $rules = array(
			'name'=>'required|min:2',
			'price'=>'required|numeric',
			'brand'=>'required|integer',
			'category'=>'required|integer',
			'availability'=>'integer',
			'product_pic'=>'required|image|mimes:jpeg,jpg,bmp,png,gif'
		);

		public function category() {
			return $this->belongsTo('Category');
		}
		public function brand() {
			return $this->belongsTo('Brand');
		}
	}
