@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <br><br>
        <h1>Secret tips</h1>

        @foreach($posts as $p)

        <h3><a href="{{URL::to('secrettips/tip/'.$p->id)}}">{{ $p->title }}</a></h3>
        <span class="label label-info">{{ \Carbon\Carbon::createFromTimestamp(strtotime($p->created_at))->diffForHumans() }}</span>
        <br>
        {{ substr($p->body, 0, 300)}}  <a href="{{URL::to('secrettips/tip/'.$p->id)}}">..อ่านต่อ</a> 
        <hr class='tall'>
        @endforeach
    </tbody>
</table>
<center><?php echo $posts->links(); ?><center>
</div>


</div>
@stop
