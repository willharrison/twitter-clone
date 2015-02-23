@extends('app')

@section('content')

    <form action="subscribe/mute" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <input type="hidden" name="mute_id" value="{{ $user->id }}"/>
        <input type="submit" value="Mute"/>
    </form>

    <form action="subscribe/unmute" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <input type="hidden" name="mute_id" value="{{ $user->id }}"/>
        <input type="submit" value="Stop Muting"/>
    </form>

    <form action="subscribe/follow" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <input type="hidden" name="follow_id" value="{{ $user->id }}"/>
        <input type="submit" value="Follow"/>
    </form>

    <form action="subscribe/unfollow" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <input type="hidden" name="follow_id" value="{{ $user->id }}"/>
        <input type="submit" value="Stop Following"/>
    </form>

    {{ $user }}
    <img src="{{ $user->profileImage() }}"/>


@endsection