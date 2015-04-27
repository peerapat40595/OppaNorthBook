<?php

	class Tag extends Eloquent
	{
		protected $table = 'tags';
		protected $fillable = array('name');

		public static $rules = array('name'=>'required|min:3');

		public function book(){
			return $this->belongsToMany('Book','book_has_tag','tag_id');
		}

	}