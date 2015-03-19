@extends('app')

@section('content')

    <div class="container home">
        <div class="col-xs-4">
            <div class="side-container">
                <div class="top">
                    <div class="row">
                        <img class="home-profile" src="{{ Auth::user()->profileImage('large') }}"/>
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
                            <span class="big-link">{{ count(Auth::user()->posts) }}</span>
                        </p>
                    </a>
                </div>
                <div class="row">
                    <a href="">
                        <span class="caps small">Following</span>
                        <p class="no-top">
                            <span class="big-link">{{ count(Auth::user()->following) }}</span>
                        </p>
                    </a>
                </div>
                <div class="row">
                    <a href="">
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

            <form action="post/create" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <div class="form-group">
                    <input class="form-control" placeholder="What's on your mind?" type="text" name="post"/>
                </div>
            </form>

        </div>
    </div>
@endsection
