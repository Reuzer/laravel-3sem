@extends('layout')

@section('content')
@if($errors->any())
  @foreach($errors->all() as $error)
    <div class="alert-danger">{{$error}}</div>
  @endforeach
@endif
<form method="POST" action="/articles" class="mt-4">
    @csrf
    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control" name='date' id="date" value="{{date("Y-m-d")}}">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name='name' id="name" value="{{old('name')}}">
    </div>
    <div class="mb-3">
      <label for="desc" class="form-label">Desc</label>
      <textarea name="desc" class="form-control" id="desc">{{old('desc')}}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@endsection