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
<div class="container" ng-app="attribute">


    @include('pages.order.frac.nav')

    <div class="col-md-6 col-md-offset-3" style="margin-top:10px">
        <h1>Edit order</h1>

        <!-- if there are creation errors, they will show here -->
        {{ HTML::ul($errors->all()) }}

        {{ Form::model($order, array('route' => array('order.update', $order->id), 'method' => 'PUT')) }}

        <div class="form-group">
            {{ Form::label('status', 'Status') }}
            {{ Form::text('status', Input::old('status'), array('class' => 'form-control')) }}
        </div>

                {{ Form::submit('Edit', array('class' => 'btn btn-primary btn-lg btn-block')) }}

                {{ Form::close() }}
            </div>

        </div>
        <hr class="tall" />


        @stop