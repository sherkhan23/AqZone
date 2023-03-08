@extends('layouts.app')
@section('title') Applications @endsection

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
</head>
@include('inc.navbar')
<div class="container">
    @include('inc.header-links')
    @if(\Illuminate\Support\Facades\Auth::user()->role == 'farmer')
        <div class="row">
            <ul class="nav nav-tabs" id="tabApplication" role="tablist">

                @if(\Illuminate\Support\Facades\Auth::user()->role == 'farmer')
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active btn-warning" id="newApp-tab" data-bs-toggle="tab" data-bs-target="#newApp" type="button" role="tab" aria-controls="newApp" aria-selected="true">
                            Новые
                        </button>
                    </li>
                @endif
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="published-tab btn-warning" data-bs-toggle="tab" data-bs-target="#published" type="button" role="tab" aria-controls="published" aria-selected="false">
                        Опубликовано
                        (+{{$offerCount}})
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="draft-tab btn-warning" data-bs-toggle="tab" data-bs-target="#draft" type="button" role="tab" aria-controls="draft" aria-selected="false">
                        Предложение
                        (+{{$draftCount}})
                    </button>
                </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="order-tab btn-warning" data-bs-toggle="tab" data-bs-target="#order" type="button" role="tab" aria-controls="order" aria-selected="false">
                            Заказ
                        </button>
                    </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab btn-warning" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">
                        Отмена
                    </button>
                </li>
            </ul>
        </div>

        <div class="container-fluid">
            <div class="row" id="header-row">

                <div class="col-md-4 mt-2">
                    <div class="card flex-shrink-0 p-3 bg-white shadow">
                        <h5 class="text-muted mb-0">Заявки</h5>
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
                        <form action="{{ route("catalog") }}" method="GET"  id="search-head" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 mb-3" role="search">
                            <input name="search_field" type="search" id="mainSearch" class="form-control" placeholder="Поиск" aria-label="Search">
                            <img src="media/Frame24.png" class="btn border-0 my-3"
                                 onclick="hide(document.getElementById('form1'))">
                        </form>
                        <form>
                            <button class="button form-control text-dark" style="background-color: #FFC528"  type="submit">Искать</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="tab-content" id="tabApplication">

                        @if(\Illuminate\Support\Facades\Auth::user()->role == 'farmer')
                            <div class="tab-pane fade show active" id="newApp" role="tabpanel" aria-labelledby="newApp-tab">
                                @if(session('updateMess'))
                                    <p class="p-2 bg-success text-white rounded mt-3">{{session('updateMess')}}</p>
                                @endif
                                @if(session('updateMessSquare'))
                                    <p class="p-2 bg-success text-white rounded mt-3">{{session('updateMessSquare')}}</p>
                                @endif
                                @if(session('successDelFromApp'))
                                    <p class="p-2 bg-danger text-white rounded mt-3">{{session('successDelFromApp')}}</p>
                                @endif
                                @if(session('updatePublished'))
                                    <p class="p-2 bg-success text-white rounded mt-3">{{session('updatePublished')}}</p>
                                @endif
                                @if(session('updateNew'))
                                    <p class="p-2 bg-success text-white rounded mt-3">{{session('updateNew')}}</p>
                                @endif

                                @foreach($viewCollect as $collect)
                                    @if($collect->first()->user_id == auth()->id())
                                        @if($collect->first()->app_status == 'new')
                                            <div class="card shadow-sm border-5 rounded-3 mt-2" style="border: 1px solid gray">
                                                <div class="card-body">

                                                    <div class="row">

                                                        <div class="col-md-4">
                                                            <h4>Заявка <small>№0000{{$collect->first()->application_id}}</small></h4>
                                                            <p class="text-secondary">Коментарий:
                                                                <small>
                                                                    @if($collect->first()->message == 0)
                                                                        пусто
                                                                    @else
                                                                        {{ $collect->first()->message}}
                                                                    @endif
                                                                </small>
                                                            </p>
                                                            <small>Срок поставки: {{$collect->first()->delivery_date}}</small>
                                                        </div>

                                                        <div class="col-md-4 d-flex" style="justify-content: center; align-items: center;">
                                                            <button class="p-2" style="border-radius: 10px; border:1px solid ">
                                                                Статус -
                                                                @if($collect->first()->app_status == 'new')
                                                                    Новая
                                                                @else
                                                                @endif
                                                            </button>
                                                        </div>

                                                        <div class="col-md-2 d-flex" style="justify-content: center; align-items: center;">
                                                            <button class="px-5" id="app-open" type="button" onclick="openApp(document.getElementById('applications-{{$collect->first()->application_id}}'))">
                                                                <i class="bi bi-chevron-compact-down"></i>
                                                            </button>
                                                        </div>
                                                        <div class="col-md-2 d-flex" style="justify-content: center; align-items: center;">
                                                            <form class="w-100" method="POST" action="{{route('delApplication', $collect->first()->application_id)}}">
                                                                @csrf
                                                                <button data-toggle="modal" class="btn btn-outline btn-sm mt-2 w-50 ml-1" type="button" data-target="#delApplication">
                                                                    <i class="bi bi-trash" style="font-size: 170%"></i>
                                                                </button>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="delApplication" tabindex="-1" role="dialog" aria-labelledby="delApplication" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLongTitle">Вы действительно хотите удалить?</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>

                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
                                                                                <button type="submit" class="btn btn-danger">Да, Удалить</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>

                                                        </div>

                                                        <div id="applications-{{$collect->first()->application_id}}" style="display: none">

                                                            <div>
                                                                <div class="card shadow-sm border-5 rounded mt-2" style="border: 1px solid gray">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-9">
                                                                                <h5 class="text-secondary">Условие Заявки</h5>
                                                                            </div>

                                                                            <div class="col-md-3 border-sm-start-none border-start d-flex" style="justify-content: center">
                                                                                <button id="app-open" type="button" class="bg-warning" onclick="openApp(document.getElementById('applications-delivery-{{$collect->first()->application_id}}'))">
                                                                                    <i class="bi bi-sort-down-alt"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row" style="display: none" id="applications-delivery-{{$collect->first()->application_id}}">
                                                                            <div class="row">

                                                                                <div class="col-md-4">
                                                                                    <form method="POST" action="{{route('editDelivery', $collect->first()->application_id)}}">
                                                                                        @csrf
                                                                                        <span>Условия поставки:</span>

                                                                                        <div class="form-check">
                                                                                            <input onclick="text(selfCall)" class="form-check-input" name="delivery_type" value="selfCall" type="radio" id="1" checked>
                                                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Самовывоз</label>
                                                                                        </div>
                                                                                        <div class="form-check">
                                                                                            <input onclick="text(delivery)" class="form-check-input" name="delivery_type" value="delivery" type="radio" id="2">
                                                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Доставка</label>
                                                                                        </div>
                                                                                        <div id="selfCall">
                                                                                            {{-- Самовызов--}}
                                                                                            <div class="btn-group mt-2">
                                                                                                <select name="city_id" class="form-select" aria-label="Default select example">
                                                                                                    <option disabled selected>Выберите город</option>
                                                                                                    @foreach($cities as $city)
                                                                                                        <option value="{{$city->id}}">{{$city->cityName}}</option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div id="delivery" style="display: none">
                                                                                            {{-- Доставка--}}
                                                                                            <div class="btn-group mt-2">
                                                                                                <select name="user_location_id" class="form-select">
                                                                                                    <option disabled selected>Выберите адрес</option>
                                                                                                    @foreach($user_locations as $user_loc)
                                                                                                        @if(\Illuminate\Support\Facades\Auth::user()->user_id == $user_loc->user_id and $user_loc->status == 1)
                                                                                                            <option value="{{$user_loc->loc_id}}">{{$user_loc->address}}</option>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>

                                                                                        <button class="form-control mt-2 btn-sm" type="submit">Изменить</button>
                                                                                    </form>




                                                                                    @if($collect->first()->delivery_type == 'selfCall')
                                                                                        <span>
                                                                                        Самовывоз:
                                                                                   </span>
                                                                                        {{$collect->first()->cityName}}

                                                                                    @elseif($collect->first()->delivery_type == 'delivery')
                                                                                        <br>
                                                                                        <span class="col-sm-2 mt-2 text-secondary">
                                                                                        Доставка:
                                                                                   </span>
                                                                                        {{-- Доставка--}}
                                                                                        {{$collect->first()->address}}
                                                                                        <br>
                                                                                        <span class="mt-2">
                                                                                        {{$collect->first()->regionName}},
                                                                                        {{$collect->first()->subRegionName}}, {{$collect->first()->localityName}}
                                                                                    </span>
                                                                                    @else
                                                                                    @endif

                                                                                </div>

                                                                                <div class="col-md-4">

                                                                                    <form method="POST" action="{{route('editPayment',$collect->first()->application_id)}} )}}">
                                                                                        @csrf
                                                                                        <div class="form-check">
                                                                                            <input onclick="pre_pay1(document.getElementById('block_pre_pay'))" class="form-check-input" type="radio" name="payment_type" id="payfull" value="payfull" checked>
                                                                                            <label class="form-check-label" for="example1">
                                                                                                100% предоплата
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="form-check d-flex" style="display: inline-block">
                                                                                            <input onclick="pre_pay2(document.getElementById('block_pre_pay'))" class="form-check-input" type="radio" name="payment_type" value="pre_pay">
                                                                                            <label class="form-check-label ml-2" for="example2">
                                                                                                Указать % предоплаты
                                                                                            </label>
                                                                                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                                                                                        </div>

                                                                                        <div class="form-group row py-1" id="block_pre_pay" style="display: none">
                                                                                            <div class="form-group row">
                                                                                                <div class="col-sm-6">
                                                                                                    <input type="number" min="1" max="100" class="form-control" id="pre_pay" value="30" name="pre_pay">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <button class="form-control mt-2 btn-sm" type="submit">Изменить</button>
                                                                                    </form>

                                                                                    <br>

                                                                                    @if($collect->first()->payment_type == 'payfull')
                                                                                        <span>Условие оплаты:</span> <br>
                                                                                        <span class="text-secondary">100% Предоплата:</span>

                                                                                    @elseif($collect->first()->payment_type == 'pre_pay')
                                                                                        <span>Условие оплаты: </span> <br>
                                                                                        <span class="text-secondary">Отсрочка платежа, дней:</span>
                                                                                        {{$collect->first()->pre_pay}}%
                                                                                    @else
                                                                                    @endif
                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>


                                                            @foreach($collect as $el)
                                                                <div class="card shadow-sm border-5 rounded mt-2" style="border: 1px solid gray">
                                                                    <div class="card-body">
                                                                        <div class="row">

                                                                            <div class="col-md-3">

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
                                                                                <div class="mb-2 text-muted">
                                                                                    <span>Количество: </span>
                                                                                    <span>
                                                                                            {{$quantity = $el->user_culture_util_norm*$el->user_culture_square}} {{$el->unitOfMeasureName}}
                                                                                         </span>
                                                                                </div>

                                                                            </div>

                                                                            <div class="col-md-3">
                                                                                <form action="{{route('applicationUpdateUtilNorm', $el->app_id)}}" method="POST">
                                                                                    @csrf
                                                                                    Норма рассхода {{$el->unitOfMeasureName}}
                                                                                    <small class="text-muted">Рекомендованное:
                                                                                        <br>
                                                                                        Мин.{{$el->minUtilizationRate}} -
                                                                                        Макс.{{$el->maxUtilizationRate}}
                                                                                    </small>
                                                                                    <input id="user_culture_square-{{$el->app_id}}-{{$el->aids_id}}" class="form-control mt-2" value="{{$el->user_culture_util_norm}}" name="user_culture_util_norm">
                                                                                    <button id="user_culture_square_button-{{$el->app_id}}-{{$el->aids_id}}" type="submit" class="form-control mt-1 btn-sm">Изменить норму</button>
                                                                                </form>
                                                                            </div>

                                                                            <div class="col-md-3">
                                                                                <form action="{{route('applicationUpdateSquare', $el->app_id)}}" method="POST">
                                                                                    @csrf
                                                                                    Площадь, га
                                                                                    <br>
                                                                                    <small class="text-muted">Культура:
                                                                                        <br>
                                                                                        "{{$el->culture_name}}"
                                                                                    </small>
                                                                                    <input id="user_culture_util_norm-{{$el->app_id}}-{{$el->aids_id}}" class="form-control mt-2" value="{{$el->user_culture_square}}" name="user_culture_square">
                                                                                    <button id="user_culture_util_norm_button-{{$el->app_id}}-{{$el->aids_id}}" type="submit" class="form-control mt-1 btn-sm">Изменить площадь</button>
                                                                                </form>
                                                                            </div>

                                                                            <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                                                                <div class="d-flex flex-column mt-4">
                                                                                    <a style="background-color: #00C759" class="text-black btn btn-sm" href="{{ route('show_aids', $el->aids_id) }}">
                                                                                        Перейти
                                                                                    </a>
                                                                                    <form action="{{route('delFromApp', $el->app_id)}}" method="POST">
                                                                                        @csrf
                                                                                        <button style="background-color: #ef6464" class="btn btn-outline btn-sm mt-2 w-100" type="submit">
                                                                                            <i class="bi bi-trash" style="font-size: 15px"></i> Убрать с заявки
                                                                                        </button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <script>
                                                                    var pass = document.querySelector('#user_culture_square-{{$el->app_id}}-{{$el->aids_id}}');
                                                                    var util = document.querySelector('#user_culture_util_norm-{{$el->app_id}}-{{$el->aids_id}}');

                                                                    pass.addEventListener('input', changeBackground);
                                                                    util.addEventListener('input', changeBackgroundUtil);
                                                                    function changeBackgroundUtil(){
                                                                        if (util.value !== '') {
                                                                            document.querySelector('#user_culture_util_norm_button-{{$el->app_id}}-{{$el->aids_id}}').style.background = '#00C759';
                                                                            document.querySelector('#user_culture_util_norm_button-{{$el->app_id}}-{{$el->aids_id}}').style.color = 'white';
                                                                        } else {
                                                                            document.querySelector('#user_culture_util_norm_button-{{$el->app_id}}-{{$el->aids_id}}').style.background = 'red';
                                                                            document.querySelector('#user_culture_util_norm_button-{{$el->app_id}}-{{$el->aids_id}}').style.color = 'white';
                                                                        }
                                                                    }
                                                                    function changeBackground() {
                                                                        if (pass.value !== '') {
                                                                            document.querySelector('#user_culture_square_button-{{$el->app_id}}-{{$el->aids_id}}').style.background = '#00C759';
                                                                            document.querySelector('#user_culture_square_button-{{$el->app_id}}-{{$el->aids_id}}').style.color = 'white';
                                                                        } else {
                                                                            document.querySelector('#user_culture_square_button-{{$el->app_id}}-{{$el->aids_id}}').style.background = 'red';
                                                                            document.querySelector('#user_culture_square_button-{{$el->app_id}}-{{$el->aids_id}}').style.color = 'white';
                                                                        }
                                                                    }
                                                                </script>

                                                            @endforeach

                                                            <div class="d-flex justify-content-center">

                                                                <form class="w-100 ml-1" action="{{route('applicationPublish', $collect->first()->application_id)}}" method="POST">
                                                                    @csrf
                                                                    <button style="background-color: #00C759" class="btn btn-outline btn-sm mt-2 w-100 ml-1" type="submit">
                                                                        Опубликовать
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>

                        @endif


                        {{-- For published - опубликованные --}}
                         @include('applicationStatus.publishedApplication')
                        {{--end For published--}}

                        {{--    for draft - предложений --}}
                        @include('applicationStatus.draftApplication')
                        {{--    for draft - предложений --}}

                        {{--    for order - заказ --}}
                        @include('applicationStatus.orderApplication')
                        {{--    for order - заказ --}}


                    </div>
                </div>
            </div>
            @endif
            {{--            for farmer--}}
            @include('farmer_app')
            {{--            for farmer--}}
        </div>
