<head>
    <!-- Пакет JavaScript с Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>
    <!-- Только CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <!-- Container wrapper -->
    <div class="container pb-3">
        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0" href="/">
                <img src="media/logoAgro.png" id="logoAgro">
            </a>
            <!--  -->
            <div class="navbar-collapse d-flex justify-content-start">
                <ul class="navbar-nav pt-2" id="navbar-links">
                    <li class="nav-item">
                        <form action="{{ route("catalog") }}" method="GET"  id="search-head" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 " role="search">

                            <input name="search_field" type="search" id="mainSearch" class="form-control" placeholder="Поиск" aria-label="Search">
                        </form>
                    </li>
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a class="nav-link" href="/">Каталог</a>--}}
                    {{--                    </li>--}}
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a class="nav-link" href="#">Избранное</a>--}}
                    {{--                    </li>--}}
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a class="nav-link" href="#">Заявки</a>--}}
                    {{--                    </li>--}}
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a class="nav-link" href="#">Заказы</a>--}}
                    {{--                    </li>--}}

                </ul>
            </div>
        </div>

        <!-- Collapsible wrapper -->

        <!-- Right elements -->
        <div class="d-flex align-items-center">

            <div class="text-muted">

                @if(session('cart'))
                    <a href="{{ url('cart') }}"> <span class="d-flex mr-3"><i id="like-cart" class="bi bi-bag-heart" style="font-size: 22px;"></i></span>
                        <!-- this code count product of choose tha user choose -->
                        <span class="badge badge-pill badge-danger ml-3">{{ count(session('cart')) }}</span>
                    </a>
            </div>
            @endif

        </div>
        <!-- Avatar -->

        <div class="dropdown">
            <button class="btn dropdown-toggle btn-outline-warning text-dark" type="button" id="dropdownMenu3" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">

                @auth("web")
                    <div class="d-inline-block">
                        <span class="d-inline-block"> <i class="bi bi-person-bounding-box btn-outline-warning"></i> </span>
                        <span class="d-inline-block ml-1"> {{ Auth::user()->name }} </span>
                    </div>

                @endauth
                @guest("web")
                    Логин
                @endguest
                <i class="bi bi-box-arrow-in-right btn-outline-warning"></i>
            </button>

            <div class="dropdown-menu" aria-labelledby="dropdownMenu3">
                <h6 class="dropdown-header">
                </h6>
                @auth("web")
                    @if(Auth::user()->farmer == true)
                        <a class="dropdown-item text-danger" href="#">Фермер</a>
                    @elseif(Auth::user()->farmer == false)
                        <a class="dropdown-item text-danger" href="#">Продавец</a>
                    @endif

                    <a class="dropdown-item" href="{{route('profile')}}"> <i class="bi bi-person-circle btn-outline-warning p-1"></i> Профиль</a>
                    <a class="dropdown-item" href="{{ route("logout") }}"> <i class="bi bi-box-arrow-right btn-outline-warning p-1"></i> Выйти</a>
                @endauth

                @guest("web")
                    <a style="border-radius: 10px" class="dropdown-item bg-gradient" href="{{ route('showCheckPhoneNumberExist') }}">Проверить номер</a>
                    <a class="dropdown-item" href="{{ route("login") }}">Логин</a>
                    <a class="dropdown-item" href="{{ route("register") }}">Регистрация</a>
                @endguest

            </div>
        </div>
    </div>


    <!-- Container wrapper -->
</nav>
