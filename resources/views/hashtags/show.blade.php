<?php $parser = new \Twitter\Services\PostParser(); ?>
@extends('app')

@section('content')

    <div class="col-xs-offset-3 col-xs-6">

        <div class="posts">

            <div class="search-results">
                <div class="big text-center">Results for <em>{{ '#' . $hashtag }}</em></div>
            </div>

            @include('postlist')
        </div>

    </div>
@endsection