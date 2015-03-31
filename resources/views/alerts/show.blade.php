@extends('app')

@section('content')

    <div class="col-xs-offset-3 col-xs-6">

        <div class="posts">

            <div class="search-results">
                <div class="big text-center">Notifications
                    <form action="alert/readAll" method="post" style="display: inline-block">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <button class="primary-blue light clear-all">Clear All</button>
                    </form>
                </div>
            </div>

            @if (count($alerts) === 0)
                <div class="post" style="padding-top: 10px">
                    <p class="post-content big text-center">
                        You have no notifications.
                    </p>
                </div>
            @endif
            @foreach ($alerts as $alert)
                <div class="post" style="padding-top: 10px" data-alert-id="{{ $alert->id }}">
                    <div class="unread small">
                        @if ($alert->read === 0)
                            <i class="fa fa-trash-o"></i>
                        @endif
                    </div>
                    <div>
                        <p class="post-content">
                            {{ $alert->message }}
                        </p>
                        <span class="post-name">
                            <small><span class="created-at">{{ $alert->created_at }}</span></small>
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
