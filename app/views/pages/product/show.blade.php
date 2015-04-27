@extends('layouts.default')

@section('meta')
<meta name="keywords" content="OppaNorthBook" />
<meta name="description" content="">
<meta name="author" content="DBOppaNorth">
@stop

@section('title')
{{ $product->name }}
@stop

@section('content')

<div class="container">

@include('pages.book.frac.nav')

		<h1>Showing {{ $product->name }}</h1>

		<div class="jumbotron text-center">
			<h2>{{ $product->name }}</h2>
			<p>
				 <img src="{{asset($product->product_pic)}}" style="max-height: 500px; max-width: 500px;"> <br><br>
				<strong>Name:</strong> {{ $product->name }}  <br>
				<strong>Price:</strong> {{ $product->price }} ฿<br>
				<strong>Brand:</strong> {{{ Brand::find($product->brand_id)->name }}}<br>
				<strong>Category:</strong> {{{ Category::find($product->category_id)->name }}}<br>

				@if(!is_null($product->description))
					<strong>Description:</strong> 
					<pre>{{$product->description}}</pre>
				@endif
				
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