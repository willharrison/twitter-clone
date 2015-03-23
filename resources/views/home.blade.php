<?php $parser = new \Twitter\Services\PostParser(); ?>
@extends('app')

@section('content')

    <div class="container home">
        <div class="col-xs-4">
            <div class="side-container">
                <div class="top">
                    <div class="row">
                        <img class="home-profile" src="{{ asset(Auth::user()->profileImage('large')) }}"/>
                    </div>
                    <div class="row bottom home-name">
                        <span class="font-black">{{ Auth::user()->profile->display_name }}</span>
                        <span class="medium">{{ '@' . Auth::user()->name }}</span>
                    </div>
                </div>
                <div class="row">
                    <a href="{{ Auth::user()->name }}">
                        <span class="caps small">Posts</span>
                        <p class="no-top">
                            <span class="big-link post-count">{{ $postCount }}</span>
                        </p>
                    </a>
                </div>
                <div class="row">
                    <a href="{{ Auth::user()->name }}/following">
                        <span class="caps small">Following</span>
                        <p class="no-top">
                            <span class="big-link">{{ count(Auth::user()->following) }}</span>
                        </p>
                    </a>
                </div>
                <div class="row">
                    <a href="{{ Auth::user()->name }}/followers">
                        <span class="caps small">Followers</span>
                        <p class="no-top">
                            <span class="big-link">{{ count(Auth::user()->followers) }}</span>
                        </p>
                    </a>
                </div>
            </div>
            <div class="trending">
                <p><span class="big font-black">Trending</span></p>
                @foreach ($trending as $key => $value)
                    <p>{{ '#' . $key }}</p>
                @endforeach
            </div>
        </div>
        <div class="col-xs-8">

            <div class="posts">
                <div class="post-create">
                    <div>
                        <div class="post-editable" data-ph="What's on you mind?" contenteditable="true"></div>
                        <div>
                            <span class="create-post-count-down">140</span>
                            <button type="button" class="btn btn-primary submit-post"><i class="fa fa-pencil"></i> Post</button>
                        </div>
                    </div>
                </div>

            @foreach ($statuses as $post)
                <div class="post">
                    <div class="repost">
                    @if ($post->isRepost)
                        <div>
                            <i class="fa fa-retweet"></i>
                        </div>
                        <div>
                            <a href="/{{ $user->name }}">{{ $user->name }}</a> reposted
                        </div>
                    @endif
                    </div>
                    <div>
                        <img style="width: 24px" src="{{ asset($post->user->profileImage('tiny')) }}"/>
                    </div>
                    <div>
                        <span class="post-name">
                            <a href="/{{ $post->user->name }}">
                        @if (is_null($post->user->profile->display_name))
                                {{ $post->user->name }}
                            @else
                                {{ $post->user->profile->display_name }}
                            @endif
                            <a/>
                            <small><a href="/{{ $post->user->name }}">{{ '@' . $post->user->name }}</a> &#8226; <span class="created-at">{{ $post->created_at }}</span></small>
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
    </div>
@endsection
