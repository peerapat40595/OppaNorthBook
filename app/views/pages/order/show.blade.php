@extends('layouts.default')

@section('meta')
<meta name="keywords" content="OppaNorthBook" />
<meta name="description" content="">
<meta name="author" content="DBOppaNorth">
@stop

@section('title')
{{ $book->name }}
@stop

@section('content')

<div class="container">

@include('pages.book.frac.nav')

		<h1>Showing {{ $book->name }}</h1>

		<div class="jumbotron text-center">
			<h2>{{ $book->name }}</h2>
			<p>
				 {{ HTML::image('/img/books/'.$book->book_pic, $book->name) }} <br>
				<strong>Name:</strong> {{ $book->name }}  <br>
				<strong>Price:</strong> {{ $book->price }} ฿<br>
				<strong>Brand:</strong> {{{ Brand::find($book->brand_id)->name }}}<br>
				<strong>Category:</strong> {{{ Category::find($book->category_id)->name }}}<br>
				<br>
				@foreach($atts as $att)
					<strong>{{$att['name']}} :</strong>
					<ul class="list-inline">
						@foreach($att['data'] as $value)
							<li>{{$value}}</li>
						@endforeach
					</ul>
				@endforeach
			</p>
		</div>

	</div>

	<hr class="tall" />
	
	@stop