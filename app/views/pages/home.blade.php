@extends('layouts.default')

@section('meta')
<meta name="keywords" content="" />
<meta name="description" content="fashion and cosmetic">
<meta name="author" content="">
@stop

@section('title')
OppaNorth Bookstore
@stop


@section('content') 
@include('frac.home.slider') 
<br/> <br/> <br/> 
<div class="container"> 


    <div class="row center"> 
        <div class="col-md-12 "> 

            <!------ What's Hot ------> 
            <div style="padding-bottom:10px;"> 
                <h2 class="home-title">   What's <strong style="color:#e74c3c;">HOT!!!</strong></h2> 
                <ul class="portfolio-list sort-destination full-width isotope " data-sort-id="portfolio"> 
                    <li class="no-transition "> 
                        <div class="portfolio-item img-thumbnail "> 
                            <form id='1' action="{{URL::to('shop')}}" method="get">
                                <input type="hidden" name="search" value="test">
                                <a href="#" onclick="document.forms['1'].submit(); return false;" class="thumb-info secundary "> 
                                    <img alt="" class="img-responsive " src="<?php echo asset('img/oppanorth.png')?>" > 
                                    <span class="thumb-info-rank no1"> 
                                        1 
                                    </span> 
                                   
                                    <span class="thumb-info-action"> 
                                        <span title="Universal" href="#" class="thumb-info-action-icon"><i class="icon icon-shopping-cart"></i></span> 
                                    </span> 
                                </a> 
                            </form>
                        </div> 
                    </li> 

                    <li class="no-transition "> 
                        <div class="portfolio-item img-thumbnail "> 
                            <form id='2' action="{{URL::to('shop')}}" method="get">
                                <input type="hidden" name="search" value="test">
                                <a href="#" onclick="document.forms['2'].submit(); return false;" class="thumb-info secundary "> 
                                    <img alt="" class="img-responsive " src="<?php echo asset('img/oppanorth.png')?>" > 
                                    <span class="thumb-info-rank no1"> 
                                        2 
                                    </span> 
                                    
                                    <span class="thumb-info-action"> 
                                        <span title="Universal" href="#" class="thumb-info-action-icon"><i class="icon icon-shopping-cart"></i></span> 
                                    </span> 
                                </a> 
                            </form>
                        </div> 
                    </li>                    
                    <li class="no-transition "> 
                        <div class="portfolio-item img-thumbnail "> 
                            <form id='3' action="{{URL::to('shop')}}" method="get">
                                <input type="hidden" name="search" value="test">
                                <a href="#" onclick="document.forms['300'].submit(); return false;" class="thumb-info secundary "> 
                                    <img alt="" class="img-responsive " src="<?php echo asset('img/oppanorth.png')?>" > 
                                    <span class="thumb-info-rank no1"> 
                                        3 
                                    </span> 
                                    
                                    <span class="thumb-info-action"> 
                                        <span title="Universal" href="#" class="thumb-info-action-icon"><i class="icon icon-shopping-cart"></i></span> 
                                    </span> 
                                </a> 
                            </form>
                        </div> 
                    </li> 


                </ul> 
            </div> 
            <hr class="tall" /> 
            <!------ Blog Post ------> 
            <h2 class="home-title">   Lastest <a href="{{URL::to('secrettips')}}"><strong style="color:#e74c3c;">Secret Tip</strong></a> </h2> 
            <div class="lastest-blog-post"> 

                <div class="col-md-8 lastest-blog-post-word"> 
                    @if(!is_null($post))
                    <a href="{{URL::to('secrettips/tip/'.$post->id)}}"> 
                        <span ><h4>{{$post->title}} </h4></span>  
                    </a> 
                    <span>Date : {{$date}}</span> 
                    <div class="content"> 
                        <span >{{substr($post->body,0,300)}}</span> 
                        <a href="{{URL::to('secrettips/tip/'.$post->id)}}" class="btn btn-xs btn-primary">Read more...</a> 
                    </div> 
                    @else
                    <h4>COMING SOON...</h4>
                    @endif
                </div>                     
            </div> 


        </div> 


        <hr class="tall" /> 
        <!------Announcement------> 
        <div class="col-md-12"> 
            <div class="recent-posts"> 
                <h2 style="color:#e74c3c;"><strong>Annoucement</strong> </h2> 
                <div class="row"> 
                    <div class="owl-carousel owl-carousel-spaced" data-plugin-options='{"items": 2, "singleItem": true, "autoHeight": true}'> 
                        <div> 
                            <div class="col-md-12"> 
                                <article> 
                            <!-- <div class="date"> 
                                <span class="day">15</span> 
                                <span class="month">Jan</span> 
                            </div>  -->
                            <h4>เร็วๆนี้!!</h4> 
                            <p>เรียนลูกค้าทุกท่าน ตอนนี้ทงเรากำลังทยอยลงสินค้าอยู่นะคะ สามารถดูสินค้าทั้งหมดแบบสมบูรณ์ได้ในวันพฤหัสที่ <strong>30 เมษายนนี้</strong></p>
                            <p>ขอบคุณที่ใช้บริการค่ะ :D</p> 
                        </article> 
                    </div> 

                    <!--one more-->
                </div> 

            </div> 
        </div> 
    </div> 
</div> 
</div> 

@stop