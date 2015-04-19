
@extends('layouts.default')

@section('meta')
<meta name="keywords" content="OppaNorthBook" />
<meta name="description" content="">
<meta name="author" content="DBOppaNorth">
@stop

@section('title')
Edit
@stop

@section('content')
<div class="container">



    <div class="col-md-6 col-md-offset-3" style="margin-top:10px">
        <h1>Edit User</h1>

        <!-- if there are creation errors, they will show here -->
        {{ HTML::ul($errors->all()) }}
        {{ Form::model($user, array('route' => array('manage_user.update', $user->id), 'method' => 'PUT')) }}

        <div class="form-group">
            {{ Form::label('username', 'Username') }}
            {{ Form::text('username', Input::old('username'), array('class' => 'form-control')) }}
        </div>
         <div class="form-group">
            {{ Form::label('email', 'E-mail') }}
            {{ Form::text('email', Input::old('email'), array('class' => 'form-control')) }}
        </div>
        
        <div class="form-group">
            {{ Form::label('firstname', 'Firstname') }}
            {{ Form::text('firstname', Input::old('firstname'), array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('lastname', 'Lastname') }}
            {{ Form::text('lastname', Input::old('lastname'), array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('mobilephonenumber', 'mobilephonenumber') }}
            {{ Form::text('mobilephonenumber', Input::old('mobilephonenumber'), array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('address', 'Address') }}
            {{ Form::text('address', Input::old('address'), array('class' => 'form-control')) }}
        </div>
       
            
            {{ Form::submit('Edit', array('class' => 'btn btn-primary btn-lg btn-block')) }}

                {{ Form::close() }}
     </div>
     


   
        <hr class="tall" />


        
        @stop