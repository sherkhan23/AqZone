@extends('layouts.app')
@include('inc.navbar')
@section('title') Register @endsection
<body class="">
<section class="shadow-lg">
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-xl-10">
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-2 mb-4">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Главная</a></li>
                                <li class="breadcrumb-item">
                                    <a class="rounded" style="color: #00C759" href="{{route('register')}}">Регистрация</a>
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
                                    <h2 class="fw-bold mb-0 text-center text-secondary">Регистрация</h2>
                                </div>

                                <form action="{{ route("register_process") }}" class="space-y-5" method="POST">
                                    @csrf

                                    <input name="name" type="text" class="w-full h-12 border border-gray-800 rounded px-3 " placeholder="Введите имя" />

                                    @error('name')
                                    <p class="text-red-500">{{ $message }}</p>
                                    @enderror

                                    <input id="phoneNumber" name="phoneNumber" type="text" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Введите номер" />

                                    @error('phoneNumber')
                                    <p class="text-red-500">{{ $message }}</p>
                                    @enderror


                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" id="farmer" value="farmer">
                                        <label class="form-check-label" for="farmer">
                                            Фермер
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" id="seller" value="seller">
                                        <label class="form-check-label" for="seller">
                                            Продавец
                                        </label>
                                    </div>

                                    @error('role')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                    <input name="password" type="password" class="w-full h-12 border border-gray-800 rounded px-3 " placeholder="Пароль" />

                                    @error('password')
                                    <p class="text-red-500">{{ $message }}</p>
                                    @enderror

                                    <input name="password_confirmation" type="password" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Подтверждение пароля" />

                                    @error('password_confirmation')
                                    <p class="text-red-500">{{ $message }}</p>
                                    @enderror

                                    <div>
                                        <a href="{{ route("login") }}" class="font-medium text-secondary rounded-md p-2">Есть аккаунт?</a>
                                    </div>

                                    <button style="background-color: #00C759" type="submit" class="text-center w-full text-white py-3 font-medium rounded">Зарегистрироваться</button>
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

</body>
