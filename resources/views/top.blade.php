
<div class="top-bg">
</div>

<div class="container profile-nav">
    <div class="col-xs-3 profile-pic">
        <img src="/{{ $user->profileImage('large') }}"/>
        <p>
            <span class="big margin-left">{{ $user->display_name }}</span>
            @if($user->follows(Auth::user()->id))
                <span class="caps small">Follows You</span>
            @endif
        <p>
            <span class="margin-left grey">{{ '@' . $user->name }}</span>
        </p>
        @if ($user->profile->tagline)
        <p>
            <span class="margin-left">{{ $user->profile->tagline }}</span>
        </p>
        @endif
        <ul class="margin-left">
            @if ($user->profile->location)
                <li><div><i class="grey fa fa-map-marker"></i> <span>{{ $user->profile->location }}</span></div></li>
            @endif
            @if ($user->profile->website)
                <li><div><i class="grey fa fa-link"></i> <span>{{ $user->profile->website }}</span></div></li>
            @endif
            <li><div><i class="grey fa fa-clock-o"></i> <span>{{ $user->created_at }}</span></div></li>
        </ul>
        </p>
    </div>
    <div class="col-xs-6 vertical-center-nav profile-page-nav">
        <div class="row">
            <a href="/{{ $user->name }}">
                <span class="caps small">Posts</span>
                <p class="no-top">
                    <span class="big-link post-count">{{ $postCount }}</span>
                </p>
            </a>
        </div>
        <div class="row">
            <a href="/{{ $user->name }}/following">
                <span class="caps small">Following</span>
                <p class="no-top">
                    <span class="big-link">{{ count($user->following) }}</span>
                </p>
            </a>
        </div>
        <div class="row">
            <a href="/{{ $user->name }}/followers">
                <span class="caps small">Followers</span>
                <p class="no-top">
                    <span class="big-link">{{ count($user->followers) }}</span>
                </p>
            </a>
        </div>
        <div class="row">
            <a href="/{{ $user->name }}/favorites">
                <span class="caps small">Favorites</span>
                <p class="no-top">
                    <span class="big-link favorite-count">{{ count($user->favorites) }}</span>
                </p>
            </a>
        </div>
    </div>
    <div class="col-xs-3 right vertical-center-follow follow-options">

        @if (Auth::user()->id == $user->id)
            <a href="/profile/edit" class="btn btn-default">Edit Profile</a>
        @else
            @if (Auth::user()->follows($user->id))
                <button class="btn btn-danger click-unfollow" data-user-id="{{ $user->id }}"><i class="fa fa-user-times"></i> Unfollow</button>
            @else
                <button class="btn btn-default click-follow" data-user-id="{{ $user->id }}"><i class="fa fa-user-plus"></i> Follow</button>
            @endif
        @endif

    </div>
</div>
