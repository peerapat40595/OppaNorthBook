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
    <h1>User ที่ใช้จ่ายเงินซื้อหนังสือหนังสือกับเรามากที่สุด</h1>
    <!-- Button trigger modal -->

<table class="table table-striped table-bordered">
   
  <hr>
  <thead>
    <tr>
        <td>Rank</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Total Income</td>
        <td></td>
    </tr>
</thead>
<tbody>
  <?php $i=1 ?>
  @foreach ($books as $book)
        <?php $user = User::find($book->user_id)?>
        <td>{{ $i }}</td>
        <td>{{ $user->firstname }}</td>
        <td>{{ $user->lastname }}</td>
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