@extends('layouts.default')

@section('meta')
<meta name="keywords" content="OppaNorthBook" />
<meta name="description" content="">
<meta name="author" content="DBOppaNorth">
@stop

@section('title')
Create Book
@stop

@section('content')
<div class="container" ng-app="attribute">


    @include('pages.book.frac.nav')

    <!-- will be used to show any messages -->
    @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="col-md-6 col-md-offset-3" style="margin-top:10px">
        <h1>Create a Book</h1>

        <!-- if there are creation errors, they will show here -->
        {{ HTML::ul($errors->all()) }}


        {{ Form::open(array('url' => 'book','files'=>true ))}}

        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title','', array('class' => 'form-control', 'id' => 'form')) }}
        </div>


        <div class="form-group">

           {{ Form::label('cover_pic', 'Image :') }} 
           {{ Form::file('book_pic' , Input::old('book_pic'), array('class' => 'form-control'))}} 
           <input type="radio" name="img_selc" ng-model="img_selc" value="text" checked="true">  URL &nbsp&nbsp
           <input type="radio" name="img_selc" ng-model="img_selc" value="file"> Upload <br/>
           <input ng-if="img_selc=='text'" name="book_pic" type="text" class="form-control" value="">
           <input ng-if="img_selc=='file'" name="book_pic" type="file" class="form-control" value="">
       </div>

       <div class="form-group">
        {{ Form::label('cover_price', 'Cover price') }}
        <div class="input-group">
            {{ Form::text('cover_price','', array('class' => 'form-control')) }}
            <span class="input-group-addon">฿</span>
        </div>

    </div>

    <div class="form-group">
        {{ Form::label('Description', 'Description') }}
        {{ Form::textarea('description','', array('class' => 'form-control', 'placeholder' => 'Description')) }}

    </div>


    <div class="form-group">
        {{ Form::label('category', 'Category') }}
        <select name="category" class="form-control">
            <option value=null>Select category</option>
            @foreach($category_all as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        {{ Form::label('sub_category', 'Sub Category') }}
        <select name="sub_category" class="form-control">
            <option value=null>Select sub category</option>
            @foreach($sub_category_all as $sub_category)
            <option value="{{$sub_category->id}}">{{$sub_category->name}}</option>
            @endforeach
        </select>
    </div>

  <!--  
     <div ng-controller="AttCtrl">

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

    </div> -->
    {{ Form::submit('Create', array('class' => 'btn btn-primary btn-lg btn-block')) }}

    {{ Form::close() }}
</div>


</div>
<hr class="tall" />



@stop
