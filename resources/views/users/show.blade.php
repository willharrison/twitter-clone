@extends('app')

@section('content')

    <div class="top-bg">
    </div>

    <div class="container profile-nav">
        <div class="col-xs-3 profile-pic">
            <img src="{{ $user->profileImage('large') }}"/>
            <p>
                <span class="big margin-left">
                @if (is_null($user->profile->display_name))
                    {{ $user->name }}
                @else
                    {{ $user->profile->display_name }}
                @endif
                </span>
                <p>
                    <span class="margin-left grey">{{ '@' . $user->name }}</span>
                </p>
                <p>
                    <span class="margin-left">{{ $user->profile->tagline }}</span>
                </p>
                <ul class="margin-left">
                    <li><div><i class="grey fa fa-map-marker"></i> <span>{{ $user->profile->location }}</span></div></li>
                    <li><div><i class="grey fa fa-link"></i> <span>{{ $user->profile->website }}</span></div></li>
                    <li><div><i class="grey fa fa-clock-o"></i> <span>{{ $user->created_at }}</span></div></li>
                </ul>
            </p>
        </div>
        <div class="col-xs-6 vertical-center-nav profile-page-nav">
            <div class="row">
                <a href="{{ $user->name }}">
                    <span class="caps small">Posts</span>
                    <p class="no-top">
                        <span class="big-link">{{ count($user->posts) }}</span>
                    </p>
                </a>
            </div>
            <div class="row">
                <a href="">
                    <span class="caps small">Following</span>
                    <p class="no-top">
                        <span class="big-link">{{ count($user->following) }}</span>
                    </p>
                </a>
            </div>
            <div class="row">
                <a href="">
                    <span class="caps small">Followers</span>
                    <p class="no-top">
                        <span class="big-link">{{ count($user->followers) }}</span>
                    </p>
                </a>
            </div>
            <div class="row">
                <a href="">
                    <span class="caps small">Favorites</span>
                    <p class="no-top">
                        <span class="big-link">{{ count($user->favorites) }}</span>
                    </p>
                </a>
            </div>
        </div>
        <div class="col-xs-3 right vertical-center-follow">

            @if (Auth::user()->id == $user->id)
                    <a href="profile/edit" class="btn btn-default">Edit Profile</a>
            @else
                @if (Auth::user()->follows($user->id))
                    <form action="subscribe/unfollow" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <input type="hidden" name="follow_id" value="{{ $user->id }}"/>
                        <button type="submit" class="btn btn-danger">Unfollow</button>
                    </form>
                @else
                    <form action="subscribe/follow" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <input type="hidden" name="follow_id" value="{{ $user->id }}"/>
                        <button type="submit" class="btn btn-default"><i class="fa fa-user-plus"></i> Follow</button>
                    </form>
                @endif
            @endif

        </div>
    </div>

    <div class="container container-full">

        <div class="col-xs-3"></div>

        <div class="col-xs-9 posts">
            <div>
                <span class="big">Posts</span>
            </div>
            @foreach ($user->posts as $post)
                <div class="post">
                    <div>
                        <img src="{{ $user->profileImage('tiny') }}"/>
                    </div>
                    <div>
                        <span class="post-name">
                        @if (is_null($user->profile->display_name))
                            {{ $user->name }}
                        @else
                            {{ $user->profile->display_name }}
                        @endif
                            <small>{{ '@' . $user->name }} &#8226; {{ $post->created_at }}</small>
                        </span>
                        <p class="post-content">
                            {{ $post->post }}
                        </p>
                        <p>
                            <i class="fa fa-reply"></i>
                            <i class="fa fa-retweet"> {{ count($post->reposts) }}</i>
                            <i class="fa fa-star"> {{ count($post->favorites) }}</i>
                            <i class="fa fa-ellipsis-h"></i>
                        </p>
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