@extends('layouts.default')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1" ng-app>

        <br>
        <h1>Approve payment</h1>
        <!-- Button trigger modal -->

        <!-- will be used to show any messages -->
        @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        
        <table class="table table-striped table-bordered">
          <hr>
          <thead>
            <tr>
                <td>Order_ID</td>
                <td>User_ID</td>
                <td>Confirmed_Image</td>
                <td>Orederlist</td>
                <td>check</td>         
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <td>{{ $order->id }}</td>
            <td>{{ $order->user_id }}</td>
            <td>{{ HTML::image($order->image_path,'confirmation_pic_' . $order->id, array('class'=>'feature', 'width'=>'100', 'height'=>'100')) }}</td>
            <td> {{ Form::open(array('url'=>'checkorder/show-orderlist/'.$order->id,'method'=>'GET')) }}
                <button type="submit" class="btn btn-default  " >
                    Show Order List
                </button>

                {{ Form::close() }}
            </td>
            <td> {{ Form::open(array('url'=>'checkorder/check-confirm/'.$order->id,'method'=>'GET')) }}
                <button type="submit" class="btn btn-success  " >
                    check payment
                </button>

                {{ Form::close() }}
            </td>

            {{ Form::open(array('url'=>'checkorder/check-confirm/'.$order->id,'method'=>'GET')) }}
            <button type="submit" class="btn btn-success  " >
                check payment
            </button>

            {{ Form::close() }}
        </tbody>
        @endforeach
    </table>


</div>
<hr class="tall" />
<script src="<?php echo asset('vendor/angular.min.js')?>"></script>
<script src="<?php echo asset('js/user_manager.js')?>"></script>

@stop