@extends('layouts.default')

@section('content')

<div class="col-md-6 col-md-offset-3" ng-app>

    <br>
    <h1>Admin Check Order</h1>
    <!-- Button trigger modal -->

<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

    <br><br>
     {{ Form::open(array('url'=>'checkorder/all-check-confirm/','method'=>'GET')) }}
    <button type="submit" class="btn btn-success btn-block " >
    Approve payment
    </button>
             
    {{ Form::close() }}
    <br><br>
     {{ Form::open(array('url'=>'checkorder/status5-no/','method'=>'GET')) }}
    <button type="submit" class="btn btn-success btn-block " >
    All paid order
    </button>
             
    {{ Form::close() }}
    <br><br>
     {{ Form::open(array('url'=>'checkorder/status5-yes/','method'=>'GET')) }}
    <button type="submit" class="btn btn-success btn-block " >
    All order
    </button>
             
    {{ Form::close() }}
                           
        

<hr class="tall" />

@stop