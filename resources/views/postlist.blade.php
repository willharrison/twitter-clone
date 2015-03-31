<?php $parser = new \Twitter\Services\PostParser(); ?>
@foreach ($posts as $post)
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
                                {{ $post->user->display_name }}
                                <a/>
                                <small><a href="/{{ $post->user->name }}">{{ '@' . $post->user->name }}</a> &#8226; <span class="created-at">{{ $post->created_at }}</span></small>
                        </span>
            <p class="post-content">
                <?php echo $parser->postToHTML(htmlspecialchars($post->post)); ?>
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

                <a href="/{{ $post->user->name }}/status/{{ $post->id }}">
                    <span class="caps small">View Post</span> <i class="fa fa-arrow-right"></i>
                </a>

            </div>
        </div>
    </div>
@endforeach