@extends('layouts.default')

@section('content')
<div class="col-md-12">
	<div class="col-lg-8">
		<hr>
		<h1>{{ $post->title }}</h1>
		<hr>
		<p><span class="glyphicon glyphicon-time"></span> Posted {{ $date }}</p>
		<!--test time<?php printf("Right now is %s", \Carbon\Carbon::now()->toDateTimeString()); ?>-->
		<hr>
		<p class="lead">{{ $post->body }}</p>
	</div>

	<div class="col-lg-4">
		<div class="well">
			<legend>What would you like to do next?</legend>
			{{ link_to_route('posts.edit', 'Update', array($post->id), array('class' => 'btn btn-primary')) }}
			{{ link_to_route('posts.index', 'Back to index', null, array('class' => 'btn btn-warning')) }}
		</div>
	</div>
</div>
@stop