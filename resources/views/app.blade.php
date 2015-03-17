<!DOCTYPE html>
<html lang="en" ng-app>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Twitter Clone</title>
	<link rel="stylesheet" href="{{ elixir("css/app.css") }}">
</head>
<body>

    @if (Auth::check())
    <nav class="navbar navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="#about"><i class="fa fa-bell"></i> Notifications</a></li>
                    <li><a href="#contact"><i class="fa fa-envelope"></i> Messages</a></li>
                </ul>
                <div class="navbar-form navbar-right">
                        <div class="form-group">
                            <input type="password" placeholder="Search" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        <img class="small-top-profile" src="{{ Auth::user()->profileImage() }}"/>
                </div>
                <ul class="nav navbar-right">
                </ul>
            </div><!--/.navbar-collapse -->
        </div>
    </nav>
    @endif

    <div class="container">

        @if (Auth::check())
            <b>{{ Auth::user()->name }}</b>
            <b>{{ Auth::user()->id }}</b>
        @endif

        @yield('content')

    </div>

</body>
</html>
