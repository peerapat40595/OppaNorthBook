<?php

class ProductTableSeeder extends Seeder
{


	public function run()
	{
		Eloquent::unguard();

		DB::table('products')->delete();
		for ($i=0; $i < 100 ; $i++) { 
			Prod::create(array(
				'name'     => 'tester' . $i,
				'price'    => rand(100,3000),
				'brand_id' => rand(1,10),
				'category_id' => rand(1,10),
				'product_pic' => 'NULL'
				));
		}

		DB::table('brands')->delete();
		for ($i=0; $i < 10 ; $i++) { 
			Brand::create(array(
				'id'       => $i+1,
				'name'     => 'b' . rand(0,10)*$i,

				));
		}
		DB::table('categories')->delete();
		for ($i=0; $i < 10 ; $i++) { 
			Category::create(array(
				'id'       => $i+1,
				'name'     => 'c' . rand(0,10)*$i,

				));
		}

	}

}