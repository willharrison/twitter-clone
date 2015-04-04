<?php $parser = new \Twitter\Services\PostParser(); ?>
@extends('app')

@section('content')

    <div class="col-xs-offset-3 col-xs-6">

        <div class="posts">

            <div class="post big" style="padding: 35px">

                <div>
                    <div>
                        <img style="width: 48px" src="{{ asset($post->user->profileImage('medium')) }}"/>
                    </div>
                    <div style="margin-bottom:-12px">
                        <span class="post-name">
                            <a href="/{{ $post->user->name }}">
                                <span class="big">{{ $post->user->display_name }}</span>
                                <a/>
                                <p>
                                    <small><a href="/{{ $post->user->name }}">{{ '@' . $post->user->name }}</a></small>
                                </p>
                        </span>
                    </div>
                    <div style="float: right" class="options follow-options">
                        @if (Auth::user()->id !== $user->id)
                            <div class="btn-group">
                                <i class="fa fa-cog drop-down-toggle" data-toggle="dropdown" aria-expanded="false"></i>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="tweet-to" data-toggle="modal" data-target="#reply"><a href="#">Tweet to {{ '@' . $user->name }}</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li><a href="#">Mute</a></li>
                                </ul>
                            </div>
                        @endif
                        @if (Auth::user()->follows($user->id))
                            <button class="btn btn-danger click-unfollow" data-user-id="{{ $user->id }}"><i class="fa fa-user-times"></i> Unfollow</button>
                        @elseif (Auth::user()->id === $user->id)
                            <a href="/profile/edit" class="btn btn-default">Edit Profile</a>
                        @else
                            <button class="btn btn-default click-follow" data-user-id="{{ $user->id }}"><i class="fa fa-user-plus"></i> Follow</button>
                        @endif
                    </div>
                </div>

                <div style="width: 100%">
                    <p class="post-content">
                        <?php echo $parser->postToHTML(htmlspecialchars($post->post)); ?>
                    </p>
                    <div class="post-options" style="width: 300px" data-post-id="{{ $post->id }}">
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

                    <div class="reposts-favorites" style="width: 100%">
                        <div>
                            <span class="small grey caps">Reposts</span>
                            <br/>
                            <span class="big post-count">{{ count($post->reposts) }}</span>
                        </div>
                        <div>
                            <span class="small grey caps">Favorites</span>
                            <br/>
                            <span class="big favorite-count">{{ count($post->favorites) }}</span>
                        </div>
                        <div class="separator"></div>
                        <div>
                            @foreach ($post->favorites->take(10) as $favorite)
                                <a href="/{{ $favorite->user->name }}"><img style="width: 24px" src="{{ asset($favorite->user->profileImage('tiny')) }}"/></a>
                            @endforeach
                        </div>
                    </div>

                    <p>
                        <span class="created-at medium grey">{{ $post->created_at }}</span>
                    </p>

                </div>
            </div>

            <div class="post-create no-round">
                <div>
                    <div class="post-editable" data-ph="What's on you mind?" contenteditable="true" data-post-id="{{ $post->id }}">
                       <span class="primary-blue">{{ '@' . $post->user->name }}</span>
                    </div>
                    <div>
                        <span class="create-post-count-down">140</span>
                        <button type="button" class="btn btn-primary reply-submit-post"><i class="fa fa-pencil"></i> Post</button>
                    </div>
                </div>
            </div>
            @include('postlist')
        </div>

    </div>

@endsection
