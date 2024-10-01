<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!-- Site Metas -->
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <link rel="shortcut icon" href="images/favicon.png" type="">

    <title> Banking System </title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>

    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet"/>

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"/>
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet"/>


    <style>
        .nav-item .dropdown-menu {
            padding: 10px;
        }

        .nav-item .dropdown-menu .dropdown-item {
            padding: 10px 15px;
            font-size: 14px;
            color: #333;
            border-radius: 4px;
        }

        .nav-item .dropdown-menu .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #007bff;
        }

        .nav-item .dropdown-toggle {
            padding: 10px 15px;
        }

        .nav-item .dropdown-menu .dropdown-item i {
            margin-right: 5px;
        }

        .dropdown-menu .dropdown-item {
            padding: 10px 15px;
        }

        .nav-item.dropdown .dropdown-menu {
            margin-top: 0;
        }
        .dropdown-submenu {
            position: relative;
        }
        .dropdown-submenu .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -6px;
            margin-left: -1px;
            border-radius: .25rem;
            display: none;
        }
        .dropdown-submenu:hover .dropdown-menu {
            display: block;
        }
    </style>

</head>

<body class="sub_page">

<div class="hero_area">

    <div class="hero_bg_box">
        <div class="bg_img_box">
            <img src="images/hero-bg.png" alt="">
        </div>
    </div>

    <!-- header section strats -->
    <header class="header_section">
        <div class="container-fluid">
{{--            <nav class="navbar navbar-expand-lg custom_nav-container ">--}}
{{--                <a class="navbar-brand" href="{{ route('Home') }}">--}}
{{--            <span>--}}
{{--              S&M Banking System--}}
{{--            </span>--}}
{{--                </a>--}}

{{--                <button class="navbar-toggler" type="button" data-toggle="collapse"--}}
{{--                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"--}}
{{--                        aria-expanded="false" aria-label="Toggle navigation">--}}
{{--                    <span class=""> </span>--}}
{{--                </button>--}}

{{--                <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--                    <ul class="navbar-nav  ">--}}
{{--                        <li class="nav-item ">--}}
{{--                            <a class="nav-link" href="{{ route('Home') }}">Home </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="{{ route('About') }}">About</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item active">--}}
{{--                            <a class="nav-link" href="{{ route('Service') }}">Services <span--}}
{{--                                    class="sr-only">(current)</span> </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item ">--}}
{{--                            <a class="nav-link" href="">Transactions</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item ">--}}
{{--                            <a class="nav-link" href="">Loans</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item ">--}}
{{--                            <a class="nav-link" href="">Exchange Rates</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item dropdown">--}}
{{--                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">--}}
{{--                                <i class="fa fa-sign-in" aria-hidden="true"></i> Sign Up--}}
{{--                            </a>--}}
{{--                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
{{--                                <li><a class="dropdown-item" href="{{ route('register') }}"><i class="fa fa-user" aria-hidden="true"></i> Register</a></li>--}}
{{--                                <li><a class="dropdown-item" href="{{ route('login') }}"><i class="fa fa-user" aria-hidden="true"></i> Login</a></li>--}}
{{--                                <li>--}}
{{--                                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">--}}
{{--                                        @csrf--}}
{{--                                        <button type="submit" class="dropdown-item">--}}
{{--                                            <i class="fa fa-user" aria-hidden="true"></i> Logout--}}
{{--                                        </button>--}}
{{--                                    </form>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                        --}}{{--              <form class="form-inline">--}}
{{--                        --}}{{--                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">--}}
{{--                        --}}{{--                  <i class="fa fa-search" aria-hidden="true"></i>--}}
{{--                        --}}{{--                </button>--}}
{{--                        --}}{{--              </form>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </nav>--}}
            <nav class="navbar navbar-expand-lg custom_nav-container">
                <a class="navbar-brand" href="{{ route('Home') }}">
                    <span>Banking System Management</span>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('Home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('About') }}">About</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('Resource') }}">Resources <span class="sr-only">(current)</span></a>
                        </li>

                        @auth
                            <!-- Authenticated user links -->
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('Account') }}">Accounts</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('Transaction') }}">Transactions</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('Loan') }}">Loans</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('Rate') }}">Exchange Rates</a>--}}
{{--                            </li>--}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="{{ route('Home') }}" id="bankingServicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Banking Services
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="bankingServicesDropdown">
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="{{ route('accounts.index') }}">Accounts</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('customer.request-account-form') }}">Request Account Type</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="{{ route('transactions.index') }}">Transactions</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('transaction.request.create') }}">Request Transaction</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="{{ route('loans.index') }}">Loans</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('loan.request.create') }}">Request Loan</a></li>
                                        </ul>
                                    </li>
                                    {{--                                        <li><a class="dropdown-item" href="{{ route('loans.index') }}">Loans</a></li>--}}
                                    <li><a class="dropdown-item" href="{{ route('Rate') }}">Exchange Rates</a></li>
                                </ul>
                            </li>
                        @endauth

                        @guest
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-sign-in" aria-hidden="true"></i> Sign Up
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('register') }}"><i class="fa fa-user" aria-hidden="true"></i> Register</a></li>
                                    <li><a class="dropdown-item" href="{{ route('login') }}"><i class="fa fa-user" aria-hidden="true"></i> Login</a></li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-link nav-link">
                                        <i class="fa fa-user" aria-hidden="true"></i> Logout
                                    </button>
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>

        </div>
    </header>
    <!-- end header section -->
</div>


<!-- resource section -->

<section class="service_section layout_padding">
    <div class="service_container">
        <div class="container ">
            <div class="heading_container heading_center">
                <h2>
                    Our <span>Resources</span>
                </h2><br>
                <p>
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                    alteration
                </p>
            </div>
            <div class="row">
                <div class="col-md-4 ">
                    <div class="box ">
                        <div class="img-box">
                            <img src="images/s1.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Currency Wallet
                            </h5>
                            <p>
                                fact that a reader will be distracted by the readable content of a page when looking at
                                its layout.
                                The
                                point of using
                            </p>
                            <a href="{{ route('Resource') }}">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="box ">
                        <div class="img-box">
                            <img src="images/s2.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Security Storage
                            </h5>
                            <p>
                                fact that a reader will be distracted by the readable content of a page when looking at
                                its layout.
                                The
                                point of using
                            </p>
                            <a href="{{ route('Resource') }}">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="box ">
                        <div class="img-box">
                            <img src="images/s3.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Expert Support
                            </h5>
                            <p>
                                fact that a reader will be distracted by the readable content of a page when looking at
                                its layout.
                                The
                                point of using
                            </p>
                            <a href="{{ route('Resource') }}">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-box">
                <a href="{{ route('Resource') }}">
                    View All
                </a>
            </div>
        </div>
    </div>
</section>

<!-- end resource section -->
@include('footer')
