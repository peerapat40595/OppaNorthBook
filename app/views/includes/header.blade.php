<div class="container">
	<h1 class="logo">
		<a href="{{URL::to('/')}}">
			<img alt="OppaNorthBook" src="<?php echo asset('img/oppanorth.png')?>">
		</a>
	</h1>
	<div class="search">
		<form id="searchForm" action="{{URL::to('shop')}}" method="get">
			<div class="input-group">
				<input type="text" class="form-control search" name="search" id="q" placeholder="Search...">
				<span class="input-group-btn">
					<button class="btn btn-default" type="submit"><i class="icon icon-search"></i></button>
				</span>
			</div>
		</form>
	</div>

	@if(Auth::check())
	<nav>
		<ul class="nav nav-top">
			<li>
				<a href="#">สวัสดีจ้า  	<b>{{ Confide::user()->username }}</b></a> 
			</li>
			
		</ul>
	</nav>

	@endif
	<button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
		<i class="icon icon-bars"></i>
	</button>
</div>
<div class="navbar-collapse nav-main-collapse collapse">
	<div class="container">

		<nav class="nav-main mega-menu">
			<ul class="nav nav-pills nav-main" id="mainMenu">
				<li class="dropdown" id="home">
					<a href="{{URL::to('/')}}">
						Home
					</a>
				</li>

				
				@if(Auth::check()&&Confide::user()->isadmin)
				<li class="dropdown">
					<a class="dropdown-toggle" href="#">
						Manage
						<i class="icon icon-angle-down"></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href="{{URL::to('manage_user')}}">User</a></li>
						<li><a href="{{URL::to('book')}}">Book</a></li>
						<li><a href="{{URL::to('checkorder')}}">Order</a></li>
						<li><a href="{{URL::to('posts')}}">Post</a></li>
					</ul>
				</li>

				@endif
				@if(Auth::check()&&Confide::user()->isadmin)
				<li class="dropdown">
					<a class="dropdown-toggle" href="#">
						Analytic
						<i class="icon icon-angle-down"></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href="{{URL::to('query/best-book-amount')}}">หนังสือที่ขายได้จำนวนเล่มเยอะสุด</a></li>
						<li><a href="{{URL::to('query/best-book-income')}}">หนังสือที่ขายทำยอดขายได้ยอะสุด</a></li>
						<li><a href="{{URL::to('query/best-publisher-income')}}">สำนักพิมพ์ที่ทำยอดขายได้เยอะที่สุด</a></li>
						<li><a href="{{URL::to('query/best-user-income')}}">User ที่ใช้จ่ายเงินซื้อหนังสือหนังสือกับเรามากที่สุด</a></li>
						<li><a href="{{URL::to('query/best-distinct-income')}}">จังหวัด/แขวงที่ผู้ใช้ ใช้จ่ายเงินกับทางเรามากที่สุด</a></li>
						<li><a href="{{URL::to('query/best-distinct-user')}}">จังหวัด/แขวงที่ผู้ใช้ ใช้ระบบเรามากที่สุด</a></li>
					</ul>
				</li>

				@endif

				<li class="dropdown">
					<a class="dropdown-toggle" href="#">
						Shop
						<i class="icon icon-angle-down"></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href="{{URL::to('/shop')}}">All</a></li>
						@foreach(Category::All() as $category)
						<li><a href="{{URL::to('/shop?category_id='.$category->id)}}">{{$category->name }}</a></li>
						@endforeach
					</ul>
				</li>

				@if(Auth::check())
				<li class="dropdown" id="home">
					<a href="{{URL::to('/shop/cart')}}">
						Cart
					</a>
				</li>
				<li>
					<a href="{{URL::to('doorder')}}">
						Order list
					</a>
				</li>
				<li>
					<a class="dropdown-toggle" href="{{URL::to('secrettips')}}">
						Secret Tips
					</a>
					
				</li>
				<li>
					<a href="{{URL::to('user/logout')}}">
						Logout
					</a>
				</li>
				@else

				<li>
					<a class="dropdown-toggle" href="{{URL::to('secrettips')}}">
						Secret Tips
					</a>
					
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" href="#">
						Login
						<i class="icon icon-angle-down"></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href="{{URL::to('user/login')}}">Login</a></li>
						<li><a href="{{URL::to('user/create')}}">Register</a></li>
					</ul>
				</li>
				@endif


				<li class="dropdown" id="home">
					<a href="{{URL::to('/about')}}">
						About
					</a>
				</li>
				<?php
				function curPageURL() {
					$pageURL = 'http';
					$pageURL .= "://";
					if ($_SERVER["SERVER_PORT"] != "80") {
						$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
					} else {
						$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
					}
					if(count($_GET)==0) $pageURL .= '?';
					else $pageURL .= '&';
					return $pageURL;
				}
				?>


			</ul>
		</nav>
	</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Share</h4>
			</div>
			<div class="modal-body">
				Share this link to get reference<br><br>

				<input value="<?php if(Auth::check()) echo curPageURL().'sp='.Auth::user()->sp_code ?>" class="form-control">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

			</div>
		</div>
	</div>
</div>
