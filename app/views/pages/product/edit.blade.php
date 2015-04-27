@extends('layouts.default')

@section('meta')
<meta name="keywords" content="OppaNorthBook" />
<meta name="description" content="">
<meta name="author" content="DBOppaNorth">
@stop

@section('title')
Edit
@stop

@section('content')
<div class="container" ng-app="attribute">


    @include('pages.book.frac.nav')

    <div class="col-md-6 col-md-offset-3" style="margin-top:10px">
        <h1>Edit Product</h1>

        <!-- if there are creation errors, they will show here -->
        {{ HTML::ul($errors->all()) }}

        {{ Form::model($product, array('route' => array('product.update', $product->id), 'method' => 'PUT', 'files'=> true)) }}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'id' => 'form')) }}
        </div>

        <div class="form-group">

           {{ Form::label('product_pic', 'Image :') }} 
           <!-- {{ Form::file('product_pic' , Input::old('product_pic'), array('class' => 'form-control'))}} -->
           <pre>
               <img src="{{asset($product->product_pic)}}" style="max-height: 500px; max-width: 500px;"> <br><br>
               <input type="radio" name="img_selc" ng-model="img_selc" value="text" checked="checked"/>  URL &nbsp&nbsp
               <input type="radio" name="img_selc" ng-model="img_selc" value="file"> Upload <br/>
               <input ng-if="img_selc=='text'" name="product_pic" type="text" class="form-control" value="{{$product->product_pic}}">
               <input ng-if="img_selc=='file'" name="product_pic" type="file" class="form-control" value="{{Input::old('product_pic')}}">
           </pre>
       </div>
       <div class="form-group">
        {{ Form::label('price', 'Price') }}
        <div class="input-group">
            {{ Form::text('price', Input::old('price'), array('class' => 'form-control')) }}
            <span class="input-group-addon">฿</span>
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('Description', 'Description') }}
        {{ Form::textarea('description', $product->description , array('class' => 'form-control', 'placeholder' => 'Description')) }}
    </div>

    <div class="form-group">
        {{ Form::label('brand', 'Brand') }}
        <select name="brand" id="brand" class="form-control">
            <option value=null>Select brand</option>
            @foreach($brand_all as $brand)


            <option value="{{$brand->id}}" 
                <?php if ($product->brand_id == $brand->id) echo "selected =\"selected\" "; ?>
                >{{$brand->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {{ Form::label('category', 'Category') }}
            <select name="category" id="category" class="form-control">
                <option value=null>Select category</option>
                @foreach($category_all as $category)
                <option value="{{$category->id}}"
                    <?php if ($product->category_id == $category->id) echo "selected =\"selected\" "; ?>
                    >{{$category->name}}</option>
                    @endforeach
                </select>
            </div>



            <div ng-controller="AttCtrl" ng-init='types={{json_encode($atts)}}'>
                <div ng-repeat="type in types"> 
                    <h5>@{{type.name}} <a ng-click="delete_type($index)" style="font-size:8px;">(del)</a></h5>
                    <input type="hidden" name="@{{'type_'+$index}}" value="@{{type.name}}">
                    <div ng-repeat="att in type.data">
                        <a><i class="fa fa-times" ng-click="delete(type.name,att)"></i></a> @{{att}} <br>
                        <input type="hidden" name="@{{'att_'+$parent.$index+$index}}" value="@{{att}}">
                    </div>
                    <input type="text" ng-model="new_att" ng-enter="add_att(type.name,new_att); new_att='';">
                    <a><i class="fa fa-plus-circle fa-lg" ng-click="add_att(type.name,new_att); new_att='';"></i></a>
                    <br><br>
                </div>

                <a ng-click="add_type()">new property</a>
                <hr>

                {{ Form::submit('Edit', array('class' => 'btn btn-primary btn-lg btn-block')) }}

                {{ Form::close() }}
            </div>

        </div>
        <hr class="tall" />

        @stop