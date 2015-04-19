@extends('layouts.default')

@section('content')
<br>
<div class="container">
	<div class="col-md-8 col-md-offset-2">

		<span class="label label-info pull-right">{{ $date }}</span>

		<h1>{{ $post->title }}</h1>

		<p class="lead">{{ $post->body }}</p>

	</div>
</div>
@stop