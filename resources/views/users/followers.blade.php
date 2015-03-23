@extends('app')

@section('content')

    @include('top')

    @foreach($followers as $follower)
        {{ $follower }}
    @endforeach

@endsection

