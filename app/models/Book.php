<?php

	class Book extends Eloquent
	{
		protected $table = 'books';
		protected $fillable = array('name', 'price',  'category_id', 'availability', 'cover_pic');

		public static $rules = array(
			'name'=>'required|min:2',
			'price'=>'required|numeric',
			'category'=>'required|integer',
			'availability'=>'integer',
			'cover_pic'=>'required|image|mimes:jpeg,jpg,bmp,png,gif'
		);

		public function category() {
			return $this->belongsTo('Category');
		}
	}
