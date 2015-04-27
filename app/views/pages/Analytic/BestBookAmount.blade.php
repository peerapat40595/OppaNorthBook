@extends('layouts.default')

@section('meta')
<meta name="keywords" content="OppaNorthBook" />
<meta name="description" content="">
<meta name="author" content="DBOppaNorth">
@stop

@section('title')
Books
@stop

@section('content')
<div class="container">


    <br>
    <h1>หนังสือที่ขายได้จำนวนเล่มเยอะสุด</h1>
    <!-- Button trigger modal -->

<table class="table table-striped table-bordered">
   
  <hr>
  <thead>
    <tr>
        <td>Rank</td>
        <td>ID</td>
        <td>Title</td>
        <td>Picture</td>
        <!-- <td>Brand</td> -->
        <td>Sell Price</td>
        <td>Amount</td>
        <td></td>
    </tr>
</thead>
<tbody>
  <?php $i=1 ?>
  @foreach ($books as $book)
        <td>{{ $i }}</td>
        <td>{{ $book->book_id }}</td>
        <td>{{ $book->title }}</td>
        <td><img style="max-height: 200px; max-width: 200px;" src="{{$book->cover_pic}}"/></td> <!--pic-->
        <td>{{ $book->sell_price}}</td>
        <td>{{ $book->grand_amount}}</td>
       

    <td>



        <a class="btn btn-success btn-block" href="../book/{{$book->book_id}}" target="_blank">Show</a>

        <a class="btn btn-info  btn-block" href="../book/{{$book->book_id}}/edit">Edit</a>

        <a class="btn btn-warning  btn-block" click="delete_book($book->book_id, $book->title)">Delete</a>


    </td>
</tr>
<?php $i++?>
@endforeach
</tbody>
</table>


</div>
<hr class="tall" />

@stop