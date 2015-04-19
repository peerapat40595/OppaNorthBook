@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <br><br>
        <h1>All the post</h1>

        <a class="btn btn-small btn-success" href="{{ URL::to('posts/create') }}">Create a new post</a>
        <br><br>

        <!-- will be used to show any messages -->
        @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        @if ( Session::get('error') )
        <div class="alert alert-error alert-danger">
            @if ( is_array(Session::get('error')) )
            {{ head(Session::get('error')) }}
            @endif
        </div>
        @endif

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>Title</td>
                    <td>Description</td>
                    <th>Date Created</th>
                    <td>Preview</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
            </thead>
            <tbody>

                @foreach($posts as $p)
                <tr>
                    <td>{{ $p->title }}</td>
                    <td>{{ substr($p->body, 0, 120). '[...]'}}</td>

                    <td><span class="label label-info">{{ \Carbon\Carbon::createFromTimestamp(strtotime($p->created_at))->diffForHumans() }}</span></td>
                    <!-- we will also add show, edit, and delete buttons -->
                    <td>

                        <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                        <!-- we will add this later since its a little more complicated than the other two buttons -->

                        <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                        <a class="btn btn-small btn-success" href="{{ URL::to('posts/' . $p->id) }}">Show this post</a>

                        <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->


                    </td>
                    <td>
                        <a class="btn btn-small btn-info" href="{{ URL::to('posts/' . $p->id . '/edit') }}">Edit this post</a>
                    </td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('posts.destroy', $p->id))) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <center><?php echo $posts->links(); ?><center>
    </div>


</div>
@stop




