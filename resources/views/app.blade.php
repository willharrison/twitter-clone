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
                        <img class="small-top-profile" src="{{ Auth::user()->profileImage() }}"/>
                </div>
            </div><!--/.navbar-collapse -->
        </div>
    </nav>
    @endif

    @yield('content')

</body>
</html>
