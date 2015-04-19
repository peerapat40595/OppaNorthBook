@extends('layouts.default')

@section('meta')
<meta name="keywords" content="OppaNorthBook" />
<meta name="description" content="">
<meta name="author" content="DBOppaNorth">
@stop

@section('title')
Users
@stop

@section('content')
<div class="container" ng-app="user_manager"  ng-controller="UserCtrl">


    @include('pages.user.frac.nav')
    <h1>All the user</h1>
    <!-- Button trigger modal -->


    <br>

    <!-- Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="filterLabel">Filter option</h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" id="filter" role="form" method="get" action="{{URL::to('user')}}">


        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" form="filter" class="btn btn-primary">Submit</button>
    </div>
</div>
</div>
</div>

<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="alert alert-danger" ng-if="message">@{{ message }}</div>

<table class="table table-striped table-bordered">
   <a class=" pull-right" data-toggle="modal" data-target="#filterModal">
      filter option
  </a>
  <input id="search" ng-focus="" ng-model="search" placeholder="user name..." class="form-control" >
  <hr>
  <thead>
    <tr>
        <td>ID</td>
        <td>Username</td>
        <td>Email</td>
        <td>Firstname</td>
        <td>Lastname</td>
        <td>Mobilephonenumber</td>
        <td>Address</td>
        
        <td>Resp_SP_Code</td>
        <td>IsSP</td>
        <td>SP_Code</td>
        <td>Point</td>
        <td>IsAdmin</td>
        <td>Banned</td>
        <td>Confirmed</td>
         <td></td>
    </tr>
</thead>
<tbody>
    <tr ng-repeat="user in users"> <!-- add class warning -->
        <td>@{{ user.id }}</td>
        <td>@{{ user.username }}</td>
        <td>@{{ user.email}}</td>
        <td>@{{ user.firstname}}</td>
        <td>@{{ user.lastname}}</td>
        <td>@{{ user.mobilephonenumber}}</td>
        <td>@{{ user.address}}</td>
        
        <td>@{{ user.resp_sp_code}}</td>
        <td>
            <a ng-click="toggleissp(user.id, $index)">

                <div ng-switch on="user.issp">
                   <button class="btn btn-small btn-block btn-default" ng-switch-when="true"><b>O</b></button>
                   <button class="btn btn-small btn-block btn-danger" ng-switch-when="false"><b>X</b></button>
                   <div ng-switch-default>
                    <button ng-if="user.issp===1" class="btn btn-small btn-default btn-block"><b>O</b></button>
                    <button ng-if="user.issp===0" class="btn btn-small btn-primary btn-block"><b>X</b></button>
                </div>

            </div>


        </a>
    </td>
    <td>@{{ user.sp_code}}</td>
    <td>@{{ user.point}}</td>
    <td>
            <a ng-click="toggleisadmin(user.id, $index)">

                <div ng-switch on="user.isadmin">
                   <button class="btn btn-small btn-block btn-default" ng-switch-when="true"><b>O</b></button>
                   <button class="btn btn-small btn-block btn-danger" ng-switch-when="false"><b>X</b></button>
                   <div ng-switch-default>
                    <button ng-if="user.isadmin===1" class="btn btn-small btn-default btn-block"><b>O</b></button>
                    <button ng-if="user.isadmin===0" class="btn btn-small btn-primary btn-block"><b>X</b></button>
                </div>

            </div>


        </a>
    </td>
    <td>
            <a ng-click="togglebanned(user.id, $index)">

                <div ng-switch on="user.banned">
                   <button class="btn btn-small btn-block btn-default" ng-switch-when="true"><b>O</b></button>
                   <button class="btn btn-small btn-block btn-danger" ng-switch-when="false"><b>X</b></button>
                   <div ng-switch-default>
                    <button ng-if="user.banned===1" class="btn btn-small btn-default btn-block"><b>O</b></button>
                    <button ng-if="user.banned===0" class="btn btn-small btn-primary btn-block"><b>X</b></button>
                </div>

            </div>


        </a>
    </td>
    <td>
            <a ng-click="toggleconfirmed(user.id, $index)">

                <div ng-switch on="user.confirmed">
                   <button class="btn btn-small btn-block btn-default" ng-switch-when="true"><b>O</b></button>
                   <button class="btn btn-small btn-block btn-danger" ng-switch-when="false"><b>X</b></button>
                   <div ng-switch-default>
                    <button ng-if="user.confirmed===1" class="btn btn-small btn-default btn-block"><b>O</b></button>
                    <button ng-if="user.confirmed===0" class="btn btn-small btn-primary btn-block"><b>X</b></button>
                </div>

            </div>


        </a>
    </td>
    <td>



        

        <a class="btn btn-info  btn-block" ng-href="manage_user/@{{user.id}}/edit" target="_blank">Edit</a>

        <a class="btn btn-warning  btn-block" ng-click="delete_user(user.id, user.username)">Delete</a>


    </td>
</tr>
<!-- end ng-reapeat -->
<div>
 <ul class="pager">
  <li class="previous" ng-click="prev()"><a href="">&larr; Previous</a></li>
  <li>Pages : @{{currentPage}} / @{{total}} </li>
  <li class="next" ng-click="next()"><a href="">Next &rarr;</a></li>
</ul>
</div>
</tbody>
</table>


</div>
<hr class="tall" />

@stop