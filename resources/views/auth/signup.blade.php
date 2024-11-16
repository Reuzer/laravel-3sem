@extends('layout')

@section('content')
@if($errors->any())
  @foreach($errors->all() as $error)
    <div class="alert-danger">{{$error}}</div>
  @endforeach
@endif
<form method="POST" action="/auth/register" class="mt-4">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="email" class="form-control" name='name' id="name">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" name='email' id='email'>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="password">
    </div>
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">SignUp</button>
  </form>
@endsection 

