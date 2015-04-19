@extends('layouts.default')

@section('meta')
	<meta name="keywords" content="HTML5 Template" />
	<meta name="description" content="Porto - Responsive HTML5 Template - 2.5.0">
	<meta name="author" content="okler.net">
@stop

@section('title')
	test
@stop

@section('content')
	
	<div class="container">
	
	<div class="col-md-4 col-md-offset-4">
		<div class="page-header">
			<h1>Login</h1>
		</div>

		<form action="{{ URL::to('images/save') }}" method="post" enctype="multipart/form-data">

			<fieldset>
				<div class="form-group">
					<label for="image">upload image</label>
					<input class="form-control" name="image" type="file" />
				</div>

				<div class="form-group">
					<button tabindex="3" type="submit" class="btn btn-primary btn-lg btn-block">submit</button>
				</div>
			</fieldset>
		</form>

		



	</div>

</div>

@stop