@extends('layouts.default')

@section('meta')
<meta name="keywords" content="CBA" />
<meta name="description" content="Login">
<meta name="author" content="I'Boss">
@stop

@section('title')
Login
@stop

@section('content')

<div class="container">
	
	<div class="col-md-4 col-md-offset-4">
		<div class="page-header">
			<h1>Login</h1>
		</div>
		
		@if ( Session::get('error') )
		<div class="alert alert-error alert-danger">{{{ Session::get('error') }}}</div>
		@endif

		@if ( Session::get('notice') )
		<div class="alert alert-success">{{{ Session::get('notice') }}}</div>
		@endif
		<!--login form-->

		<form method="POST" action="{{{ Confide::checkAction('UserController@do_login') ?: URL::to('/user/login') }}}" accept-charset="UTF-8">
			<input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
			<fieldset>
				<div class="form-group">
					<label for="email">{{{ Lang::get('confide::confide.username_e_mail') }}}</label>
					<input class="form-control" tabindex="1" placeholder="{{{ Lang::get('confide::confide.username_e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
				</div>
				<div class="form-group">
					<label for="password">
						{{{ Lang::get('confide::confide.password') }}}
						<small>
							<a href="{{{ (Confide::checkAction('UserController@forgot_password')) ?: 'forgot' }}}">{{{ Lang::get('confide::confide.login.forgot_password') }}}</a>
						</small>
					</label>

					

					<input class="form-control" tabindex="2" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
				</div>


				<div class="form-group">
					<label for="remember" class="checkbox">{{{ Lang::get('confide::confide.login.remember') }}}
						<input type="hidden" name="remember" value="0">
						<input tabindex="4" type="checkbox" name="remember" id="remember" value="1">
					</label>
				</div>




				<div class="form-group">
					<button tabindex="3" type="submit" class="btn btn-primary btn-lg btn-block">{{{ Lang::get('confide::confide.login.submit') }}}</button>
				</div>
			</fieldset>
		</form>

		<div>
			Don't have an account? <a href="{{{ URL::to('user/create')}}}">Resgister now.</a>
		</div>



	</div>

</div>


<hr class="tall" />


@stop