</div>






{{-- Для фермера--}}


<script>
    function text(x){
        if (x == selfCall){
            document.getElementById('selfCall').style.display = "block"
            document.getElementById('delivery').style.display = "none";
        }
        else if (x == delivery){
            document.getElementById('delivery').style.display = "block";
            document.getElementById('selfCall').style.display = "none";
        }
    }
</script>
<script>
    function openApp(form) {
        if (form.style.display == "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }
</script>

<script>
    function openAppApplications(form) {
        if (form.style.display == "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }
</script>

<script>
    function openApp(form) {
        if (form.style.display == "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }
</script>
<script>
    function pre_pay2(pre_pay) {
        if (pre_pay.style.display == "none") {
            pre_pay.style.display = "block";
        } else {
            pre_pay.style.display = "none";
        }
    }
    function pre_pay1(pre_pay) {
        if (pre_pay.style.display == "none") {
            pre_pay.style.display = "block";
        } else {
            pre_pay.style.display = "none";
        }
    }
</script>

<script>
    function conditions1(pre_pay) {
        if (pre_pay.style.display == "none") {
            pre_pay.style.display = "block";
        } else {
            pre_pay.style.display = "none";
        }
    }
    function conditions2(pre_pay) {
        if (pre_pay.style.display == "none") {
            pre_pay.style.display = "block";
        } else {
            pre_pay.style.display = "none";
        }
    }
</script>
