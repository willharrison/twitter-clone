<?php $parser = new \Twitter\Services\PostParser(); ?>
@extends('app')

@section('content')

    @include('top')

    <div class="container container-full">

        <div class="col-xs-3"></div>

        <div class="col-xs-9 posts">
            <div>
                <span class="big">Posts</span>
            </div>
            @if ($posts->isEmpty())
                <div class="big text-center" style="padding-top: 10px;">
                    Say something!
                </div>
            @endif
            @foreach ($posts as $post)
                <div class="post">
                    <div class="repost">
                        @if (isset($post->isRepost))
                            @if ($post->isRepost)
                                <div>
                                    <i class="fa fa-retweet"></i>
                                </div>
                                <div>
                                    <a href="/{{ $user->name }}">{{ $user->name }}</a> reposted
                                </div>
                            @endif
                        @endif

                    </div>
                    <div>
                        <img style="width: 24px" src="/{{ $post->user->profileImage('tiny') }}"/>
                    </div>
                    <div>
                        <span class="post-name">
                            <a href="/{{ $post->user->name }}">
                                    {{ $post->user->display_name }}
                                <a/>
                                <small><a href="/{{ $post->user->name }}">{{ '@' . $post->user->name }}</a> &#8226; {{ $post->created_at }}</small>
                        </span>
                        <p class="post-content">
                            <?php echo $parser->linkify(htmlspecialchars($post->post), '@'); ?>
                        </p>
                        <div class="post-options" data-post-id="{{ $post->id }}">
                            <i class="fa fa-reply" data-toggle="modal" data-target="#reply"></i>

                            @if (Auth::user()->posted($post->id))
                                <i class="fa fa-retweet repost-disable"> {{ count($post->reposts) }}</i>
                            @elseif (Auth::user()->reposted($post->id))
                                <i class="fa fa-retweet reposted"> {{ count($post->reposts) }}</i>
                            @else
                                <i class="fa fa-retweet"> {{ count($post->reposts) }}</i>
                            @endif

                            @if (Auth::user()->favorited($post->id))
                                <i class="fa fa-star favorited"> {{ count($post->favorites) }}</i>
                            @else
                                <i class="fa fa-star"> {{ count($post->favorites) }}</i>
                            @endif

                            <div class="dropdown" style="display: inline">
                                <i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-expanded="false"></i>
                                <ul class="dropdown-menu" role="menu">
                                    @if (Auth::user()->id == $post->user->id)
                                        <li class="delete-post"><a>Delete Post</a></li>
                                    @else
                                        <li><a href="#">Mute</a></li>
                                    @endif
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!--
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

    -->



@endsection
