@extends('layouts.default')

@section('content')

<div class="col-md-12" ng-app>
    <div class="col-md-8 col-md-offset-2">
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
                <td>Status</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
             @if($order->status === 2)
             <tr class="danger">
            @elseif($order->status === 3)
            <tr class="active">
                @elseif ($order->status === 4)
                <tr class="info">
                    @elseif ($order->status === 5)
                    <tr class="success">
                    @else
                    <tr>
                    @endif
                    <td>{{ $order->id }}</td>
                    <td>


                        @if ($order->status === 1)
                        รอยืนยันที่อยู่นะจ๊ะ คลิก ที่ ปุ่ม Address เลยจ้าาา
                        {{ Form::open(array('url'=>'doorder/user-address/'.$order->id,'method'=>'GET')) }}
                        <button type="submit" class="btn btn-success  " >
                            Address
                        </button>
                        {{ Form::close() }}
                        @elseif ($order->status === 2)
                        โดนลบแล้วจ้าาาา สั่งมาใหม่น้าาาา
                        @elseif ($order->status === 3)
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
                ชำระเงินเรียบร้อย หากไม่มีทีมงานติดต่อโปรดแจ้ง xxxx พร้อม order_id

                @endif

            </td>


            <td> {{ Form::open(array('url'=>'doorder/show-orderlist/'.$order->id,'method'=>'GET')) }}
                <button type="submit" class="btn btn-success  " >
                    Show Order List
                </button>
                @if ($order->status === 0) 
                {{ Form::close() }}
                {{ Form::open(array('url'=>'doorder/delete-order/'.$order->id,'method'=>'GET')) }}
                <button type="submit" class="btn btn-warning   " >
                    Delete 
                </button>
                {{ Form::close() }}
            </td>
            @endif
        </tr>

        @endforeach
    </tbody>
</table>
</div>

</div>
<hr class="tall" />
@stop