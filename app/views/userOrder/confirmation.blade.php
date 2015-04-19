@extends('layouts.default')

@section('content')

<div class="col-md-6 col-md-offset-3" ng-app>
    {{Form::open(array('action' => array('DoOrderController@postConfirmation', $order->id),'files'=> true))}}
    <br>
    <h1> Confirmation </h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
        </div>
    @endif
    <div class="form-group">
    {{ Form::label('image_path', 'Image :') }} 
       
         <input name="image_path" type="file" class="form-control" value="{{Input::old('image_path')}}">
     </div>


    <br>
    
    {{ Form::submit('Submit', array('class' => 'btn btn-success btn-block')) }}

    {{ Form::close() }}
<hr>
</div>


@stop