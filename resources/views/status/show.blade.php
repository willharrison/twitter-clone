@extends('app')

@section('content')

    <form action="/post/destroy" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <input type="hidden" name="post_id" value="{{ $post->id }}"/>
        <input type="submit" value="Delete"/>
    </form>

    <form action="/post/favorite" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <input type="hidden" name="post_id" value="{{ $post->id }}"/>
        <input type="submit" value="Favorite"/>
    </form>

    <form action="/post/unfavorite" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <input type="hidden" name="post_id" value="{{ $post->id }}"/>
        <input type="submit" value="Un Favorite"/>
    </form>

    <form action="/repost/store" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <input type="hidden" name="post_id" value="{{ $post->id }}"/>
        <input type="submit" value="Repost"/>
    </form>

    <form action="/repost/destroy" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <input type="hidden" name="post_id" value="{{ $post->id }}"/>
        <input type="submit" value="Un Repost"/>
    </form>

    {{ $user }}<br/>
    {{ $post }}<br/>
    {{ $me }}

    <form action="/post/reply" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <input type="hidden" name="post_id" value="{{ $post->id }}"/>
        <input type="text" name="post"/>
        <input type="submit" value="Reply"/>
    </form>

@endsection
