<?php

class ProductRestController extends \BaseController {

	public function getData()
	{
		$search = Input::get('search');
		$cat_id = Input::get('category_id');


		if (Input::has('category_id')) {
			$cat_id = Input::get('category_id');
			if(!$search){
				$products = Prod::where('category_id','=',$cat_id)
					->orderBy('brand_id','desc')
					->orderBy('name','desc')
					->paginate($limit = 15)
					->toJson();
					return $products;
				}else{
					$products = Prod::where('name', 'LIKE', '%'.$search.'%')
					->where('category_id','=',$cat_id)
					->orderBy('brand_id','desc')
					->orderBy('name','desc')
					->paginate(15)
					->toJson();
					return $products;
				}
			} else{

				if(!$search){
					$products = Prod::orderBy('brand_id','desc')
					->orderBy('name','desc')
					->paginate($limit = 15)
					->toJson();
					return $products;
				}else{
					$products = Prod::where('name', 'LIKE', '%'.$search.'%')
					->orderBy('brand_id','desc')
					->orderBy('name','desc')
					->paginate(15)
					->toJson();
					return $products;
				}
			}



		}



		public function getBrand()
		{
			$brands = Brand::All()->toJson();
			return $brands;

		}

		public function getCategory()
		{
			$categories = Category::All()->toJson();
			return $categories;
		}



	}