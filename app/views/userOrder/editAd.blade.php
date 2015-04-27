@extends('layouts.default')

@section('content')

<div class="col-md-12" ng-app>
	<div class="container">
    <div class="col-md-4 col-md-offset-4">
	{{ Form::open(array('action' => array('DoOrderController@postEditUserAddress',$orderId))) }}
	<br>
	<h1> Edit your address </h1>

	@if($errors->any())
		<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			{{ implode('', $errors->all('<li class="error">:message</li>')) }}
		</div>
	@endif
	<br>
	<div class="control-group">
		{{ Form::label('room_number', 'ห้อง') }} <br>
		<input class="form-control" placeholder="newRoomNumber" type="textarea" name="room_number" id="room_number" value="{{ $user->room_number }}">
		
	</div><br>
	<div class="control-group">
		{{ Form::label('floor', 'ชั้น') }} <br>
		<input class="form-control" placeholder="newFloor" type="textarea" name="floor" id="floor" value="{{ $user->floor }}">
		
	</div><br>
	<div class="control-group">
		{{ Form::label('building', 'อาคาร') }} <br>
		<input class="form-control" placeholder="newBuilding" type="textarea" name="building" id="building" value="{{ $user->building }}">
		
	</div><br>
	<div class="control-group">
		{{ Form::label('address_no', 'เลชที่') }} <br>
		<input class="form-control" placeholder="newAddressNo" type="textarea" name="address_no" id="address_no" value="{{ $user->address_no }}">
		
	</div><br>
	<div class="control-group">
		{{ Form::label('street', 'ถนน') }} <br>
		<input class="form-control" placeholder="newStreet" type="textarea" name="street" id="street" value="{{ $user->street }}">
		
	</div><br>
	<div class="control-group">
		{{ Form::label('sub_distinct', 'แขวง/ตำบล') }} <br>
		<input class="form-control" placeholder="newSubDistinct" type="textarea" name="sub_distinct" id="sub_distinct" value="{{ $user->sub_distinct }}">
		
	</div><br>
	<div class="control-group">
		{{ Form::label('distinct', 'เขต/อำเภอ') }} <br>
		<input class="form-control" placeholder="newDistinct" type="textarea" name="distinct" id="distinct" value="{{ $user->distinct }}">
		
	</div><br>
	<div class="control-group">
		{{ Form::label('provice', 'จังหวัด') }} <br>
		<input class="form-control" placeholder="newProvice" type="textarea" name="provice" id="provice" value="{{ $user->provice }}">
	</div><br>
	<div class="control-group">
		{{ Form::label('zip_code', 'รหัสไปรษณีย์') }} <br>
		<input class="form-control" placeholder="newZipCode" type="textarea" name="zip_code" id="zip_code" value="{{ $user->zip_code }}">
	</div>
	<br>
	
	{{ Form::submit('Submit', array('class' => 'btn btn-success')) }}

	{{ Form::close() }}
</div>
</div>

</div>






	
@stop


