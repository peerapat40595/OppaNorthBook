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


<div class="container" ng-app="shop" ng-controller="ProductCtrl">



	<h2>Shop </h2>
	<ul class="nav nav-pills" ng-init="cat_id = '{{Input::get('category_id')}}'">
		<li ng-class="{active: isAll}"><a href="shop">All</a></li> 
		<li ng-repeat="category in categories" ng-class="{active: category.isCat}"><a href="shop?category_id=@{{category.id}}"> <span ng-bind="category.name"></span></a></li>
	</ul>

	<hr />

	<input ng-init="search='{{Input::get('search')}}'"  id="search" ng-focus="" ng-model="search" placeholder="product name..." class="form-control" >

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
			<li class="col-md-4 isotope-item websites" ng-repeat="product in products" ng-if="product.availability==1"> 
				<div class="portfolio-price-normal"> <span ng-bind="product.price"></span> ฿</div><!-- price --> 
				<div class="portfolio-item img-thumbnail ">        
					<a ng-click="retrieve_attribute(product.id)" href="#" class="thumb-info square" data-toggle="modal" data-target="#@{{product.id}}"> <!-- open -->    
						<img ng-if="product.product_pic!=='NULL'" alt="@{{product.name}}" class="img-responsive " ng-src="@{{product.product_pic}}" style-parent/> 
						<img ng-if="product.product_pic==='NULL'" alt="@{{product.name}}" class="img-responsive " src="img/projects/project-3.jpg"><!-- img --> 
						<span class="thumb-info-title"> 
							<span class="thumb-info-inner"> <span ng-bind="product.name"></span> </span><!-- name --> 
							<div class="thumb-info-type-box"><span class="thumb-info-type"> <span ng-bind="product.brand"></span></span></div><!-- brand --> 
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
                <div class="modal fade" id="@{{product.id}}" tabindex="-1" role="dialog" aria-labelledby="filterLabel" aria-hidden="true"> 
                	<div class="modal-dialog" > 
                		<div class="modal-content"> 
                			<div class="modal-header"> 
                				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
                				<h4 class="modal-title" id="filterLabel">@{{product.name}}</h4> 
                			</div> 
                			<div class="modal-body" > 
                				<div class="row"> 
                					<div class="col-md-6 "> 
                						<div  style="max-width:420px; max-height:420px; overflow:hidden"> 
                							<img alt="@{{product.name}}" class="img-responsive square-modal" ng-src="@{{product.product_pic}}" style-modal/><!-- img --> 
                						</div> 
                					</div> 
                					<div class="col-md-4 offset-md-6"> 
                						<span class="thumb-info-title modal-font"> 
                							<span class="thumb-info-inner">@{{ product.name }}</span><!-- name --> 
                							<div class="thumb-info-type-box"><span class="thumb-info-type">@{{ product.brand }} <br>price : @{{ product.price }} ฿ </br> <br>Description : @{{ product.description }}</br></span></div><!-- brand --> 
                						</span> 
                						
                						<form name='@{{ product.id }}' id='@{{ product.id }}'> 
                							
                							<div class="form-group" ng-repeat="att in atts"> 
                								@{{att.name}} 
                								<select ng-model="$parent.order_list.attribute[att.name]" ng-options="a for a in att.data" class="form-control modal-select"> 
                								</select> 
                							</div> 
                							<div class="form-group"> 
                								<span>Quantity : </span><input class="modal-input" type="number" ng-model="order_list['amount']">  
                							</div> 
                							
                						</form> 
                					</div> 
                				</div> 
                				
                				
                			</div> 
                			<!-- <p ng-repeat="(key,val) in order_list.attribute">@{{key}} : @{{val}}</p> --> 
                			@if(Auth::check())
                			<div class="modal-footer">
                				<button type="submit" ng-click="submit(product.id,product.name,{{Auth::user()->id}})" form="@{{ product.id }}" class="btn btn-primary" data-dismiss="modal">&nbsp&nbsp&nbsp&nbspสั่งซื้อ <i class="fa fa-shopping-cart fa-lg"></i>&nbsp&nbsp&nbsp&nbsp</button>
                			</div>

                			@else

                			<div class="modal-footer">
                				<a href="user/login"><button type="submit" form="@{{ product.id }}" class="btn btn-primary">&nbsp&nbsp&nbsp&nbspสั่งซื้อ <i class="fa fa-shopping-cart fa-lg"></i>&nbsp&nbsp&nbsp&nbsp</button></a>
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