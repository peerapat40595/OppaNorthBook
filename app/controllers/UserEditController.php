<?php
/*
|--------------------------------------------------------------------------
| Confide Controller Template
|--------------------------------------------------------------------------
|
| This is the default Confide controller template for controlling user
| authentication. Feel free to change to your needs.
|
*/

class UserEditController extends BaseController {
    public function __construct() {
        $this->beforeFilter('csrf', array('on'=>'post'));
    }


    public function index()
    {
        $users = User::All();    
        return View::make('pages.user.index')
            ->with('users',$users);
    }

    /**
     * Displays the form for account creation
     *
     */
  
    public function edit($id)
    {
        $user = User::find($id);

        // var_dump(json_encode($atts));
        return View::make('pages.user.edit',array( 'user'=> $user) );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
        
    public function update($id)
    {
        $rules = array(
           'username'=> 'required|alpha_dash',
            'email' => 'required|email',
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'tel' =>'required|digits:10',
            'address' =>'required'

            );
        $validator = Validator::make(Input::all(), $rules);


        // process the login
        if ($validator->fails()) {
            return Redirect::to('manage_user/'.$id.'/edit')
            ->withErrors($validator)
            ->withInput();
        } else {
            // store
            $user = User::find($id);
            $user->username = Input::get( 'username' );
            $user->email = Input::get( 'email' );
            $user->firstname = Input::get( 'firstname' );
            $user->lastname = Input::get( 'lastname' );
            $user->mobilephonenumber = Input::get( 'tel' );
            $user->address = Input::get( 'address' );
            

            $user->updateUniques    ();
            }


            // redirect
            Session::flash('message', 'Successfully update the user!');
            return Redirect::to('manage_user');
        }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            Session::flash('message', 'Successfully deleted the user!');
            return Redirect::to('manage_user');
        }

        // redirect
        Session::flash('message', 'Something went wrong, please try again');
        return Redirect::to('mange_user');
    }

    

}
