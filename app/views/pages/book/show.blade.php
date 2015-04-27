@extends('layouts.default')

@section('meta')
<meta name="keywords" content="OppaNorthBook" />
<meta name="description" content="">
<meta name="author" content="DBOppaNorth">
@stop

@section('title')
{{ $book->title }}
@stop

@section('content')

<div class="container">

@include('pages.book.frac.nav')

		<h1>Showing {{ $book->title }}</h1>

		<div class="jumbotron text-center">
			<h2>{{ $book->title }}</h2>
			<p>
				 <img src="{{asset($book->cover_pic)}}" style="max-height: 500px; max-width: 500px;"> <br><br>
				<strong>Title:</strong> {{ $book->title }}  <br>
				<strong>Translator:</strong> 
				@foreach($book->translator as $translator )
				{{{ $translator->prefix}}}{{{ $translator->first_name}}} {{{ $translator->last_name}}}{{{ $translator->pseudonym}}}<tr>
				@endforeach
				<br>
				<strong>Author:</strong> 
				@foreach($book->author as $author )
				{{{ $author->prefix}}}{{{ $author->first_name}}} {{{ $author->last_name}}}{{{ $author->pseudonym}}}<tr>
				@endforeach
				<br>
				<strong>ISBN:</strong> {{ $book->ISBN }}  <br>
				<strong>Barcode:</strong> {{ $book->barcode }}  <br>
				<strong>Page:</strong> {{ $book->page }}  <br>
				<strong>Size:</strong> {{ $book->width }} X  {{ $book->high }} X {{ $book->deep }} mm.  <br>
				<strong>Weight:</strong> {{ $book->weight }}  <br>
				<strong>Type:</strong> {{ $book->type }}  <br>
				<strong>Publisher Name:</strong> {{ $book->publisher_name }}  <br>
				<strong>Cover Price:</strong> <s>{{ $book->cover_price }}</s> ฿<br>
				<strong>Sell Price:</strong> {{ $book->sell_price }} ฿<br>
				<strong>Category:</strong> {{{ Category::find($book->category_id)->name }}}<br>
				<strong>Sub Category:</strong> {{{ SubCategory::find($book->sub_category_id)->name }}}<br>
				<strong>Tag:</strong> 
				@foreach($book->tag as $tag )
				{{{ $tag->name}}}<tr>
				@endforeach
				<br>
				@if(!is_null($book->description))
					<strong>Description:</strong> 
					<pre>{{$book->description}}</pre>
				@endif
				
				<br>
				
			</p>
		</div>

	</div>

	<hr class="tall" />
	
	@stop