@extends('layouts.default')

@section('content')

<div class="col-md-12" ng-app>

    <br>
    <h1>All order</h1>
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
        <td>Orederlist</td>
        <td>User_ID</td>
        <td>User_firstname</td>
        <td>User_lastname </td>
        <td>User_tel</td>
        <td>ordered_at</td> 
        <td>paid_at</td> 
        <td>Status</td>    
        <td>Address </td>               
    </tr>
</thead>
<tbody>
    @foreach($orders as $order)
            @foreach($users as $user)
                @if($order -> user_id == $user -> id)

                            

                           
                                @if($order->status === 3)
            <tr class="active">
                @elseif ($order->status === 4)
                <tr class="info">
                    @elseif ($order->status === 5)
                    <tr class="success">
                    @else
                    <tr>
                    @endif
                    <td>{{ $order->id }}</td>
                     <td> {{ Form::open(array('url'=>'checkorder/show-orderlist/'.$order->id,'method'=>'GET')) }}
                                    <button type="submit" class="btn btn-success  " >
                                        Show Order List
                                    </button>
                             
                                    {{ Form::close() }}
                            </td>
                            <td>{{ $order->user_id }}</td> 
                            <td>{{ $user->firstname }}</td>
                            <td>{{ $user->lastname }}</td>
                            <td>{{ $user->tel }}</td>  
                            <td>{{ $order->ordered_at }}</td>
                            <td>{{ $order->paid_at }}</td>
                    <td>


                        @if ($order->status === 3)
                        กรุณายืนยันการชำระเงินภายใน 24 ชั่วโมงค่ะ
                        <a href="doorder/confirmation/{{$order->id}}">ส่งหลักฐานการชำระเงิน</a>

                        @elseif ($order->status === 4)
                        กำลังดำเนินการค่ะ ตรวจสอบภาพที่ส่งมาได้
                        <a data-toggle="modal" data-target="#confirm">ที่นี่ <i class="fa fa-picture-o"></i></a>

                        <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="filterLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="filterLabel">หลักฐานการชำระเงิน</h4>
                            </div>
                            <div class="modal-body col-md-12">
                                <center><img src="{{$order->image_path}}" class="img-responsive"></center>

                            </div>

                        </div>
                    </div>
                </div>

                @elseif ($order->status === 5)
                ชำระเงินเรียบร้อย หากไม่ได้รับของเกิน 7 วันโปรดติดต่อเจ้าหน้าที่พร้อม order_id

                @endif

                            </td>
                            <td>@if($user->room_number!=NULL)
            
                ห้อง {{$user->room_number}}
            @endif
            @if($user->floor!=NULL)
            ชั้น {{$user->floor}} 
            @endif
            @if($user->building!=NULL)
            อาคาร {{$user->building}} 
            @endif
            @if($user->address_no!=NULL)
            เลขที่ {{$user->address_no}} 
            @endif
            @if($user->street!=NULL)
            ถนน {{$user->street}} 
            @endif
            @if($user->sub_distinct!=NULL)
            แขวง/ตำบล {{$user->sub_distinct}} 
            @endif
            @if($user->distinct!=NULL)
            เขต/อำเภอ {{$user->distinct}} 
            @endif
            @if($user->provice!=NULL)
            จังหวัด {{$user->provice}} 
            @endif
            @if($user->zip_code!=NULL)
            รหัสไปรษณีย์ {{$user->zip_code}} 
            @endif</td>                   
                   
                        
                    

                @endif
            @endforeach
            </tbody>
        @endforeach
</table>


</div>
<hr class="tall" />


@stop