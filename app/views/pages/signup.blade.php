@extends('layouts.default')

@section('meta')
<meta name="keywords" content="OppaNorthBook" />
<meta name="description" content="">
<meta name="author" content="DBOppaNorth">
@stop

@section('title')
Sign up
@stop

@section('content')
<div class="container">
    <div class="col-md-4 col-md-offset-4">

        <div class="page-header">
            <h1>Sign up</h1>
        </div>

        @if ( Session::get('error') )
        <div class="alert alert-error alert-danger">
            @if ( is_array(Session::get('error')) )
            {{ head(Session::get('error')) }}
            @endif
        </div>
        @endif

        @if ( Session::get('notice') )
        <div class="alert alert-info">{{ Session::get('notice') }}</div>
        @endif


        <form method="POST" action="{{{ (Confide::checkAction('UserController@store')) ?: URL::to('user')  }}}" accept-charset="UTF-8" id="usrform">
            <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
            
            <div class="form-group">
                <label for="username">{{{ Lang::get('confide::confide.username') }}}</label>
                <input class="form-control" placeholder="{{{ Lang::get('confide::confide.username') }}}" type="text" name="username" id="username" value="{{{ Input::old('username') }}}">
            </div>
            <div class="form-group">
                <label for="email">{{{ Lang::get('confide::confide.e_mail') }}} <small style="color : red;">({{ Lang::get('confide::confide.signup.confirmation_required') }})</small></label>
                <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
            </div>
            <div class="form-group">
                <label for="password">{{{ Lang::get('confide::confide.password') }}}</label>
                <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">{{{ Lang::get('confide::confide.password_confirmation') }}}</label>
                <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation">
            </div>
            <div class="form-group">
                <label for="firstname">Firstname</label>
                <input class="form-control" placeholder="Firstname" type="text" name="firstname" id="firstname" value="{{{ Input::old('firstname') }}}">
            </div>
            <div class="form-group">
                <label for="lastname">Lastname</label>
                <input class="form-control" placeholder="Lastname" type="text" name="lastname" id="lastname" value="{{{ Input::old('lastname') }}}">
            </div>
            <div class="form-group">
                <label for="tel">Tel</label>
                <input class="form-control" placeholder="08xxxxxxxx" type="text" name="tel" id="tel" value="{{{ Input::old('tel') }}}">
            </div>
           <!-- <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" name="address" id="address" form="usrform" placeholder="Address">{{{ Input::old('address') }}}</textarea>
            </div>
            <div class="form-group">
                <label for="sp_code">Sp_code</label>
                <input class="form-control" placeholder="SP_Code" type="text" name="sp_code" id="sp_code" value="{{{ Input::old('sp_code') }}}">
            </div>
             <div class="form-group">
                <input class="form-control" placeholder="{{Cookie::get('sp_code')}}" type="hidden" name="resp_sp_code" id="resp_sp_code" value="{{Cookie::get('sp_code')}}">
            </div>
        -->


                <div class="form-actions form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">{{{ Lang::get('confide::confide.signup.submit') }}}</button>
                </div>


            </form>


        </div>
    </div>
    <hr class="tall" />
    @stop