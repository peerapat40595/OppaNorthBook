@extends('layouts.default')

@section('content')

	<div class="container">
    <div class="col-md-12">
	{{ Form::open(array('action' => array('DoOrderController@postUserAddress',$orderId))) }}
	<br>
	<h1> Confirm your address </h1>
		    <!-- will be used to show any messages -->
	    @if (Session::has('message'))
	        <div class="alert alert-info">{{ Session::get('message') }}</div>
	    @endif
	<div class="control-group">
		<!--{{ Form::label('address', 'confirm your address') }} <br>-->
			@if($user->room_number!=NULL)
			
				ห้อง {{$user->room_number}}<tr>
			@endif
			@if($user->floor!=NULL)
			ชั้น {{$user->floor}} <tr>
			@endif
            @if($user->building!=NULL)
            อาคาร {{$user->building}} <tr>
            @endif
            @if($user->address_no!=NULL)
            เลขที่ {{$user->address_no}} <tr>
            @endif
            @if($user->street!=NULL)
            ถนน {{$user->street}} <tr>
            @endif
            @if($user->sub_distinct!=NULL)
            แขวง/ตำบล {{$user->sub_distinct}} <tr>
            @endif
            @if($user->distinct!=NULL)
            เขต/อำเภอ {{$user->distinct}} <tr>
            @endif
            @if($user->provice!=NULL)
            จังหวัด {{$user->provice}} <tr>
            @endif
            @if($user->zip_code!=NULL)
            รหัสไปรษณีย์ {{$user->zip_code}} <tr>
            @endif
	</div>

	<br>
	{{ Form::submit('Confirm', array('class' => 'btn btn-success')) }}
	{{ Form::close() }}
	<br>
	<a href="{{ URL::to('doorder/edit-user-address/'.$orderId) }}" class="btn btn-success">Edit</a>

</div></div>






	
@stop


