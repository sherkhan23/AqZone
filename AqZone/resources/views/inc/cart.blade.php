@extends('layouts.app')
@section('title') Cart @endsection

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
    <div class="row">
        <div class="col-md-4 mt-2">
            <div class="card flex-shrink-0 p-3 bg-white shadow">
                <h5 class="text-muted mb-0">Корзинка</h5>
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
                </form>
                <button class="btn-sm button form-control text-dark mt-3" style="background-color: #FFC528" onclick="hide(document.getElementById('form1'))">Оформить заявку</button>

                <form action="{{route('addApplication')}}" method="POST">
                    @csrf
                    <div id="form1" class="mt-3" style="display: none">

                        <div class="form-check form-switch py-2">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                            <label class="form-check-label" for="flexSwitchCheckChecked">Недилимый ассортимент</label>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Срок поставки</label>
                            <div class="col-sm-6">
                                <div class="input-group mb-2">
                                    <input name="delivery_date" type="date" class="form-control" style="font-size: 90%" required>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="bi bi-calendar-check" style="font-size: 150%"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4>Условия оплаты и поставки </h4>
                        <p>Условия поставки</p>

                        <div class="form-check">
                            <input onclick="text(selfCall)" class="form-check-input" name="delivery_type" value="selfCall" type="radio" id="1" checked>
                            <label class="form-check-label" for="flexSwitchCheckDefault">Самовывоз</label>
                        </div>
                        <div class="form-check">
                            <input onclick="text(delivery)" class="form-check-input" name="delivery_type" value="delivery" type="radio" id="0">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Доставка</label>
                        </div>

                        <div id="selfCall">
                            {{-- Самовызов--}}
                            <div class="btn-group mt-2">
                                <select name="city_id" id="city_id" class="form-select" aria-label="Default select example">
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

                            <p class="d-flex align-items-end">
                                <small>
                                    <button type="button" class="text-primary" data-toggle="modal" data-target="#addAddress">
                                        Добавить новый адрес
                                    </button>
                                </small>
                            </p>

                        </div>


                        <p class="mt-2">Условие оплаты</p>
                        <div class="form-check">
                            <input onclick="pre_pay1(document.getElementById('block_pre_pay'))" class="form-check-input" type="radio" name="payment_type" id="payfull" value="payfull" checked>
                            <label class="form-check-label" for="example1">
                                100% предоплата
                            </label>
                        </div>
                        <div class="form-check d-flex" style="display: inline-block">
                            <input onclick="pre_pay2(document.getElementById('block_pre_pay'))" class="form-check-input" type="radio" name="payment_type" id="pre_pay" value="pre_pay">
                            <label class="form-check-label ml-2" for="example2">
                                Указать % предоплаты
                            </label>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                        </div>

                        <div class="form-group row py-1" id="block_pre_pay" style="display: none">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-8 col-form-label">Предоплата:</label>
                                <div class="col-sm-4">
                                    <input class="form-control" value="0" name="pre_pay" min="0" max="100">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row py-1" id="postponement">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-8 col-form-label">Отсрочка платежа, дней*</label>
                                <div class="col-sm-4">
                                    <input class="form-control" value="30" name="postponement" min="0" max="100">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group mt-2">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message" placeholder="Комментарий"></textarea>
                        </div>
                        <button class="form-control btn-sm mt-2" style="background-color: #FFC528; color: black">Опубликовать Заявку</button>
                    </div>

                </form>

                <!-- Modal -->
                <div class="modal fade" id="addAddress" tabindex="-1" role="dialog" aria-labelledby="addAddress" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Добавьте новый адрес</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{route('editLocation')}}" id="form1">
                                    @csrf
                                    <h6 class="mb-0 mt-3">Страна</h6>
                                    <div class="btn-group mt-2">
                                        <select name="country_id" class="form-select" aria-label="Default select example">
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->countryName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('country_id')
                                    <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                    <livewire:user-location></livewire:user-location>

                                    <h6 class="mb-0 mt-3">Адрес</h6>
                                    <input name="address" class="form-control mt-2">
                                    @error('address')
                                    <p class="text-red-500">{{ $message }}</p>
                                    @enderror

                                    <h5 class="mb-0 mt-3">Коментарий</h5>
                                    <input name="comment" class="form-control mt-2">

                                    <button class="btn btn-outline-primary mt-3" type="submit">Сохранить</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Назад</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{--                Modal end--}}

            </div>
        </div>
        <div class="col-md-8">
            {{--            Все уведомлени--}}
            @error('errorSquare')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            @error('city_id')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            @error('user_location_id')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            @error('user_culture_square')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            @error('pre_pay')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            @error('delivery_type')
            <p class="text-red-500">{{ $message }}</p>
            @enderror

            @if(session('errorPrePay'))
                <p class="p-2 bg-danger text-white rounded mt-3">{{session('errorPrePay')}}</p>
            @endif
            @if(session('errorNull'))
                <p class="p-2 bg-danger text-white rounded mt-3">{{session('errorNull')}}</p>
            @endif

            @if(session('errorUtilNorm'))
                <p class="p-2 bg-danger text-white rounded mt-3">{{session('errorUtilNorm')}}</p>
            @endif

            @if(session('errorSquare'))
                <p class="p-2 bg-danger text-white rounded mt-3">{{session('errorSquare')}}</p>
            @endif

            @if(session('successDelCart'))
                <p class="p-2 bg-danger text-white rounded mt-3">{{session('successDelCart')}}</p>
            @endif
            @if(session('successAddApp'))
                <p class="p-2 bg-success text-white rounded mt-3">{{session('successAddApp')}}</p>
            @endif
            @if(session('updateMess'))
                <p class="p-2 bg-success text-white rounded mt-3">{{session('updateMess')}}</p>
            @endif
            @if(session('updateMessSquare'))
                <p class="p-2 bg-success text-white rounded mt-3">{{session('updateMessSquare')}}</p>
            @endif

            @foreach($carts as $el)
                @if($el->user_id == Auth::user()->user_id)
                    <div class="card shadow-sm border-5 rounded-3 mt-2" style="border: 1px solid gray">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-3 col-xl-3">
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
                                    <form action="{{route('updateUtilNorm', $el->cart_id)}}" method="POST">
                                        @csrf
                                        Норма рассхода {{$el->unitOfMeasureName}}
                                        <small class="text-muted">Рекомендованное:
                                            <br>
                                            Мин.{{$el->minUtilizationRate}} -
                                            Макс.{{$el->maxUtilizationRate}}
                                        </small>
                                        <input id="user_culture_util_norm-{{$el->aids_id}}" class="form-control mt-2" value="{{$el->user_culture_util_norm}}" name="user_culture_util_norm">
                                        <button id="user_culture_util_norm_button-{{$el->aids_id}}" type="submit" class="form-control mt-1 btn-sm">Изменить норму</button>
                                    </form>
                                </div>

                                <div class="col-md-3">
                                    <form action="{{route('updateSquare', $el->cart_id)}}" method="POST">
                                        @csrf
                                        Площадь, га
                                        <br>
                                        <small class="text-muted">Культура:
                                            <br>
                                            {{$el->user_culture}}
                                        </small>

                                        <input class="form-control mt-2" value="{{$el->user_culture}}" name="culture_name" style="display: none">

                                        <input  class="form-control mt-2" id="user_culture_square-{{$el->aids_id}}" value="{{$el->user_culture_square}}" name="user_culture_square">
                                        <button type="submit" id="user_culture_square_button-{{$el->aids_id}}" class="form-control mt-1 btn-sm">Изменить площадь</button>
                                    </form>
                                </div>
                                {{--script to change background active input--}}
                                <script>
                                    var pass = document.querySelector('#user_culture_square-{{$el->aids_id}}');
                                    var util = document.querySelector('#user_culture_util_norm-{{$el->aids_id}}');
                                    pass.addEventListener('input', changeBackground);
                                    util.addEventListener('input', changeBackgroundUtil);
                                    function changeBackgroundUtil(){
                                        if (util.value !== '') {
                                            document.querySelector('#user_culture_util_norm_button-{{$el->aids_id}}').style.background = '#00C759';
                                            document.querySelector('#user_culture_util_norm_button-{{$el->aids_id}}').style.color = 'white';
                                        } else {
                                            document.querySelector('#user_culture_util_norm_button-{{$el->aids_id}}').style.background = 'red';
                                            document.querySelector('#user_culture_util_norm_button-{{$el->aids_id}}').style.color = 'white';
                                        }
                                    }
                                    function changeBackground() {
                                        if (pass.value !== '') {
                                            document.querySelector('#user_culture_square_button-{{$el->aids_id}}').style.background = '#00C759';
                                            document.querySelector('#user_culture_square_button-{{$el->aids_id}}').style.color = 'white';
                                        } else {
                                            document.querySelector('#user_culture_square_button-{{$el->aids_id}}').style.background = 'red';
                                            document.querySelector('#user_culture_square_button-{{$el->aids_id}}').style.color = 'white';
                                        }
                                    }
                                </script>



                                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                    <div class="d-flex flex-row align-items-center mb-1">

                                    </div>
                                    <div class="d-flex flex-column mt-4">

                                        <a style="background-color: #00C759" class="text-black btn btn-sm" href="{{ route('show_aids', $el->aids_id) }}">
                                            Перейти
                                        </a>
                                        <form action="{{route('delCart', $el->cart_id)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button style="background-color: #ef6464" class="btn btn-outline btn-sm mt-2 w-100" type="submit">
                                                <i class="bi bi-trash" style="font-size: 15px"></i> Убрать с корзины
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

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

