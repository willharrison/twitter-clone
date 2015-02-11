@extends('app')

@section('content')

    <form action="subscribe/follow" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <input type="hidden" name="follow_id" value="{{ $user->id }}"/>
        <input type="submit"/>
    </form>
    {{ $user }}

@endsection