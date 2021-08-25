<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>{{ isset($page) && $page->seo_title ? $page->seo_title : '' }}</title>
    <meta name="description" content="{{ isset($page) && $page->seo_description ? $page->seo_description : '' }}">
    <meta property="og:type" content="website"/>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/fav/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/fav/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/fav/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/fav/site.webmanifest') }}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta property="og:url" content="{{ \URL::current() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords"
          content="{{ isset($page) && $page->seo_keywords ? $page->seo_keywords : 'Olympics Games' }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notie/4.3.1/notie.css">
    @yield('css')
</head>
<body class="@yield('bodyClass')">
