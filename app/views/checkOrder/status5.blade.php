@extends('layouts.default')

@section('content')

<div class="col-md-12" ng-app>

    <br>
    <h1>All paid order</h1>
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
        <td>User_tel</td>
        <td>paid_at</td>     
        <td>Address </td>               
    </tr>
</thead>
<tbody>
    @foreach($orders as $order)
            @foreach($users as $user)
                @if($order -> user_id == $user -> id)

                            

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
                            <td>{{ $user->tel }}</td>  
                            <td>{{ $order->paid_at }}</td>
                            <td>@if($user->room_number!=NULL)
            
                ห้อง {{$user->room_number}}
            @endif
            @if($user->floor!=NULL)
            ชั้น {{$user->floor}} 
            @endif
            @if($user->building!=NULL)
            อาคาร {{$user->building}} 
            @endif
            @if($user->address_no!=NULL)
            เลขที่ {{$user->address_no}} 
            @endif
            @if($user->street!=NULL)
            ถนน {{$user->street}} 
            @endif
            @if($user->sub_distinct!=NULL)
            แขวง/ตำบล {{$user->sub_distinct}} 
            @endif
            @if($user->distinct!=NULL)
            เขต/อำเภอ {{$user->distinct}} 
            @endif
            @if($user->provice!=NULL)
            จังหวัด {{$user->provice}} 
            @endif
            @if($user->zip_code!=NULL)
            รหัสไปรษณีย์ {{$user->zip_code}} 
            @endif</td>                   
                   
                        
                    

                @endif
            @endforeach
            </tbody>
        @endforeach
</table>


</div>
<hr class="tall" />


@stop