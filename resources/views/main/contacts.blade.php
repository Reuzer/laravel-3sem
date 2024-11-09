@extends('layout')
@section('content') 
    @foreach($data as $value)
    <p>{{$value}}</p>
    @endforeach
@endsection