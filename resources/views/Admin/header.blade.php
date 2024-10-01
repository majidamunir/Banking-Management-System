<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="images/favicon.png">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Include Pusher JavaScript library -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
</head>

<body class="">
<div class="wrapper">
    <div class="sidebar" data-color="black" data-active-color="primary">
        <div class="logo">
            <a href="{{ route('Dashboard') }}" class="simple-text logo-mini">
                <div class="logo-image-small">
                    <img src="../assets/img/logo.jpg">
                </div>
            </a>
            <a href="{{ route('Dashboard') }}" class="simple-text logo-normal">
                Banking System
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="active">
                    <a href="{{ route('Dashboard') }}">
                        <i class="nc-icon nc-layout-11"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('accounts.index') }}">
                        <i class="nc-icon nc-single-02"></i>
                        <p>Accounts</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('transactions.index') }}">
                        <i class="nc-icon nc-money-coins"></i>
                        <p>Transactions</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('loans.index') }}">
                        <i class="nc-icon nc-bank"></i>
                        <p>Loans</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('Rate') }}">
                        <i class="nc-icon nc-world-2"></i>
                        <p>Exchange Rates</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('Table') }}">
                        <i class="nc-icon nc-tile-56"></i>
                        <p>Table List</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
{{--        <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">--}}
{{--            <div class="container-fluid">--}}
{{--                <div class="navbar-wrapper">--}}
{{--                    <div class="navbar-toggle">--}}
{{--                        <button type="button" class="navbar-toggler">--}}
{{--                            <span class="navbar-toggler-bar bar1"></span>--}}
{{--                            <span class="navbar-toggler-bar bar2"></span>--}}
{{--                            <span class="navbar-toggler-bar bar3"></span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <a class="navbar-brand" href="javascript:;">Admin Dashboard</a>--}}
{{--                </div>--}}
{{--                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--                    <span class="navbar-toggler-bar navbar-kebab"></span>--}}
{{--                    <span class="navbar-toggler-bar navbar-kebab"></span>--}}
{{--                    <span class="navbar-toggler-bar navbar-kebab"></span>--}}
{{--                </button>--}}
{{--                <div class="collapse navbar-collapse justify-content-end" id="navigation">--}}
{{--                    <form>--}}
{{--                        <div class="input-group no-border">--}}
{{--                            <input type="text" value="" class="form-control" placeholder="Search...">--}}
{{--                            <div class="input-group-append">--}}
{{--                                <div class="input-group-text">--}}
{{--                                    <i class="nc-icon nc-zoom-split"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                    <ul class="navbar-nav">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link btn-magnify" href="javascript:;">--}}
{{--                                <i class="nc-icon nc-layout-11"></i>--}}
{{--                                <p>--}}
{{--                                    <span class="d-lg-none d-md-block">Stats</span>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item btn-rotate dropdown">--}}
{{--                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                <i class="nc-icon nc-bell-55"></i>--}}
{{--                                <p>--}}
{{--                                    <span class="d-lg-none d-md-block">Notifications</span>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">--}}
{{--                                <div id="notification-list">--}}
{{--                                    <!-- Notifications will be appended here -->--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link btn-rotate" href="javascript:;">--}}
{{--                                <i class="nc-icon nc-settings-gear-65"></i>--}}
{{--                                <p>--}}
{{--                                    <span class="d-lg-none d-md-block">Account</span>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="btn btn-primary" class="navbar-brand" href="javascript:;">Admin Dashboard</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
{{--                    <form>--}}
{{--                        <div class="input-group no-border">--}}
{{--                            <input type="text" value="" class="form-control" placeholder="Search...">--}}
{{--                            <div class="input-group-append">--}}
{{--                                <div class="input-group-text">--}}
{{--                                    <i class="nc-icon nc-zoom-split"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
                    <ul class="navbar-nav">
                        <li class="nav-item btn-rotate dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell"></i> <!-- Updated bell icon -->
                                <p>
                                    <span class="d-lg-none d-md-block">Notifications</span>
                                    <span class="badge badge-danger" id="notification-count">0</span>
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <div id="notification-list">
                                    <!-- Notifications will be appended here -->
                                </div>
                            </div>
                        </li>

                        <li class="nav-item">
{{--                            <a class="nav-link btn-rotate" href="javascript:;">--}}
{{--                                <i class="nc-icon nc-settings-gear-65"></i>--}}
{{--                                <p>--}}
{{--                                    <span class="d-lg-none d-md-block">Account</span>--}}
{{--                                </p>--}}
{{--                            </a>--}}
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

