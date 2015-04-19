<?php

class UserRestController extends \BaseController {

	public function getData($search=null)
	{
		$search = Input::get('search');

		if(!$search){
			$users = User::paginate($limit = 10)->toJson();
			return $users;
		}else{
			$users = User::where('username', 'LIKE', '%'.$search.'%')
                        ->paginate(10)
                        ->toJson();
			return $users;
		}
		
	}


}