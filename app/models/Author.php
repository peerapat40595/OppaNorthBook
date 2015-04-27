<?php

	class Author extends Eloquent
	{
		protected $table = 'authors';
		protected $fillable = array(
			'prefix',
            'first_name',
            'last_name',
            'pseudonym'

			);

		public static $rules = array('psenonym'=>'required|min:3');

		public function book(){
			return $this->belongsToMany('Book','book_has_author','author_id');
		}

	}