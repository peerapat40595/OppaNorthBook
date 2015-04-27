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
    <h1>จังหวัด/แขวงที่ผู้ใช้ ใช้ระบบเรามากที่สุด</h1>
    <!-- Button trigger modal -->

<table class="table table-striped table-bordered">
   
  <hr>
  <thead>
    <tr>
        <td>Rank</td>
        <td>Distinct</td>
        <td>Provice</td>
        <td>Total User</td>
        <td></td>
    </tr>
</thead>
<tbody>
  <?php $i=1 ?>
  @foreach ($books as $book)
        <td>{{ $i }}</td>
        <td></td>
        <td>{{ $book->provice }}</td>
        <td>{{ $book->amount}}</td>
</tr>
<?php $i++?>
@endforeach
</tbody>
</table>


</div>
<hr class="tall" />

@stop