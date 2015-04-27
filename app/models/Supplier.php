<?php

	class Supplier extends Eloquent
	{
		protected $table = 'suppliers';
		protected $fillable = array('name'
									,'email'
									,'tel'
						            ,'room_number'
						            ,'building'
						            ,'address'
						            ,'street'
						           ,'distinct'
						            ,'provice'
						            ,'zip_code'
									);

		public static $rules = array('name'=>'required|min:3');

		public function book(){
			return $this->belongsToMany('Book','book_has_translator','suppiler_id')->withPivot('buy_price','buy_amount','buy_date','lot_no');
		}

	}