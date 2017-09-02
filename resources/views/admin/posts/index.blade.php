@extends('layouts.admin')

@section('content')

<h1>all post</h1>

  <table class="table">
      <thead>
        <tr>
            <th>id</th>
            <th>photo_id</th>
            <th>Owner</th>
            <th>category_id</th>
            <th>title</th>
            <th>body</th>
            <th>created_at</th>
            <th>updated_at</th>
        </tr>
      </thead>
      <tbody>

      @if($posts)
          @foreach($posts as $post)
        <tr>
            <td>{{$post->id}}</td>
            <td><img height="80" width="80" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/50x50'}}"></td>
            <td>{{$post->user->name}}</td>
            <td>{{$post->category ? $post->category->name : 'Post has no category'}}</td>
            <td>{{$post->title}}</td>
            <td>{{$post->body}}</td>
            <td>{{$post->created_at->diffForHumans()}}</td>
            <td>{{$post->updated_at->diffForHumans()}}</td>
        </tr>
        @endforeach
          @endif
     </tbody>
   </table>
@stop