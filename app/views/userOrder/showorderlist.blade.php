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
            <td>Title</td>
            <td>Picture</td>
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

        @foreach ($books as $book)
        @if($orderlist->book_id === $book->id)
        <td>{{$book->title}}
          
      </td>
      <td>{{ HTML::image($book->cover_pic, $book->title, array('class'=>'feature', 'style' => 'max-width:200px')) }}</td>
     
      @foreach ($category_all as $category)
      @if($book->category_id === $category->id)
      <td>{{$category->name}}</td>
      @endif
      @endforeach
      <td>{{$book->sell_price}} </td>
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
    <td>Total Cost</td>
    <td>{{number_format($sum, 2, '.', ',')}}</td>

</table>
 <a href="{{URL::to('doorder')}}"<button class="pull-right btn btn-default" > <i class="fa fa-chevron-circle-left"></i> กลับ</button></a>


</div>

</div>
@stop