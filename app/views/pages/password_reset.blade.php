@extends('layouts.default')

@section('meta')
<meta name="keywords" content="OppaNorthBook" />
<meta name="description" content="Reset password">
<meta name="author" content="DBOppaNorth">
@stop

@section('title')
Reset password
@stop

@section('content')

<div class="container">
	
	<div class="col-md-4 col-md-offset-4">
		<div class="page-header">
			<h1>Reset password</h1>
		</div>



		@if ( Session::get('error') )
		<div class="alert alert-error alert-danger">{{{ Session::get('error') }}}</div>
		@endif

		@if ( Session::get('notice') )
		<div class="alert">{{{ Session::get('notice') }}}</div>
		@endif
		<form method="POST" action="{{{ (Confide::checkAction('UserController@do_reset_password'))    ?: URL::to('/user/reset') }}}" accept-charset="UTF-8">
			<input type="hidden" name="token" value="{{{ $token }}}">
			<input type="hidden" name="_token" value="{{{ Session::getToken() }}}">

			<div class="form-group">
				<label for="password">{{{ Lang::get('confide::confide.password') }}}</label>
				<input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
			</div>
			<div class="form-group">
				<label for="password_confirmation">{{{ Lang::get('confide::confide.password_confirmation') }}}</label>
				<input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation">
			</div>
			<div class="form-group">
					<button tabindex="3" type="submit" class="btn btn-primary btn-lg btn-block">{{{ Lang::get('confide::confide.forgot.submit') }}}</button>
				</div>
		</div>
	</div>


</form>




</div>

</div>


<hr class="tall" />


@stop