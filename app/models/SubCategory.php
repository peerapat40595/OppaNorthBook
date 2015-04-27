<?php

	class SubCategory extends Eloquent
	{
		protected $fillable = array('name');

		public static $rules = array('name'=>'required|min:3');

		public function book() {
			return $this->hasMany('Book','sub_category_id','id');
		}
		// public function category(){
		// 	return $this->belongsTo('Category','parent_category_id');
		// }
	}