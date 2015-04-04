<?php $parser = new \Twitter\Services\PostParser(); ?>
@extends('app')

@section('content')

    <div class="col-xs-offset-3 col-xs-6">

        <div class="posts">

            <div class="search-results">
                <div class="big text-center">Results for <em>{{ $query }}</em></div>
            </div>

            @if (count($posts) === 0)
                <div class="post" style="padding-top: 10px">
                    <p class="post-content big text-center">
                        No results found.
                    </p>
                </div>
            @endif

            @include('postlist')
        </div>

    </div>
@endsection