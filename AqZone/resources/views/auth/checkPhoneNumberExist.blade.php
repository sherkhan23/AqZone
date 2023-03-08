@extends('layouts.app')
@include('inc.navbar')
<head>
    <!-- Подключение библиотеки jQuery -->
    <script src="jquery.js"></script>
    <!-- Подключение jQuery плагина Masked Input -->
    <script src="jquery.maskedinput.min.js"></script>
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
                                    <a class="rounded" style="color: #00C759" href="{{route('showCheckPhoneNumberExist')}}">Проверить номер</a>
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
                                    <h2 class="fw-bold mb-0 text-center text-secondary">Проверить номер</h2>
                                    <p class="text-secondary">Пожалуйста, введите свой номер!</p>
                                </div>


                                <form class="" method="POST" action="{{ route("checkPhoneNumberExist") }}">
                                    @csrf
                                    @csrf <!-- {{ csrf_field() }} -->
                                    <div class="form-floating mb-3">
                                        <input id="phoneNumber"  name="phoneNumber" type="text" class="form-control rounded-3" placeholder="Номер">
                                    </div>


                                    <button style="background-color: #00C759" class="w-100 mb-2 btn btn-lg text-white" type="submit">Проверить</button>
                                    <small class="text-muted">Нажав Проверить, вы соглашаетесь с условиями использования.</small>
                                    <hr class="my-4">

                                </form>
                                <?php
                                if(isset($_POST['phoneNumber'])) {
                                    session_start();
                                    $_SESSION['phoneNumber'] = $_POST['phoneNumber'];
                                }
                                ?>

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

