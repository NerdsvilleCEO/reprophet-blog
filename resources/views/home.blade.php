@extends('layouts.app')

@section('content')
@if (!Auth::guest())
<bloglist :posts="{{$posts}}" :user="{{Auth::user()}}"></bloglist>
@else
<bloglist :posts="{{$posts}}"></bloglist>
@endif
@endsection
