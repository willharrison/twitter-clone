@extends('app')

@section('content')

    @include('top')

    @foreach($following as $user)
        {{ $user }}
    @endforeach

@endsection
