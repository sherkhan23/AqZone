@extends('layouts.app')
@section('title') AgroShop @endsection

<head>
    <!-- Подключение библиотеки jQuery -->
    <script src="jquery.js"></script>
    <!-- Подключение jQuery плагина Masked Input -->
    <script src="jquery.maskedinput.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 -->
    <link rel="shortcut icon" href="media/modern-skyscraper-building.jpeg" />

    <link href="https://unpkg.com/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <!-- JavaScript and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <!-- Bootstrap 5 end -->
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

@section('content') @endsection
@include('inc.navbar')
<div class="container">
    @include('inc.header-links')
    <div class="container-fluid">
        <div class="row" id="header-row">
            <div class="col-md-4 mt-2">
                <div class="card flex-shrink-0 p-3 bg-white shadow">
                    <h5 class="text-muted mb-0">Фильтры</h5>
                    <script>
                        function hide(form) {
                            if (form.style.display == "none") {
                                form.style.display = "block";
                            } else {
                                form.style.display = "none";
                            }
                        }
                    </script>
                    <small class="text-muted">Нажмите в инконку чтобы открыть фильтр</small>
                    <form action="{{ route("catalog") }}" method="GET"  id="search-head" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 pb-3" role="search">
                        <input name="search_field" type="search" id="mainSearch" class="form-control" placeholder="Поиск" aria-label="Search">
                        <i style="font-size: 30px;" class="bi bi-menu-down p-2" onclick="hide(document.getElementById('form1'))"></i>
                    </form>
                    <div id="form1" style="display: none">
                        <livewire:brand-producer></livewire:brand-producer>
                    </div>
                    <form>
                        <button class="button form-control text-dark" style="background-color: #FFC528"  type="submit">Сбросить фильтр</button>
                    </form>
                </div>

            </div>
            <div class="col-md-8">
                @if(session('successAddCart'))
                    <div class="alert alert-success" role="alert">
                        {{session('successAddCart')}}
                    </div>

                @endif

                @foreach($aids as $el)
                    <div class="card shadow-sm border-5 rounded-3 mt-2" style="border: 1px solid gray">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9 col-lg-6 col-xl-6">

                                    <h5>{{$el->aidName}}</h5>
                                    <div class="d-flex flex-row">
                                        <span class="text-muted">Категория: </span>
                                        <span class="ml-1"> {{$el->categoryName}}</span>
                                    </div>

                                    <div class="mt-1 mb-0 text-muted small">
                                        <span>{{$el->ProducerName}}</span>
                                        <span>{{$el->producerCountry}}</span>
                                        <span class="text-primary"> • </span>
                                    </div>

                                    <div class="mb-2 text-muted small">
                                        <span>{{$el->BrandName}}</span>
                                        {{--                                    component--}}
                                        <span class="text-primary"> • </span>
                                    </div>

                                </div>

                                <div class="col-md-3"></div>

                                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                    <div class="d-flex flex-row align-items-center mb-1">

                                    </div>
                                    <div class="d-flex flex-column mt-4">

                                        <a style="background-color: #00C759" class="text-black btn btn-sm" href="{{ route('show_aids', $el->aids_id) }}">
                                            Перейти
                                        </a>

                                        @auth('web')
                                            @if(\Illuminate\Support\Facades\Auth::user()->farmer == 1)
                                                <form class="w-100" method="POST" action="{{ route('update_cart', $el->aids_id)}}">
                                                    @csrf



                                                    @foreach($carts as $cart)
                                                        @if($cart->aids_id == $el->aids_id and $cart->user_id == \Illuminate\Support\Facades\Auth::id())
                                                            <a href="{{route('cart')}}">
                                                                <button style="background-color: #ef6464" class="btn btn-outline btn-sm mt-2 w-100" type="button">
                                                                    <i class="bi bi-trash" style="font-size: 15px"></i> Убрать с корзины
                                                                </button>
                                                            </a>
                                                        @endif
                                                    @endforeach

                                                    <button id="onetime" style="background-color: #FFC528;" class="btn btn-outline btn-sm mt-2 w-100" type="button"
                                                            data-toggle="modal" data-target="#modal-cart-{{$el->aids_id}}">
                                                        <i class="bi bi-cart3"></i> Добавить в корзину
                                                    </button>





                                                    @error('user_culture')
                                                    <p class="text-red-500">{{ $message }}</p>
                                                    @enderror

                                                <!-- Modal -->
                                                    <div class="modal fade" id="modal-cart-{{$el->aids_id}}" tabindex="-1" role="dialog" aria-labelledby="addtocart" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="addtocart">Выберите культуру для добавления препарата в заявку</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="form-check">
                                                                        <label>Рекомендуемые культуры:</label>
                                                                        <input onclick="user_cult2(document.getElementById('block-other-culture-{{$el->aids_id}}'))" type="radio" value="default-culture" class="form-check-input" name="user_culture" checked>
                                                                        <label class="form-check-label" for="user_culture">{{$el->cultureName}} </label>
                                                                        <input class="d-none" value="{{$el->cultureName}}" name="user-default-culture">
                                                                        <input class="d-none" value="{{$el->utilizationRate}}" name="aidsUtilizationRate">

                                                                        @foreach($userCulture as $userCult)
                                                                            @if($el->cultureName == $userCult->cultureName and $userCult->status == 1
                                                                                    and \Illuminate\Support\Facades\Auth::id() == $userCult->user_id)
                                                                                <input value="{{$userCult->square}}" style="display: none" name="user_square">
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                    <hr>

                                                                    <div class="form-check">
                                                                        <input onclick="user_cult1(document.getElementById('block-other-culture-{{$el->aids_id}}'))"  type="radio" class="form-check-input" name="user_culture" value="other-culture">
                                                                        <label class="form-check-label" for="other-culture-{{$el->aids_id}}">Другая культура</label>
                                                                    </div>

                                                                    <div id="block-other-culture-{{$el->aids_id}}" style="display: none" class="other-culture">
                                                                        <h6 class="mb-0 mt-3">Культура</h6>
                                                                        <select name="other-user_culture" class="form-select mt-2" aria-label="Default select example">
                                                                            @foreach($user_cult as $cult)
                                                                                <option value="{{$cult->cultureName}}">{{$cult->cultureName}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                                                                    <script>
                                                                        function user_cult1(user_cult1) {
                                                                            if (user_cult1.style.display == "none") {
                                                                                user_cult1.style.display = "block";
                                                                            } else {
                                                                                user_cult1.style.display = "none";
                                                                            }
                                                                        }
                                                                        function user_cult2(user_cult2) {
                                                                            if (user_cult2.style.display == "none") {
                                                                                user_cult2.style.display = "block";
                                                                            } else {
                                                                                user_cult2.style.display = "none";
                                                                            }
                                                                        }
                                                                    </script>

                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                                                    <button type="submit" class="btn btn-primary">Добавить</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endauth

                                                    @guest()
                                                        <button style="background-color: #FFC528" class="btn btn-outline btn-sm mt-2 w-100" type="button">
                                                            <i class="bi bi-cart3"></i> Необходимо войти в систему
                                                        </button>
                                                    @endguest

                                                </form>
                                            @endif


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center align-content-center mt-3">
                    <a href="{{ $aids->previousPageUrl() }}"><button style="background-color: #00C759" class="btn btn-md" type="button">Назад</button></a>
                    <span class="ml-3">
                       {{ $aids->withQueryString()->links() }}
                   </span>
                    <a href={{ $aids->nextPageUrl()  }}>   <button style="background-color: #00C759" class="btn btn-md ml-3" type="button">Следущий</button></a>
                </div>

            </div>
        </div>
    </div>
</div>

@livewireScripts

{{--@section('scripts')--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#brand_id').change(function () {--}}
{{--                var $producer = $('#producer_id');--}}
{{--                $.ajax({--}}
{{--                    url: "{{ route('producer.index') }}",--}}
{{--                    data: {--}}
{{--                        country_id: $(this).val()--}}
{{--                    },--}}
{{--                    success: function (data) {--}}
{{--                        $producer.html('<option value="" selected>Choose state</option>');--}}
{{--                        $.each(data, function (id, value) {--}}
{{--                            $producer.append('<option value="' + id + '">' + value + '</option>');--}}
{{--                        });--}}
{{--                    }--}}
{{--                });--}}
{{--                $('#producer_id, #brand_id').val("");--}}
{{--                $('#producer_id').removeClass('d-none');--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

