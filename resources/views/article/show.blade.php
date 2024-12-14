@extends('layout')
@section('content')

@if(session('status'))
  <div class="alert alert-success">{{session('status')}}</div>
@endif
<div class="card text-center mb-3" style="width: 100%;">
<div class="card-header">
    Author: {{ $user->name }}
</div>
  <div class="card-body">
    <h5 class="card-title">{{ $article->name }}</h5>
    <p class="card-text">{{ $article->desc }}</p>
    <div class="d-flex justify-content-end gap-3">
      @can('update', $article)
        <a href="/articles/{{ $article->id }}/edit" class="btn btn-primary">Edit article</a>
        <form action="/articles/{{ $article->id }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-warning">Delete article</button>
        </form>
      @endcan
    </div>
    </div>
  </div>
  @if($errors->any())
  @foreach($errors->all() as $error)
    <div class="alert-danger">{{$error}}</div>
  @endforeach
@endif
<h3 class="text-center">Add comment</h3>
<form method="POST" action="/comment" class="mt-4">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name='name' id="name" value="{{old('name')}}">
    </div>
    <input name="article_id"type="hidden" value="{{$article->id}}">
    <div class="mb-3">
      <label for="desc" class="form-label">Desc</label>
      <textarea name="desc" class="form-control" id="desc">{{old('desc')}}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save comment</button>
  </form>
  <h3 class="text-center">Comments</h3>
<div class="row">
  @foreach($comments as $comment)
  @if($comment->article_id === $article->id)
  <div class="col-sm-6 mb-3 mb-sm-0 mt-2">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{$comment->name}}</h5>
        <p class="card-text">{{$comment->desc}}</p>
        @can('update_comment',$comment)
          <a href="/comment/{{$comment->id}}/edit" class="btn btn-primary">Edit comment</a>
          <a href="/comment/{{$comment->id}}/delete" class="btn btn-warning">Delete comment</a>
        @endcan
      </div>
    </div>
  </div>
  @endif
  @endforeach
</div>
</div>


@endsection