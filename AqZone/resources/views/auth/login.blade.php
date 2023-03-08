@extends('layouts.app')
@include('inc.navbar')
@section('title') Login @endsection
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap 5 -->
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/home.css">


</head>

<section class="shadow-lg bg-light">
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-xl-10">
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-2 mb-4">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Главная</a></li>
                                <li class="breadcrumb-item">
                                    <a class="rounded" style="color: #00C759" href="{{route('login')}}">Вход</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">

                                <div class="text-center">
                                    <a class="navbar-brand" href="/">
                                        <img src="media/logoAgro.png" id="logoAgro">
                                    </a>
                                    <h2 class="fw-bold mb-0 text-center text-secondary">Вход</h2>
                                    <p class="text-secondary">Пожалуйста, введите свой логин и пароль!</p>
                                </div>

                                @if(session('errorLogin'))
                                    <p class="p-2 bg-danger text-white rounded mt-3">{{session('errorLogin')}}</p>
                                @endif
                                <form method="POST" action="{{ route("login_process") }}" class="space-y-5 py-2">
                                    @csrf
                                    <input
                                        value="<?php
                                        session_start();
                                        if(isset($_SESSION['phoneNumber'])) {
                                            echo $_SESSION['phoneNumber'];
                                        } ?>"
                                        id="phoneNumber" name="phoneNumber" type="text" class="w-full h-12 border border-gray-800 rounded px-3 " placeholder="Введите номер" />

                                    @error('phoneNumber')
                                    <p class="text-red-500">{{ $message }}</p>
                                    @enderror

                                    <input name="password" type="password" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Пароль" />

                                    @error('password')
                                    <p class="text-red-500">{{ $message }}</p>
                                    @enderror

                                    <div>
                                        <a href="" class="font-medium text-secondary rounded-md p-2">Забыли пароль?</a>
                                    </div>

                                    <div>
                                        <a href="{{ route("register") }}" class="font-medium  text-secondary rounded-md p-2">Регистрация</a>
                                    </div>

                                    <button type="submit" class="text-center w-full text-white rounded py-3 font-medium" style="background-color: #00C759">Войти</button>
                                </form>

                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center" style="background-image: linear-gradient(#00C759, green);">
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                <h4 class="mb-4">Мы больше, чем просто компания</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

