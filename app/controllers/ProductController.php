<?php

class ProductController extends BaseController {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
	}
	public function index()
	{
		$products = Prod::All();	
		$brand_all = Brand::All();
		$category_all = Category::All();
		return View::make('pages.product.index',array( 'products'=> $products, 'brand_all' => $brand_all, 'category_all' => $category_all ) );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$brand_all = Brand::All();
		$category_all = Category::All();
		return View::make('pages.product.create',array( 'brand_all' => $brand_all, 'category_all' => $category_all ) );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
		$validator = Validator::make(Input::all(), Prod::$rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('product/create')
			->withErrors($validator)
			->withInput();
		} else {
			// store
			$product = new prod;
			$product->name          = Input::get('name');
			$product->price         = Input::get('price');
			$product->brand_id      = Input::get('brand');
			$product->category_id   = Input::get('category');


			if(Input::hasFile('product_pic')){

				$image = Input::file('product_pic');
				$filename = date('Y-m-d-H-i-s')."-".$image->getClientOriginalName();
				Image::make($image->getRealPath())->save(public_path().'/img/products/'.$filename);
				$product->product_pic = 'img/products/'.$filename;

			}else if (Input::has('product_pic')) {
				$product->product_pic = Input::get('product_pic');
			}
			$product->description   = Input::get('description');
			$product->save();
			//waiting for edit

			
			for ($i=0; Input::has('type_'.$i); $i++) { 
				for ($j=0; Input::has('att_'.$i.$j); $j++) { 
					$att = new Attribute;
					$att->name = Input::get('att_'.$i.$j);
					$att->type = Input::get('type_'.$i);
					$att->product_id = $product->id;
					$att->save();
				}
			}




			Session::flash('message', 'Successfully created product!');
			return Redirect::to('product/create');
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{	Attribute::unguard();
		$product = Prod::find($id);
		$temp = Attribute::where('product_id', '=', $id)
		->get()
		->toJson();

		$temp = json_decode($temp);
		$atts = array();
		foreach ($temp as $value) {
			$index = count($atts);
			for ($i=0; $i <count($atts) ; $i++) { 
				if($value->type == $atts[$i]['name']) {
					$index = $i;
					break;
				}
			}

			if($index == count($atts)) $atts[] = array('name' => $value->type, 'data' => array( $value->name) );
			else $atts[$index]['data'][] = $value->name;

		}

		return View::make('pages.product.show')
		->with(array('product'=> $product, 'atts'=>$atts ));

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$product = Prod::find($id);

		$brand_all = Brand::All();
		$category_all = Category::All();


		$temp = Attribute::where('product_id', '=', $id)
		->get()
		->toJson();

		$temp = json_decode($temp);
		$atts = array();
		foreach ($temp as $value) {
			$index = count($atts);
			for ($i=0; $i <count($atts) ; $i++) { 
				if($value->type == $atts[$i]['name']) {
					$index = $i;
					break;
				}
			}

			if($index == count($atts)) $atts[] = array('name' => $value->type, 'data' => array( $value->name) );
			else $atts[$index]['data'][] = $value->name;

		}

		// var_dump(json_encode($atts));
		return View::make('pages.product.edit',array( 'product'=> $product, 'brand_all' => $brand_all, 'category_all' => $category_all, 'atts' => $atts ) );

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
		$validator = Validator::make(Input::all(), Prod::$rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('product/create')
			->withErrors($validator)
			->withInput();
		} else {
			// store
			$product = Prod::find($id);
			$product->name          = Input::get('name');
			$product->price         = Input::get('price');
			$product->brand_id      = Input::get('brand');
			$product->category_id   = Input::get('category');
			
			
			
			if(Input::hasFile('product_pic')){

				$image = Input::file('product_pic');
				$filename = date('Y-m-d-H-i-s')."-".$image->getClientOriginalName();
				Image::make($image->getRealPath())->save(public_path().'/img/products/'.$filename);
				$product->product_pic = 'img/products/'.$filename;

			}else if (Input::has('product_pic')) {
				if(File::exists(public_path().$product->product_pic))
					File::delete(public_path().$product->image);
				$product->product_pic = Input::get('product_pic');
			}

			$product->description   = Input::get('description');
			$product->save();

			Attribute::where('product_id','=',$id)->delete();
			
			for ($i=0; Input::has('type_'.$i); $i++) { 
				for ($j=0; Input::has('att_'.$i.$j); $j++) { 
					$att = new Attribute;
					$att->name = Input::get('att_'.$i.$j);
					$att->type = Input::get('type_'.$i);
					$att->product_id = $product->id;
					$att->save();
				}
			}


			// redirect
			Session::flash('message', 'Successfully update product!');
			return Redirect::to('product');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$product = Prod::find($id);
		if ($product) {
			File::delete(public_path().$product->image);
			$product->delete();
			Session::flash('message', 'Successfully deleted the product!');
			return Redirect::to('product');
		}
		

		// redirect
		Session::flash('message', 'Something went wrong, please try again');
		return Redirect::to('product');
	}



	

}