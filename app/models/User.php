<?php
	use Zizaco\Confide\ConfideUser;


	class User extends ConfideUser {
		/**
	     * Validation rules
	     */
		protected $table = 'users';

	    public static $rules = array(
	    	'username'=> 'required|alpha_dash',
	        'email' => 'required|email',
	        'password' => 'required|between:4,11|confirmed',
	        'firstname' => 'required|alpha',
	        'lastname' => 'required|alpha',
	        'tel' =>'required|digits:10',
	    );


	    public function order() {
	    	 return $this->hasMany('Order','user_id','id');
	    }


	}



////////////////////////////////////
// use Illuminate\Auth\UserInterface;
// use Illuminate\Auth\Reminders\RemindableInterface;

// class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	// protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	// public function getAuthIdentifier()
	// {
	// 	return $this->getKey();
	// }

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	// public function getAuthPassword()
	// {
	// 	return $this->password;
	// }

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
// 	public function getReminderEmail()
// 	{
// 		return $this->email;
// 	}

// }