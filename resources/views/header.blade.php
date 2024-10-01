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

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

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

        /*.form-container {*/
        /*    max-width: 600px;*/
        /*    margin: 2rem auto;*/
        /*    padding: 2rem;*/
        /*    background-color: #ffffff;*/
        /*    border-radius: 8px;*/
        /*    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);*/
        /*}*/

        .form-group label {
            font-weight: bold;
        }

        /*.btn-primary {*/
        /*    background-color: #d30c52;*/
        /*    border-color: #d30c52;*/
        /*}*/
        /*.btn-primary:hover {*/
        /*    background-color: #b30a4e;*/
        /*    border-color: #b30a4e;*/
        /*}*/

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

        .custom-nav-button {
            padding: 10px 15px;
            background-color: lightseagreen;
            color: #ffffff;
            border-radius: 4px;
            cursor: pointer;
        }

        .custom-nav-button:hover {
            background-color: lightseagreen;
            color: #FFFFFF !important;
        }

    </style>

</head>
<body>
<div class="hero_area">

    <div class="hero_bg_box">
        <div class="bg_img_box">
            <img src="images/hero-bg.png" alt="">
        </div>
    </div>

    <header class="header_section">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg custom_nav-container">
                <a class="navbar-brand" href="{{ route('Home') }}">
                    <span>Banking System Management</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('Home') }}">Home <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('About') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('Resource') }}">Resources</a>
                        </li>

                        @auth
                            @if(Auth::user()->role === 'customer')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="{{ route('Home') }}"
                                       id="bankingServicesDropdown" role="button" data-bs-toggle="dropdown"
                                       aria-expanded="false">
                                        Banking Services
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="bankingServicesDropdown">
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle"
                                               href="{{ route('accounts.index') }}">Accounts</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"
                                                       href="{{ route('customer.request-account-form') }}">Request
                                                        Account Type</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle"
                                               href="{{ route('transactions.index') }}">Transactions</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"
                                                       href="{{ route('transaction.request.create') }}">Request
                                                        Transaction</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="{{ route('loans.index') }}">Loans</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('loan.request.create') }}">Request
                                                        Loan</a></li>
                                            </ul>
                                        </li>
                                        {{--                                        <li><a class="dropdown-item" href="{{ route('loans.index') }}">Loans</a></li>--}}
                                        <li><a class="dropdown-item" href="{{ route('Rate') }}">Exchange Rates</a></li>
                                    </ul>
                                </li>
                            @endif

                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-link nav-link">
                                        <i class="fa fa-user" aria-hidden="true"></i> Logout
                                    </button>
                                </form>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link custom-nav-button">
                                    {{ Auth::user()->name }}
                                </span>
                            </li>
                        @else
                            <!-- Sign Up / Login Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-sign-in" aria-hidden="true"></i> Sign Up
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('register') }}"><i class="fa fa-user"
                                                                                                   aria-hidden="true"></i>
                                            Register</a></li>
                                    <li><a class="dropdown-item" href="{{ route('login') }}"><i class="fa fa-user"
                                                                                                aria-hidden="true"></i>
                                            Login</a></li>
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </div>
            </nav>
        </div>
    </header>
