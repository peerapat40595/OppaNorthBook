@extends('layouts.default')

@section('meta')
<meta name="keywords" content="OppaNorthBook" />
<meta name="description" content="">
<meta name="author" content="DBOppaNorth">
@stop

@section('title')
Brands
@stop

@section('content')
<div class="container" ng-app="brand_manager">


    @include('pages.product.frac.nav')
    <h1>Brand</h1>
    <br>
    <div ng-controller="BrandCtrl">
    <div class="col-md-6 col-md-offset-3" >
        <input  ng-model="bname.name" placeholder="brand.." class="form-control" >
        <hr>
        <div ng-repeat="brand in brands | filter:bname">
            <p>
                <span>@{{ brand.name }}</span>
                <span class="pull-right">
                    <a data-toggle="modal" data-target="#@{{brand.id}}"><i class="fa fa-pencil-square fa-2x" ng-click="open_editor(brand.id,brand.name)"></i></a>
                    <a><i class="fa fa-minus-square fa-2x" ng-click="delete(brand.id,brand.name)"></i></a>
                </span>
            </p>

            <div class="modal fade" id="@{{brand.id}}" tabindex="-1" role="dialog" aria-labelledby="filterLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="filterLabel">Edit name</h4>
                </div>
                <div class="modal-body">
                    <form id="edit">
                        <input class="form-control" ng-model="editname[brand.id]"> 
                       
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" data-dismiss="modal" form="edit" class="btn btn-primary" ng-click="edit(brand.id)">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>
<div class="input-group">
    <input type="text" name="name" class="col-md-7" ng-model="new_brand">
  <span class="input-group-btn">
    <button class="btn btn-default btn-sm" type="button" ng-click="add()">ADD!</button>
</span>
</div>
</div>


</div>

@stop