<?php

	class Category extends Eloquent
	{
		protected $fillable = array('name');

		public static $rules = array('name'=>'required|min:3');

		// public function subcategory() {
		// 	return $this->hasMany('Category','id');
		// }
		public function book() {
			return $this->hasMany('Book','category_id','id');
		}
	}