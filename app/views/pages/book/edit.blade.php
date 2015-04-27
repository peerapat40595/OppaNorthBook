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
        <h1>Edit Book</h1>

        <!-- if there are creation errors, they will show here -->
        {{ HTML::ul($errors->all()) }}

        {{ Form::model($book, array('route' => array('book.update', $book->id), 'method' => 'PUT', 'files'=> true)) }}
        <div class="form-group">

           {{ Form::label('cover_pic', 'Image :') }} 
           <!-- {{ Form::file('cover_pic' , Input::old('cover_pic'), array('class' => 'form-control'))}} -->
           <pre>
               <img src="{{asset($book->cover_pic)}}" style="max-height: 500px; max-width: 500px;"> <br><br>
               <input type="radio" name="img_selc" ng-model="img_selc" value="text" checked="checked"/>  URL &nbsp&nbsp
               <input type="radio" name="img_selc" ng-model="img_selc" value="file"> Upload <br/>
               <input ng-if="img_selc=='text'" name="cover_pic" type="text" class="form-control" value="{{$book->cover_pic}}">
               <input ng-if="img_selc=='file'" name="cover_pic" type="file" class="form-control" value="{{Input::old('cover_pic')}}">
           </pre>
       </div>
        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', Input::old('Title'), array('class' => 'form-control', 'id' => 'form')) }}
        </div>
     {{ Form::select('tags[]', Tag::lists('name', 'id'), $book->tag->lists('tag_id'), array('class' => 'form-control', 'multiple')) }}
       <div class="form-group">
        {{ Form::label('sell_price', 'Price') }}
        <div class="input-group">
            {{ Form::text('sell_price', Input::old('sell_price'), array('class' => 'form-control')) }}
            <span class="input-group-addon">฿</span>
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('Description', 'Description') }}
        {{ Form::textarea('description', $book->description , array('class' => 'form-control', 'placeholder' => 'Description')) }}
    </div>


        <div class="form-group">
            {{ Form::label('category', 'Category') }}
            <select name="category" id="category" class="form-control">
                <option value=null>Select category</option>
                @foreach($category_all as $category)
                <option value="{{$category->id}}"
                    <?php if ($book->category_id == $category->id) echo "selected =\"selected\" "; ?>
                    >{{$category->name}}</option>
                    @endforeach
                </select>
            </div>


            {{ Form::submit('Edit', array('class' => 'btn btn-primary btn-lg btn-block')) }}

                {{ Form::close() }}

        </div>
        <hr class="tall" />

        @stop