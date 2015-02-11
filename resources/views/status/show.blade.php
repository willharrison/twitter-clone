@extends('app')

@section('content')

    <form action="/post/favorite" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <input type="hidden" name="post_id" value="{{ $post->id }}"/>
        <input type="submit" value="Favorite"/>
    </form>

    <form action="/repost/store" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <input type="hidden" name="post_id" value="{{ $post->id }}"/>
        <input type="submit" value="Repost"/>
    </form>

    {{ $user }}<br/>
    {{ $post }}<br/>
    {{ $me }}

@endsection
