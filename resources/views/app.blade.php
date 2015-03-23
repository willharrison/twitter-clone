<?php $profilePage = isset($user); ?>
<!DOCTYPE html>
<html lang="en" ng-app>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Twitter Clone</title>
	<link rel="stylesheet" href="{{ elixir("css/app-compiled.css") }}">
    <script>
        var csrf_token = "{{ csrf_token() }}";
        @if ($profilePage)
            var my_id = "{{ Auth::user()->id }}";
            var user_id = "{{ $user->id }}";
        @endif
    </script>
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>

    <div class="modal fade" id="reply" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body">
                    <div></div>
                    <div>


                    </div>
                </div>
                <div class="modal-footer">
                    <div contenteditable="true" id="modal-reply-box" data-ph="What do you want to say?"></div>
                    <div class="reply-info">
                        <span class="modal-count-down">140</span>
                        <button type="button" class="btn btn-primary modal-submit-post"><i class="fa fa-pencil"></i> Post</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (Auth::check())
    <nav class="navbar navbar-fixed-top white">
        <div class="container-full container">

            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="#about"><i class="fa fa-bell"></i> Notifications</a></li>
                    <li><a href="#contact"><i class="fa fa-envelope"></i> Messages</a></li>
                </ul>
                <div class="navbar-form navbar-right">
                        <div class="form-group">
                            <input type="text" placeholder="Search" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        <img class="small-top-profile" src="{{ asset(Auth::user()->profileImage()) }}"/>
                </div>
            </div><!--/.navbar-collapse -->
        </div>
    </nav>
    @endif

    @yield('content')



    <div class="cloneable-post" style="display:none">
        <div class="repost"></div>
        <div> <img style="width: 24px" src="{{ asset(Auth::user()->profileImage('tiny')) }}"/> </div>
        <div>
            <span class="post-name">
                <a href="/{{ Auth::user()->name }}">
                    @if (is_null(Auth::user()->profile->display_name))
                        {{ Auth::user()->name }}
                    @else
                        {{ Auth::user()->profile->display_name }}
                    @endif
                    <a/>
                    <small><a href="/{{ Auth::user()->name }}">{{ '@' . Auth::user()->name }}</a> &#8226; <span class="created-at"></span></small>
            </span>
            <p class="post-content"></p>
            <div class="post-options" data-post-id="">
                <i class="fa fa-reply" data-toggle="modal" data-target="#reply"></i>
                <i class="fa fa-retweet repost-disable"> 0</i>
                <i class="fa fa-star"> 0</i>

                <div class="dropdown" style="display: inline">
                    <i class="fa fa-ellipsis-h dropdown-toggle" data-toggle="dropdown" aria-expanded="false"></i>
                    <ul class="dropdown-menu" role="menu">
                        <li class="delete-post"><a>Delete Post</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
