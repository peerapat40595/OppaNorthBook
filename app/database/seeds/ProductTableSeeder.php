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
			'tel' => '0811111111',
			'confirmation_code' => '55ab60a278305e8ee60694b299763e31',
			'confirmed' => '1',
			'isadmin' => '1',
			'room_number' => '1701',
			'floor' => '17',
            'building' => 'อาคาร วิศวกรรมศาสตร์ 4 (เจริญวิศวกรรม)',
            'address_no' => '12345',
            'street' => 'พญาไท',
            'distinct' => 'ปทุมวัน',
            'sub_distinct' => 'วังใหม่',
            'provice' => 'กรุงเทพมหานคร',
            'zip_code' => '10330',
			)

		);
		
		DB::table('users')->insert( $users );
		$users = array(array(
				'username' => 'test1',
		        'email' => 'test1@test1.com',
		        'password' => Hash::make('test1'),
		        'firstname' => 'test1',
		        'lastname' => 'test1',
		        'tel' => '0811111211',
		        'confirmed' => '1'
			)
			
		);
		DB::table('users')->insert( $users );
		$users = array(array(
				'username' => 'test2',
		        'email' => 'test2@test2.com',
		        'password' => Hash::make('test2'),
		        'firstname' => 'test2',
		        'lastname' => 'test2',
		        'tel' => '0811111112',
		        'confirmed' => '1'
			)
			
		);
		DB::table('users')->insert( $users );
		$users = array(array(
				'username' => 'test5',
		        'email' => 'test5@test5.com',
		        'password' => Hash::make('test5'),
		        'firstname' => 'test5',
		        'lastname' => 'test5',
		        'tel' => '0811111115',
		        'confirmed' => '1'
			)
			
		);
		DB::table('users')->insert( $users );
		$users = array(array(
				'username' => 'test3',
		        'email' => 'test3@test3.com',
		        'password' => Hash::make('test3'),
		        'firstname' => 'test3',
		        'lastname' => 'test3',
		        'tel' => '0811111113',
		        'confirmed' => '1'
			)
			
		);
		DB::table('users')->insert( $users );
		$users = array(array(
				'username' => 'test4',
		        'email' => 'test4@test4.com',
		        'password' => Hash::make('test4'),
		        'firstname' => 'test4',
		        'lastname' => 'test4',
		        'tel' => '0811111141',
		        'confirmed' => '1'
			)
			
		);
		DB::table('users')->insert( $users );

		DB::table('suppliers')->delete();
		for ($i=0; $i < 10 ; $i++) { 
			Supplier::create(array(
				'id'       => $i+1,
				'name'     => 'Suppiler' . rand(0,10)*$i,

				));
		}
		
		/*
		DB::table('categories')->delete();
		for ($i=0; $i < 10 ; $i++) { 
			Category::create(array(
				'id'       => $i+1,
				'name'     => 'c' . rand(0,10)*$i,

				));
		}*/
		DB::table('categories')->delete();
		DB::table('sub_categories')->delete();
		$categories = array(
			array('name' => 'หนังสือหมวดมนุษย์ศาสตร์'),
			array('name' => 'หนังสือหมวดสังคมศาสตร์'),
			array('name' => 'หนังสือหมวดวิทยาศาสตร์ประยุกต์'),
			array('name' => 'หนังสือหมวดบริหารธุรกิจและการจัดการ'),
			array('name' => 'หนังสือหมวดอ้างอิง'),
			array('name' => 'หนังสือทั่วไป'),
			);
		DB::table('categories')->insert( $categories );
		$parent_id = Category::where('name','=','หนังสือหมวดมนุษย์ศาสตร์')->get()->first()->id;
		$categories = array(
			array('name' => 'ภาษาศาสตร์','parent_category_id' => $parent_id),
			array('name' => 'บรรณารักษ์ศาสตร์','parent_category_id' => $parent_id),
			array('name' => 'ศาสนา','parent_category_id' => $parent_id),
			array('name' => 'โหราศาสตร์','parent_category_id' => $parent_id),
			array('name' => 'ปรัชญา','parent_category_id' => $parent_id),
			array('name' => 'จิตวิทยา','parent_category_id' => $parent_id),
			array('name' => 'วรรณคดี','parent_category_id' => $parent_id),
			array('name' => 'วรรณกรรม','parent_category_id' => $parent_id),
			array('name' => 'ประวัติศาสตร์','parent_category_id' => $parent_id),
			array('name' => 'ศิลปะ-ดนตรี','parent_category_id' => $parent_id),
			array('name' => 'สถาปัตยกรรม','parent_category_id' => $parent_id),
			array('name' => 'นันทนาการ','parent_category_id' => $parent_id),
			array('name' => 'การแสดง','parent_category_id' => $parent_id),
			array('name' => 'กีฬา/เกม','parent_category_id' => $parent_id),
			array('name' => 'แผนที่','parent_category_id' => $parent_id),
			);
		DB::table('sub_categories')->insert( $categories );
		$parent_id = Category::where('name','=','หนังสือหมวดสังคมศาสตร์')->get()->first()->id;
		$categories = array(
			array('name' => 'สังคมวิทยา','parent_category_id' => $parent_id),
			array('name' => 'การเมือง','parent_category_id' => $parent_id),
			array('name' => 'การปกครอง','parent_category_id' => $parent_id),
			array('name' => 'ไทยศึกษา','parent_category_id' => $parent_id),
			array('name' => 'เอเชียศึกษา','parent_category_id' => $parent_id),
			array('name' => 'ภูมิศาสตร์','parent_category_id' => $parent_id),
			array('name' => 'การท่องเที่ยว','parent_category_id' => $parent_id),
			array('name' => 'เศรษฐศาสตร์','parent_category_id' => $parent_id),
			array('name' => 'กฎหมาย','parent_category_id' => $parent_id),
			array('name' => 'ศึกษาศาสตร์','parent_category_id' => $parent_id),
			array('name' => 'นิเทศศาสตร์','parent_category_id' => $parent_id),
			array('name' => 'ประชาสัมพันธ์','parent_category_id' => $parent_id),
			);
		DB::table('sub_categories')->insert( $categories );
		$parent_id = Category::where('name','=','หนังสือหมวดวิทยาศาสตร์ประยุกต์')->get()->first()->id;
		$categories = array(
			array('name' => 'แพทยศาสตร์','parent_category_id' => $parent_id),
			array('name' => 'พยาบาล','parent_category_id' => $parent_id),
			array('name' => 'สาธารณสุข','parent_category_id' => $parent_id),
			array('name' => 'เภสัชศาสตร์','parent_category_id' => $parent_id),
			array('name' => 'วิศวกรรมศาสตร์','parent_category_id' => $parent_id),
			array('name' => 'เกษตรศาสตร์','parent_category_id' => $parent_id),
			array('name' => 'คหกรรมศาสตร์','parent_category_id' => $parent_id),
			array('name' => 'เทคโนโลยี','parent_category_id' => $parent_id),
			array('name' => 'คอมพิวเตอร์','parent_category_id' => $parent_id),
			array('name' => 'การวิจัย','parent_category_id' => $parent_id),
			array('name' => 'วิทยาศาสตร์ทั่วไป','parent_category_id' => $parent_id),
			array('name' => 'ฟิสิกส์','parent_category_id' => $parent_id),
			array('name' => 'เคมี','parent_category_id' => $parent_id),
			array('name' => 'ชีววิทยา','parent_category_id' => $parent_id),
			array('name' => 'จุลชีววิทยา','parent_category_id' => $parent_id),
			array('name' => 'พฤกษศาสตร์','parent_category_id' => $parent_id),
			array('name' => 'สัตววิทยา','parent_category_id' => $parent_id),
			array('name' => 'ทรัพยากรธรรมชาติและสิ่งแวดล้อม','parent_category_id' => $parent_id),
			array('name' => 'สถิติศาสตร์','parent_category_id' => $parent_id),
			array('name' => 'คณิตศาสตร์','parent_category_id' => $parent_id),

			);
		DB::table('sub_categories')->insert( $categories );
		$parent_id = Category::where('name','=','หนังสือหมวดบริหารธุรกิจและการจัดการ')->get()->first()->id;
		$categories = array(
			array('name' => 'บริหารธุรกิจ','parent_category_id' => $parent_id),
			array('name' => 'การเงินและการธนาคาร','parent_category_id' => $parent_id),
			array('name' => 'การตลาด','parent_category_id' => $parent_id),
			array('name' => 'การบัญชี','parent_category_id' => $parent_id),
			array('name' => 'อุตสาหกรรมบริการ','parent_category_id' => $parent_id),
			array('name' => 'ธุรกิจอสังหาริมทรัพย์','parent_category_id' => $parent_id),
			array('name' => 'การบริหารงานบุคคล','parent_category_id' => $parent_id),
			array('name' => 'แรงงาน','parent_category_id' => $parent_id),
			array('name' => 'บริหารรัฐกิจ','parent_category_id' => $parent_id),
			array('name' => 'และ','parent_category_id' => $parent_id),
			array('name' => 'นโยบาย','parent_category_id' => $parent_id),
			array('name' => 'การคลังภาษีอากร','parent_category_id' => $parent_id),
			);
		DB::table('sub_categories')->insert( $categories );
		$parent_id = Category::where('name','=','หนังสือหมวดอ้างอิง')->get()->first()->id;
		$categories = array(
			array('name' => 'อ้างอิง,พจนานุกรม','parent_category_id' => $parent_id),
			array('name' => 'หนังสือพระราชนิพนธ์','parent_category_id' => $parent_id),
			array('name' => 'หนังสือเฉลิมพระเกียรติฯ','parent_category_id' => $parent_id),
			array('name' => 'วารสาร','parent_category_id' => $parent_id),
			);
		DB::table('sub_categories')->insert( $categories );
		$parent_id = Category::where('name','=','หนังสือทั่วไป')->get()->first()->id;
		$categories = array(
			array('name' => 'คู่มือสอบต่างๆ','parent_category_id' => $parent_id),
			array('name' => 'นวนิยาย','parent_category_id' => $parent_id),
			array('name' => 'เรื่องสั้น','parent_category_id' => $parent_id),
			array('name' => 'สารคดี','parent_category_id' => $parent_id),
			array('name' => 'ปกิณกะ','parent_category_id' => $parent_id),
			array('name' => 'หนังสือสำหรับเด็ก','parent_category_id' => $parent_id),
			array('name' => 'หนังสือสำหรับพ่อแม่','parent_category_id' => $parent_id),
			array('name' => 'หนังสือสำหรับเยาวชน','parent_category_id' => $parent_id),
			);
		DB::table('sub_categories')->insert( $categories );
		}

}