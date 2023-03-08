@extends('layouts.app')
<style>
    a:hover {
        color: black;
        font-weight: bold;
    }
    a:active {
        font-weight: bold;
    }
</style>
<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-2 mb-4 nav-link">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Главная</a></li>
                <li class="breadcrumb-item">

                    <a class="rounded" href="{{route('catalog')}}">

                        @if('catalog' == request()->route()->getName())
                            <span style="font-weight: bold; color: orange">Каталог</span>
                        @else
                            Каталог
                        @endif
                    </a>
                </li>
                @auth("web")
                    @if(\Illuminate\Support\Facades\Auth::user()->role == 'farmer')
                        <li class="breadcrumb-item">
                            <a href="{{route('cart')}}">
                                @auth('web')
                                    ({{$cartCounter}})
                                @endauth
                                @if('cart' == request()->route()->getName())
                                    <span style="font-weight: bold; color: orange">
                                        Корзина
                                    </span>
                                @else
                                    Корзина
                                @endif

                            </a>
                        </li>
                    @endif
                @endauth
                <li class="breadcrumb-item">
                    <a class="nav-link-a" href="{{route('applications')}}">
                        @auth("web")
                            @if(\Illuminate\Support\Facades\Auth::user()->role == 'farmer')
                                ({{$appCounter}})
                            @endif

                            @if('applications' == request()->route()->getName())
                                <span style="font-weight: bold; color:  orange">
                                    Заявки
                                </span>
                            @else
                                Заявки
                            @endif
                        @endauth

                    </a>
                </li>

                <li class="breadcrumb-item">
                    <a class="nav-link-a" href="#">
                        @auth("web")
                            Заказы
                        @endauth
                    </a>
                </li>
            </ol>
        </nav>
    </div>
</div>
