<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>SmartEDU - Education Responsive HTML5 Template</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="/home/images/favicon.ico" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="/home/images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    <!-- Site CSS -->
    <link rel="stylesheet" href="/home/style.css">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="/home/css/versions.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="/home/css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/home/css/custom.css">

    <!-- Modernizer for Portfolio -->
    <script src="/home/js/modernizer.js"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('head')
</head>
<body class="host_version">
<!-- LOADER -->
<div id="preloader">
    <div class="loader-container">
        <div class="progress-br float shadow">
            <div class="progress__item"></div>
        </div>
    </div>
</div>
<!-- END LOADER -->

<!-- Start header -->
<header class="top-navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="/home/images/logo.png" alt=""/>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-host" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbars-host">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ Request::is('/') ? 'active' : null }}"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item {{ Request::is('courses') ? 'active' : null }}"><a class="nav-link" href="{{ route('home.courses') }}">Courses</a></li>
                    <li class="nav-item {{ Request::is('community_post') ? 'active' : null }}"><a class="nav-link" href="{{ route('community_post.index') }}">Community Post</a></li>
                    @if(auth()->check())
                        <li class="nav-item {{ Request::is('home.my_courses') ? 'active' : null }}"><a class="nav-link" href="{{ route('home.my_courses') }}">My Courses</a></li>
                        <li class="nav-item {{ Request::is('home.profile') ? 'active' : null }}"><a class="nav-link" href="{{ route('home.profile') }}">Profile</a></li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="btn btn-secondary"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-primary" href="/login">Login</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- End header -->

@yield('content')

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="widget clearfix">
                    <div class="widget-title">
                        <h3>About US</h3>
                    </div>
                    <p> Integer rutrum ligula eu dignissim laoreet. Pellentesque venenatis nibh sed tellus faucibus bibendum. Sed fermentum est vitae rhoncus molestie. Cum sociis natoque penatibus et magnis dis montes.</p>
                    <div class="footer-right">
                        <ul class="footer-links-soi">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-github"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul><!-- end links -->
                    </div>
                </div><!-- end clearfix -->
            </div><!-- end col -->

            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="widget clearfix">
                    <div class="widget-title">
                        <h3>Information Link</h3>
                    </div>
                    <ul class="footer-links">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul><!-- end links -->
                </div><!-- end clearfix -->
            </div><!-- end col -->

            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="widget clearfix">
                    <div class="widget-title">
                        <h3>Contact Details</h3>
                    </div>

                    <ul class="footer-links">
                        <li><a href="mailto:#">info@yoursite.com</a></li>
                        <li><a href="#">www.yoursite.com</a></li>
                        <li>PO Box 16122 Collins Street West Victoria 8007 Australia</li>
                        <li>+61 3 8376 6284</li>
                    </ul><!-- end links -->
                </div><!-- end clearfix -->
            </div><!-- end col -->

        </div><!-- end row -->
    </div><!-- end container -->
</footer><!-- end footer -->

<div class="copyrights">
    <div class="container">
        <div class="footer-distributed">
            <div class="footer-center">
                <p class="footer-company-name">All Rights Reserved. &copy; 2018 <a href="#">SmartEDU</a> Design By : <a href="https://html.design/">html design</a></p>
            </div>
        </div>
    </div><!-- end container -->
</div><!-- end copyrights -->

<a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

<!-- ALL JS FILES -->
<script src="/home/js/all.js"></script>
<!-- ALL PLUGINS -->
<script src="/home/js/custom.js" defer></script>
<script src="/home/js/timeline.min.js" defer></script>
<script>
    /* timeline(document.querySelectorAll('.timeline'), {
         forceVerticalMode: 200,
         mode: 'horizontal',
         verticalStartPosition: 'left',
         visibleItems: 4
     });*/
</script>

@yield('script')
</body>
</html>
