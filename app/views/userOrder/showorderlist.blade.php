@extends('layouts.default')

@section('content')
<div class='container'>
<div class="col-md-10 col-md-offset-1" ng-app>

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
            <td>ID</td>
            <td>Name</td>
            <td>Picture</td>
            <td>Brand</td>
            <td>Category</td>
            <td>Price</td>
            <td>Amount</td>
            <td>Total</td>
        </tr>
    </thead>
    <tbody>
        <?php $i=1;$sum=0; ?>
        @foreach ($orderlists as $orderlist)
        <td>{{ $i }}</td>

        @foreach ($products as $product)
        @if($orderlist->product_id === $product->id)
        <td>{{$product->name}}
          @if(!is_null($orderlist->order_list_attribute()->get()))
          @foreach($orderlist->order_list_attribute()->get() as $ol)
          {{$ol->type}} {{$ol->name}} 
          @endforeach
          @endif
      </td>
      <td>{{ HTML::image($product->product_pic, $product->name, array('class'=>'feature', 'style' => 'max-width:200px')) }}</td>
      @foreach ($brand_all as $brand)
      @if($product->brand_id === $brand->id)
      <td>{{$brand->name}}</td>
      @endif
      @endforeach
      @foreach ($category_all as $category)
      @if($product->category_id === $category->id)
      <td>{{$category->name}}</td>
      @endif
      @endforeach
      <td>{{$product->price}} </td>
      @endif

      @endforeach
      <td>{{ $orderlist->amount }}</td>
      <td>{{ $orderlist->total_cost }}<?php $sum=$sum+$orderlist->total_cost; ?></td>    
      @if ($order->status === 0) 
      <td> {{ Form::open(array('url'=>'doorder/delete-orderlist/'.$orderlist->id,'method'=>'GET')) }}
        <button type="submit" class="btn btn-warning  btn-block" >
            Delete
        </button>
        {{ Form::close() }}</td>
        @endif

    </tbody>
    <?php $i++; ?>
    @endforeach
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>Total Cost</td>
    <td>{{number_format($sum, 2, '.', ',')}}</td>

</table>
 <a href="{{URL::to('doorder')}}"<button class="pull-right btn btn-default" > <i class="fa fa-chevron-circle-left"></i> กลับ</button></a>


</div>

</div>
@stop