@extends('app')

@section('content')

    @include('top')

    <div class="container container-full">

        <div class="col-xs-3"></div>

        <div class="col-xs-9 wrapper">

            @if ($follow->isEmpty())
            <div class="big text-center">
                You need more friends.
            </div>
            @endif
            @foreach($follow as $user)
                <div class="follow">
                    <div></div>
                    <div>
                        <div>
                            <div>
                                <img src="{{ asset($user->profileImage('medium')) }}"/>
                            </div>
                            <div class="options follow-options">
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

                        <div>
                            <div class="big">
                                <a href="/{{ $user->name }}">{{ $user->display_name }}</a>
                                <p>@<a href="/{{ $user->name }}">{{ $user->name }}</a></p>
                            </div>
                            {{ $user->profile->tagline }}
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

@endsection

