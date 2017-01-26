@extends('layouts.app')
@section('content')
@if (!Auth::guest())
    <blogpost :post="{{$post}}" :user="{{Auth::user()}}"></blogpost>
@else
    <blogpost :post="{{$post}}"></blogpost>
@endif
@endsection
