@extends('layouts.default')

@section('meta')
<meta name="keywords" content="OppaNorthBook" />
<meta name="description" content="">
<meta name="author" content="DBOppaNorth">
@stop

@section('title')
Cart
@stop

@section('content')
<div class="container">
  <div class='row'>
    <div class="col-md-8 col-md-offset-2 ">

      <div class="page-header">
        <h1>Cart</h1>
      </div>

      @if ( Session::get('error') )
      <div class="alert alert-error alert-danger">

        {{ Session::get('error') }}

      </div>
      @endif

      @if ( Session::get('notice') )
      <div class="alert alert-info">{{ Session::get('notice') }}</div>
      @endif
      <?php $sum=0?>
      <table class="table table-striped">
        @if($order_list)
        @foreach($order_list as $order)
        <div class='row'>
          <div class="col-md-4">
            <img  alt="{{$order->book->title}}" class="img-responsive" src="{{$order->book->cover_pic}}">
          </div>

          <div class="col-md-8">
            <button class="pull-right btn btn-default" data-toggle="modal" data-target="#{{$order->id}}">Delete</button>

            <div class="modal fade" id="{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="filterLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="filterLabel">ทำการลบ</h4>
                  </div>
                  <div class="modal-body">
                    ลบ {{$order->book->title}}
                  
                    <br>
                    แน่ใจแล้วนะ ?

                  </div>
                  <form action="{{URL::to('shop/deleteorder/'.$order->id)}}" method="POST">
                  <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">ตกลง</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>

           

            <dl>
              <dt>Book</dt>
              <dd>{{$order->book->title}}
               
              </dd>
            </dl>
            <dl>
              <dt>Price</dt>
              <dd>
                {{$order->book->sell_price}} ฿
              </dd>
            </dl>    
            <dl>
              <dt>Amount</dt>
              <dd>
                {{$order->amount}}
              </dd>
            </dl>
            <dl>
              <dt>Total cost</dt>
              <dd>
                {{$order->total_cost}} ฿
                <?php $sum += $order->total_cost ?>
              </dd>
            </dl>    
          </div>
        </div>
        <hr>

        @endforeach

              <span class="pull-right"><strong>Grand total:</strong> {{$sum}} ฿ <br>
                <button class="pull-right btn btn-success" data-toggle="modal" data-target="#confirm">ยืนยัน <i class="fa fa-check-circle-o"></i></button>

              </span>


        
        <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="filterLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="filterLabel">เลิอกสถานที่รับของ</h4>
              </div>
              <div class="modal-body">
                สะดวกรับของที่ไหนดีคะ
                <form id="loc" method="POST" action="{{URL::to('/shop/cart/confirm/'.$orderall->id)}}">
                  <select multiple class="form-control" form="loc" name="recv_location">
                    <option value="ออฟฟิศบริษัทจำลองจุฬา">ออฟฟิศบริษัทจำลองจุฬา</option>
                    <option value="จามจุรีสแควร์">จามจุรีสแควร์</option>
                    <option value="สยาม">สยาม</option>

                  </select>

                </div>

                <div class="modal-footer">
                  <a href=""><button type="submit" form="loc" class="btn btn-success">ตกลง</button></a>
                </div>

              </div>
            </div>
          </div>
          @else
          <center><h2>คุณยังไม่ได้เลือกสินค้าเลย ลอง<a href="{{URL::to('/shop')}}">เลือกซื้อ</a>ดูก่อนนะคะ :D</h1></center>
          @endif

        </table>


      </div>
    </div>
  </div>
  <hr class="tall" />
  @stop