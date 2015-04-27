<?php

	class Book extends Eloquent
	{
		protected $table = 'books';
		protected $fillable = array(
            'barcode'
			,'ISBN'
            ,'title'
            ,'description'
            ,'language'
            ,'pub_date'
            ,'edition'
            ,'type'
            ,'cover_price'
            ,'publisher_name'
           ,'availability'
            ,'sub_category_id'
            ,'cover_pic'
            ,'back_pic'
           ,'first_pic'
            , 'cover_price'
            );

		public static $rules = array(
			//'price'=>'required|numeric',
			'title'=>'required|min:2',
			'category'=>'required|integer',
			'sub_category'=>'required|integer',
			'availability'=>'integer',
			'cover_pic'=>'required|image|mimes:jpeg,jpg,bmp,png,gif'
		);

		public function subcategory() {
			return $this->belongsTo('SubCategory','sub_category_id');
		}
		public function category() {
			return $this->belongsTo('Category','category_id');
		}
		public function author(){
			return $this->belongsToMany('Author','book_has_author','book_id');
		}
		public function translator(){
			return $this->belongsToMany('Translator','book_has_translator','book_id');
		}
		public function tag(){
			return $this->belongsToMany('Tag','book_has_tag','book_id');
		}
		public function supplier(){
			return $this->belongsToMany('Supplier','book_has_supplier','book_id')->withPivot('lot_no')->withPivot('buy_price')->withPivot('buy_amount')->withPivot('buy_date');
		}
		public function orderlist(){
			return $this->hasMany('OrderList','book_id','id');
		}
	}
