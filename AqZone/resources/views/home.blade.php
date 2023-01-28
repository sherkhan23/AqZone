@extends('layouts.app')

@section('title') AgroShop @endsection

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Пакет JavaScript с Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>
    <!-- Только CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    {{--  Bootstrap icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    {{--  /Bootstrap icons --}}

    <link rel="icon"
          type="image/png"
          href="https://cdn.logojoy.com/wp-content/uploads/2018/08/23112849/192-768x591.png">
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Подключение библиотеки jQuery -->
    <script src="jquery.js"></script>
    <!-- Подключение jQuery плагина Masked Input -->
    <script src="jquery.maskedinput.min.js"></script>
</head>

@section('content') @endsection
@include('inc.navbar')
@include('inc.header')
<div class="m-4">
    <ul class="nav nav-tabs" id="myTab">
        <li class="nav-item">
            <a href="#users" class="nav-link active" data-bs-toggle="tab">
                Пользователи
            </a>
        </li>
        <li class="nav-item">
            <a href="#aids" class="nav-link" data-bs-toggle="tab">
                Пестициды
            </a>
        </li>
        <li class="nav-item">
            <a href="#messages" class="nav-link" data-bs-toggle="tab">
                Создание пестицидов
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="users">
            {{-- admin users --}}
            user
            {{-- admin users --}}
        </div>
        <div class="tab-pane fade" id="aids">
            {{-- admin users --}}
            aids
            {{-- admin users --}}
        </div>
        <div class="tab-pane fade" id="messages">
            <h2>Создание пестицидов</h2>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        if (location.hash) {
            $("a[href='" + location.hash + "']").tab("show");
        }
        $(document.body).on("click", "a[data-bs-toggle='tab']", function(event) {
            location.hash = this.getAttribute("href");
        });
    });
    $(window).on("popstate", function() {
        var anchor = location.hash || $("a[data-bs-toggle='tab']").first().attr("href");
        $("a[href='" + anchor + "']").tab("show");
    });

</script>

@include('inc.footer')
