@extends('layouts.default')

@section('content')

<div class="col-md-12" ng-app>

    <br>
    <h1>SP's order</h1>
    <!-- Button trigger modal -->

<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif 

<table class="table table-striped table-bordered">
  <hr>
  <thead>
    <tr>
         <td>Order_ID</td>
        <td>Orederlist</td>
        <td>User_ID</td>
        <td>User_firstname</td>
        <td>User_lastname </td>
        <td>User_mobilephonenumber</td>
        <td>resp_sp_code</td> 
        <td>ordered_at</td>        
        <td>paid_at</td>     
        <td>recv_location </td>  
    </tr>
</thead>
<tbody>
    @foreach($orders as $order)
            @foreach($users as $user)
                @if($order -> user_id == $user -> id)   
                    @if($user->resp_sp_code != '0' || $user->resp_sp_code != '' )

                    
                        @foreach($spnotbanneds as $spnotbanned)
                        
                            @if($user->resp_sp_code == $spnotbanned->sp_code)
                            
                              <td>{{ $order->id }}</td>
                            <td> {{ Form::open(array('url'=>'checkorder/show-orderlist/'.$order->id,'method'=>'GET')) }}
                                    <button type="submit" class="btn btn-success  " >
                                        Show Order List
                                    </button>
                             
                                    {{ Form::close() }}
                            </td>
                            <td>{{ $order->user_id }}</td> 
                            <td>{{ $user->firstname }}</td>
                            <td>{{ $user->lastname }}</td>
                            <td>{{ $user->mobilephonenumber }}</td>  
                            <td>{{ $user->resp_sp_code }}</td>   
                            <td>{{ $order->ordered_at }}</td>   
                            <td>{{ $order->paid_at }}</td>   
                            <!-- <td>{{ $order->recv_location }}</td>    -->
                            
                            @endif
                        
                        @endforeach
                    
                    @endif
                
                @endif
            
            @endforeach

        </tbody>
@endforeach
</table>


</div>
<hr class="tall" />

@stop