@extends('layouts.default')

@section('meta')
<meta name="keywords" content="OppaNorthBook" />
<meta name="description" content="">
<meta name="author" content="DBOppaNorth">
@stop

@section('title')
Forgot password
@stop

@section('content')
<div class="container">
<div class="col-md-4 col-md-offset-4">
    <div class="page-header">
        <h1>Forgot password</h1>

        @if ( Session::get('error') )
        <div class="alert alert-error alert-danger">{{{ Session::get('error') }}}</div>
        @endif

        @if ( Session::get('notice') )
        <div class="alert">{{{ Session::get('notice') }}}</div>
        @endif

        <form method="POST" action="{{ (Confide::checkAction('UserController@do_forgot_password')) ?: URL::to('/user/forgot') }}" accept-charset="UTF-8">
            <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">

            <div class="form-group">
                    <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
            </div>

            <div class="form-group">
                <button tabindex="3" type="submit" class="btn btn-lg btn-success btn-block">{{{ Lang::get('confide::confide.forgot.submit') }}}</button>
            </div>
        </form>
   </div>
</div>


</div>
<hr class="tall" />

@stop