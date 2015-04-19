@extends('layouts.default')

@section('content')

<div class="col-md-12" ng-app>
	{{ Form::open(array('action' => array('DoOrderController@postEditUserAddress',$orderId))) }}
	<br>
	<h1> Edit your address </h1>

	@if($errors->any())
		<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			{{ implode('', $errors->all('<li class="error">:message</li>')) }}
		</div>
	@endif
	
	<div class="control-group">
		{{ Form::label('address', 'confirm your address') }} <br>
		<input class="form-control" placeholder="newAddress" type="textarea" name="address" id="address" value="{{ $address }}">
		
	</div>


	<br>
	
	{{ Form::submit('Submit', array('class' => 'btn btn-success')) }}

	{{ Form::close() }}

</div>






	
@stop


