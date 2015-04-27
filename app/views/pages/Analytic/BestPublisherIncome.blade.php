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
    <h1>สำนักพิมพ์ที่ทำยอดขายได้เยอะที่สุด</h1>
    <!-- Button trigger modal -->

<table class="table table-striped table-bordered">
   
  <hr>
  <thead>
    <tr>
        <td>Rank</td>
        <td>Name</td>
        <td>Total Income</td>
        <td></td>
    </tr>
</thead>
<tbody>
  <?php $i=1 ?>
  @foreach ($books as $book)
        <td>{{ $i }}</td>
        <td>{{ $book->publisher_name }}</td>
        <td>{{ $book->grand_cost}}</td>
    </td>
</tr>
<?php $i++?>
@endforeach
</tbody>
</table>


</div>
<hr class="tall" />

@stop