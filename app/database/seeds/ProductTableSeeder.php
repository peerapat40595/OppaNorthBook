<?php

class ProductTableSeeder extends Seeder
{


	public function run()
	{
		Eloquent::unguard();
		DB::table('users')->delete();
		$users = array(array('username' =>'admin',
			'email' => 'admin@admin.com',
			'password' => Hash::make('admin'),
			'firstname' => 'admin',
			'lastname' => 'admin',
			'mobilephonenumber' => '0811111111',
			'address' => 'dasdasderberb',
			'confirmation_code' => '55ab60a278305e8ee60694b299763e31',
			'confirmed' => '1',
			'isadmin' => '1'
			));
		DB::table('users')->insert( $users );
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

		/*DB::table('brands')->delete();
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
		}*/
		$categories = array(
			array('name' => 'หนังสือหมวดมนุษย์ศาสตร์')/*,
			array('name' => 'ศาสนา โหราศาสตร์'),
			array('name' => 'ปรัชญา จิตวิทยา'),
			array('name' => 'วรรณคดี วรรณกรรม'),
			array('name' => 'ไทยศึกษา'),
			array('name' => 'วิทยาศาสตร์ทั่วไป'),
			array('name' => 'บริหารธุรกิจ'),
			array('name' => 'หนังสือพระราชนิพนธ์'),
			array('name' => 'หนังสือเฉลิมพระเกียรติฯ'),
			array('name' => 'นวนิยาย เรื่องสั้น'),
			array('name' => 'หนังสือสำหรับเด็ก'),
			array('name' => 'หนังสือสำหรับเยาวชน'),
			array('name' => 'อ้างอิง พจนานุกรม'),
			array('name' => 'วิทยาการและเทคโนโลยี'),
			array('name' => 'คอมพิวเตอร์'),
			array('name' => 'การท่องเที่ยว'),
			array('name' => 'คู่มือสอบต่างๆ'),
			array('name' => 'ศิลปการถ่ายภาพ')*/
			);
		DB::table('categories')->insert( $categories );
		$parent_id = Category::where('name','=','หนังสือหมวดมนุษย์ศาสตร์')->get()->first()->id;
		$categories = array(
			array('name' => 'ภาษาศาสตร์','parent_category_id' => $parent_id),
			array('name' => 'บรรณารักษ์ศาสตร์','parent_category_id' => $parent_id),
			array('name' => 'ศาสนา โหราศาสตร์','parent_category_id' => $parent_id),
			array('name' => 'ปรัชญา จิตวิทยา	','parent_category_id' => $parent_id),
			array('name' => 'วรรณคดี วรรณกรรม','parent_category_id' => $parent_id),
			array('name' => 'ประวัติศาสตร์','parent_category_id' => $parent_id),
			array('name' => 'ศิลปะ- ดนตรี','parent_category_id' => $parent_id),
			);
		DB::table('categories')->insert( $categories );
	}

}