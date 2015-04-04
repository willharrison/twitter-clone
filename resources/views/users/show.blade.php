@extends('app')

@section('content')

    @include('top')

    <div class="container container-full">

        <div class="col-xs-3"></div>

        <div class="col-xs-9 posts">
            <div class="profile-headers">
                <span class="big">Posts</span>
            </div>
            @if ($posts->isEmpty())
                <div class="big text-center first-post" style="padding-top: 10px;">
                    <a href="/">Say something!</a>
                </div>
            @endif
            <div class="post-create" style="display:none"></div>
            @include('postlist')
        </div>
    </div>

@endsection
