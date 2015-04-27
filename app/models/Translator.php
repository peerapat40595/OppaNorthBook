<?php

	class Translator extends Eloquent
	{
		protected $table = 'translators';
		protected $fillable = array(
			'prefix',
            'first_name',
            'last_name',
            'pseudonym'

			);

		public static $rules = array('psenonym'=>'required|min:3');

		public function book(){
			return $this->belongsToMany('Book','book_has_translator','translator_id');
		}

	}