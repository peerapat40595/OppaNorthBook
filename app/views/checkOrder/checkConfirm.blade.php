@extends('layouts.default')

@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-1" ng-app>

        <br>
        <h1>Check confirmation</h1>
        <!-- Button trigger modal -->

        <!-- will be used to show any messages -->
        @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        <br>
        <h3>User information</h3>
        <table class="table table-striped table-bordered">
            <hr/>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Username</td>
                    <td>Email</td>
                    <td>Firstname</td>
                    <td>Lastname</td>
                    <td>Mobilephonenumber</td>
                    <td>Address</td>       
                </tr>
            </thead>
            <tbody>
                <td>{{$user->id}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->firstname}}</td>
                <td>{{$user->lastname}}</td>
                <td>{{$user->mobilephonenumber}}</td>
                <td>{{$user->address}}</td>  

            </tbody>

        </table>

        <br>
        <h3>payment</h3>
        <br>

        <br>
        <div class="row">
            <center>{{ HTML::image($order->image_path,'confirmation_pic_' . $order->id, array('class'=>'img-responsive')) }}</center>
        </div>

        <br><br>
        <div class="row">

            <div class="col-md-6">
                {{ Form::open(array('url'=>'checkorder/all-check-confirm/','method'=>'GET')) }}
                <button type="submit" class="btn btn-warning btn-block " >
                    pending
                </button>

                {{ Form::close() }}
            </div>
            <div class="col-md-6">
               <button class="btn btn-success btn-block" data-toggle="modal" data-target="#confirm">approve <i class="fa fa-check-circle-o"></i></button>
           </div>
       </div>

       <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="filterLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="filterLabel">แน่ใจแล้วนะ</h4>
            </div>
            <div class="modal-body">
               แน่ใจแล้วนะว่าดูดีแล้วน่ะ :S

           </div>

           <div class="modal-footer">
            {{ Form::open(array('action' => array('CheckOrderController@postCheckConfirm',$order->id))) }}
            <button type="submit" class="btn btn-success btn-block" >
                แน่นอน
            </button>

            {{ Form::close() }}
        </div>
    </div>

</div>


@stop