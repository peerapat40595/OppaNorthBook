@extends('layouts.default')

@section('meta')
<meta name="keywords" content="OppaNorthBook" />
<meta name="description" content="">
<meta name="author" content="DBOppaNorth">
@stop

@section('title')
Shop
@stop

@section('content')


<div class="container" ng-app="shop" ng-controller="BookCtrl">



	<h2>Shop </h2>
	<ul class="nav nav-pills" ng-init="cat_id = '{{Input::get('category_id')}}'">
		<li ng-class="{active: isAll}"><a href="shop">All</a></li> 
		<li ng-repeat="category in categories" ng-class="{active: category.isCat}">
           <a  href="shop?category_id=@{{category.id}}"> <span ng-bind="category.name"></span></a>
           
        </li>
	</ul>

	<hr />

	<input ng-init="search='{{Input::get('search')}}'"  id="search" ng-focus="" ng-model="search" placeholder="book name..." class="form-control" >

	<div>
		<ul class="pager">
			<li class="previous" ng-click="prev()"><a href="">&larr; Previous</a></li>
			<li>Pages :  <span ng-bind="currentPage"></span> /  <span ng-bind="total"></span></li>
			<li class="next" ng-click="next()"><a href="">Next &rarr;</a></li>
		</ul>
	</div>

	<hr />

	<div class="row" href="#top">

		
		<ul class="portfolio-list sort-destination" data-sort-id="portfolio"> 
			
			<!-- ngrepeat --> 
			<li class="col-md-4 isotope-item websites" ng-repeat="book in books" ng-if="book.availability==1"> 
				<div class="portfolio-price-normal"> <span ng-bind="book.sell_price"></span> ฿</div><!-- price --> 
				<div class="portfolio-item img-thumbnail ">        
					<a ng-click="retrieve_attribute(book.id)" href="#" class="thumb-info square" data-toggle="modal" data-target="#@{{book.id}}"> <!-- open -->    
						<img ng-if="book.cover_pic!=='NULL'" alt="@{{book.title}}" class="img-responsive " src="@{{book.cover_pic}}" style-parent/> 
						<img ng-if="book.cover_pic==='NULL'" alt="@{{book.title}}" class="img-responsive " src="http://www.gordini.ca/static/img/image_not_available.gif"><!-- img --> 
						<span class="thumb-info-title"> 
							<span class="thumb-info-inner"> <span ng-bind="book.title"></span> </span><!-- name --> 
							<!-- <div class="thumb-info-type-box"><span class="thumb-info-type"> <span ng-bind="book.brand"></span></span></div> brand -->  
						</span> 
						<span class="thumb-info-action"> 
                        <!--     <div class="thumb-info-action-div"> 
                                <i class="icon icon-search"></i>  Preview 
                            </div> --> 
                            <span title="Buy Me!" href="#" class="thumb-info-action-icon"><i class="icon icon-shopping-cart"></i></span> 
                        </span> 
                        
                    </a> 
                    
                </div> 
                

                <!-- Modal --> 
                <div class="modal fade" id="@{{book.id}}" tabindex="-1" role="dialog" aria-labelledby="filterLabel" aria-hidden="true"> 
                	<div class="modal-dialog" > 
                		<div class="modal-content"> 
                			<div class="modal-header"> 
                				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
                				<h4 class="modal-title" id="filterLabel"><strong>@{{book.title}}</strong></h4>

                			</div> 
                			<div class="modal-body" > 
                				<div class="row"> 
                					<div class="col-md-6 "> 
                						<div  style="max-width:420px; max-height:600px; overflow:hidden"> 
                							<img alt="@{{book.title}}" class="img-responsive square-modal" ng-src="@{{book.cover_pic}}" style-modal/><!-- img --> 
                						</div> 
                					</div> 
                					<div class="col-md-4 offset-md-6"> 
                						<span class="thumb-info-title modal-font"> 
                							<span class="thumb-info-inner"><h4><strong>@{{ book.title }}</strong></h4></span><!-- name --> 
                							<div class="thumb-info-type-box"><span class="thumb-info-type">
                                            <strong><br>ISBN :</strong> @{{book.ISBN}}
                                            <span ng-if="book.barcode!=NULL">
                                            <strong><br>Barcode :</strong> @{{book.barcode}}
                                            </span>
                                            <br>
                                            <strong>Author :</strong>
                                                <span ng-repeat-start="author in book.author"></span>
                                                @{{author.prefix}} @{{author.first_name}} @{{author.last_name}} @{{author.pseudonym}}
                                                <span ng-repeat-end></span>
                                            <br>
                                            <strong>Translator :</strong>
                                                <span ng-repeat-start="translator in book.translator"></span>
                                                 @{{translator.prefix}} @{{translator.first_name}} @{{translator.last_name}} @{{translator.pseudonym}}
                                                <span ng-repeat-end></span>
                                            <span ng-if="book.page!=NULL">
                                            <strong><br>Page :</strong> @{{book.page}}
                                            </span>
                                            <span ng-if="book.width!=NULL">
                                            <strong><br>Size :</strong> @{{book.width}} X @{{book.high}} X @{{book.deep}} mm.
                                            </span>
                                            <span ng-if="book.weight!=NULL">
                                            <strong><br>Weight :</strong> @{{book.weight}}
                                            </span>
                                            <span ng-if="book.type!=NULL">
                                            <strong><br>Type :</strong> @{{book.type}}
                                            </span>
                                            <span ng-if="book.publisher_name!=NULL">
                                            <strong><br>Publisher Name :</strong> @{{book.publisher_name}}
                                            </span>
                                            <span ng-if="book.description!=NULL">
                                            <strong><br>Description :</strong> @{{ book.description }}
                                            </br>
                                            </span>
                                        <br>
                                                <strong>Cover price :</strong> <s>@{{ book.cover_price }}</s> ฿ 
                                        <br>
                                                <strong>Sell price :</strong> @{{ book.sell_price }} ฿ 
                                        </div><!-- brand --> 
                						</span> 
                						 
                						<form name='@{{ book.id }}' id='@{{ book.id }}'> 
                							<div class="form-group"> 
                								<strong><span>Quantity : </span></strong><input class="modal-input" type="number" ng-model="order_list['amount']">  
                							</div> 
                							
                						</form>
                                        <br>
                                                <strong>Tags :</strong>
                                                <span ng-repeat-start="tag in book.tag"></span>
                                                @{{tag.name}}
                                                <span ng-repeat-end></span>
                                            
                                            <br> 
                                        <br>
                                                <strong>Category :</strong>
                                                @{{book.category.name}}
                                            
                                            <br> 
                					</div> 
                				</div> 
                				
                				
                			</div> 
                			<!-- <p ng-repeat="(key,val) in order_list.attribute">@{{key}} : @{{val}}</p> --> 
                			@if(Auth::check())
                			<div class="modal-footer">
                				<button type="submit" ng-click="submit(book.id,book.title,{{Auth::user()->id}})" form="@{{ book.id }}" class="btn btn-primary" data-dismiss="modal">&nbsp&nbsp&nbsp&nbspสั่งซื้อ <i class="fa fa-shopping-cart fa-lg"></i>&nbsp&nbsp&nbsp&nbsp</button>
                			</div>

                			@else

                			<div class="modal-footer">
                				<a href="user/login"><button type="submit" form="@{{ book.id }}" class="btn btn-primary">&nbsp&nbsp&nbsp&nbspสั่งซื้อ <i class="fa fa-shopping-cart fa-lg"></i>&nbsp&nbsp&nbsp&nbsp</button></a>
                			</div>
                			@endif
                		</div> 
                	</div> 
                </div> 
            </li>  
            
            
            
            
        </ul> 
    </div>
    <ul class="pager">
        <a class="scroll-to-top" href="#top"><li class="previous" ng-click="prev()"><a href="">&larr; Previous</a></li></a>
        <li>Pages :  <span ng-bind="currentPage"></span> /  <span ng-bind="total"></span></li>
        <a class="scroll-to-top" href="#top"><li class="next" ng-click="next()"><a href="">Next &rarr;</a></li></a>
    </ul>   
</div>

</div> 



</div>

</div>



<hr class="tall" />



@stop