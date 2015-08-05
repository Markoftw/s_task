<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Članki</title>
    <!-- CSS -->
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bower_components/components-font-awesome/css/font-awesome.min.css">
    <style>
        body { margin-top: 75px; }
        .title { position: absolute; bottom: 0px; left:0px; color: #ffffff; font-size: 1em; overflow: hidden; width: 237px; text-shadow: 1px 1px 0px #000; background: linear-gradient(to bottom, transparent 0px, #000 100%) repeat scroll 0% 0% transparent; padding: 15px 10px 7px 10px;}
        .klik { position: absolute; top: 5px; right: 5px; }
        .klik:hover { background-color: cadetblue; border: 1px solid cadetblue;}
        .label-section { background: none repeat scroll 0% 0% #000000; position: absolute; top: 5px; right:40px; border: 1px solid #ffffff; padding: 3px 5px 3px 5px; }
        .thumbnail { position: relative; padding: 0px 35px 0px 0px; }
    </style>
    <!-- JS -->
    <script src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/bower_components/angular/angular.min.js"></script>
    <script src="/bower_components/angular-aria/angular-aria.min.js"></script>
    <script src="/bower_components/angular-animate/angular-animate.min.js"></script>
    <script src="/bower_components/angular-material/angular-material.min.js"></script>
    <script src="/bower_components/angular-route/angular-route.min.js"></script>
    <script src="/bower_components/angular-cookies/angular-cookies.min.js"></script>
    <script src="/bower_components/angular-local-storage/dist/angular-local-storage.min.js"></script>
    <!-- ANGULAR -->
    <script src="js/controllers/mainCtrl.js"></script>
    <script src="js/controllers/favCtrl.js"></script>
    <script src="js/controllers/userCtrl.js"></script>
    <script src="js/filters/filters.js"></script>
    <script src="js/services/articlesService.js"></script>
    <script src="js/app.js"></script>
</head>
<body ng-app="clankiApp">

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#home">Laravel</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a ng-href="#home">Home</a></li>
                    <li><a ng-href="#favs">Favorites</a></li>
                    <li><a ng-href="#test">Tests</a></li>
                    <li><a href="oauth/getToken" target="_blank">Check Token</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="/auth/login">Login</a></li>
                        <li><a href="/auth/register">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/auth/logout">Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container clearfix">
        <div ng-view></div>
    </div>

</body>
</html>