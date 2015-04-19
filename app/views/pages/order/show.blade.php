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

@include('pages.product.frac.nav')

		<h1>Showing {{ $product->name }}</h1>

		<div class="jumbotron text-center">
			<h2>{{ $product->name }}</h2>
			<p>
				 {{ HTML::image('/img/products/'.$product->product_pic, $product->name) }} <br>
				<strong>Name:</strong> {{ $product->name }}  <br>
				<strong>Price:</strong> {{ $product->price }} ฿<br>
				<strong>Brand:</strong> {{{ Brand::find($product->brand_id)->name }}}<br>
				<strong>Category:</strong> {{{ Category::find($product->category_id)->name }}}<br>
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