<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8" > <![endif]-->
<!--[if IE 9]>			<html class="ie ie9" > <![endif]-->
<!--[if gt IE 9]><!-->	
<html> <!--<![endif]-->
<head>
	@include('includes.head')
	<meta charset='utf-8'>
	@yield('meta')
	<title>
		@yield('title')
	</title>
	
</head>
<body>
	<div class="body">
		
		<header>
			@include('includes.header')
		</header>
		<div role="main" class="main">	
			
			@yield('content')
		</div>
		@include('includes.footer')
		

	</div>
	@include('includes.libs')
</body>
</html>