<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>

    <title>Olympic - Administration</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notie/4.3.1/notie.css">
    @yield('css')
    <style>
        .content {

        }
    </style>
</head>
<body class="fixed-header menu-pin menu-behind pace-done">
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Olympic Game</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    {{--    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">--}}
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3"
               href="{{ action([\App\Http\Controllers\Admin\AdminController::class, 'logout']) }}">Sign out</a>
        </div>
    </div>
</header>
<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" aria-current="page" href="{{ action([\App\Http\Controllers\Admin\AdminController::class, 'dashboard']) }}">
                            <span data-feather="home"></span>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/sports') ? 'active' : '' }}"
                           href="{{ action([\App\Http\Controllers\Admin\SportController::class, 'index']) }}">
                            <span data-feather="layers"></span>
                            Sports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/event') ? 'active' : '' }}"
                           href="{{ action([\App\Http\Controllers\Admin\EventController::class, 'index']) }}">
                            <span data-feather="layers"></span>
                            Event
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/category') ? 'active' : '' }}"
                           href="{{ action([\App\Http\Controllers\Admin\EventCategoryController::class, 'index']) }}">
                            <span data-feather="layers"></span>
                            Event Category
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/scores') ? 'active' : '' }}"
                           href="{{ action([\App\Http\Controllers\Admin\ScoreController::class, 'index']) }}">
                            <span data-feather="layers"></span>
                            Scores
                        </a>
                    </li>
                </ul>

            </div>
        </nav>

