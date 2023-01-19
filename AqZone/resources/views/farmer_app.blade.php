{{--        for Farmer--}}
@if(\Illuminate\Support\Facades\Auth::user()->farmer == 0)
    <div class="row">
        <ul class="nav nav-tabs" id="tabApplication" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="published-tab btn-warning" data-bs-toggle="tab" data-bs-target="#published" type="button" role="tab" aria-controls="published" aria-selected="false">
                    Опубликованные
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="draft-tab btn-warning" data-bs-toggle="tab" data-bs-target="#draft" type="button" role="tab" aria-controls="draft" aria-selected="false">
                    Предложение
                    (+{{$draftCountSeller}})
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="consideration-tab btn-warning" data-bs-toggle="tab" data-bs-target="#consideration" type="button" role="tab" aria-controls="consideration" aria-selected="false">
                    На расмотрении
                    ({{$offerCountSeller}})
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
                        <img src="media/Frame 24.png" class="btn border-0 my-3"
                             onclick="hide(document.getElementById('form1'))">
                        </img>
                    </form>
                    <form>
                        <button class="button form-control text-dark" style="background-color: #FFC528"  type="submit">Искать</button>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="tab-content" id="tabApplication">
                    @if(session('success'))
                        <p class="p-2 bg-success text-white rounded mt-3">{{session('success')}}</p>
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
                    @if(session('updateMess'))
                        <p class="p-2 bg-success text-white rounded mt-3">{{session('updateMess')}}</p>
                    @endif



                    {{-- For published--}}
                    <div class="tab-pane fade show active" id="published" role="tabpanel" aria-labelledby="published-tab">
                        @foreach($viewCollect as $collect)
                            @if($collect->first()->app_status == 'published')

                                <div class="card shadow-sm border-5 rounded-3 mt-2" style="border: 1px solid gray">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-4">

                                                {{--                                                        @foreach($offers as $offer)--}}
                                                {{--                                                            @if($collect->first()->application_id == $offer->offer_id)--}}
                                                {{--                                                                <span class="bg-danger">*</span>--}}
                                                {{--                                                            @endif--}}
                                                {{--                                                        @endforeach--}}

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
                                            </div>

                                            <div class="col-md-4 d-flex" style="justify-content: center; align-items: center;">
                                                <button class="p-2" style="border-radius: 10px; border:1px solid ">
                                                    Статус -
                                                    @if($collect->first()->app_status == 'published')
                                                        Опубликовано
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
                                                <button data-toggle="modal" data-target="#toOffer-{{$collect->first()->application_id}}" class="p-3 btn-outline-warning rounded">
                                                    <i class="bi bi-send-check" style="font-size: 130%"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade bd-example-modal-lg" id="toOffer-{{$collect->first()->application_id}}" tabindex="-1" role="dialog" aria-labelledby="toOffer-{{$collect->first()->application_id}}" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                        <div class="modal-content" style="width: 1500px">
                                                            <div class="modal-header bg-success">
                                                                <h5 class="modal-title text-white" id="exampleModalLongTitle">Предложение</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span class="text-white" aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>


                                                            <form method="POST" action="{{route('createOffer', $collect->first()->application_id)}}">
                                                                @csrf
                                                                <div class="modal-body">

                                                                    {{--        Поставка--}}
                                                                    <div class="form-check">
                                                                        <input onclick="conditions1(document.getElementById('block_new_conditions-{{$collect->first()->application_id}}'))" class="form-check-input" type="radio" name="conditions_app" id="payfull" value="payfull" checked>
                                                                        <label class="form-check-label" for="example1">
                                                                            Оставить как есть
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex" style="display: inline-block">
                                                                        <input onclick="conditions2(document.getElementById('block_new_conditions-{{$collect->first()->application_id}}'))" class="form-check-input" type="radio" name="conditions_app" value="pre_pay">
                                                                        <label class="form-check-label ml-2" for="example2">
                                                                            Новая условие заявки
                                                                        </label>
                                                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                                                                    </div>
                                                                    {{--  Поставка--}}

                                                                    <div class="form-group row py-3 card shadow-sm border-5 rounded-3 mt-2" id="block_new_conditions-{{$collect->first()->application_id}}" style="display: none;">
                                                                        <div class="row mx-1">
                                                                            <div class="col-md-6">
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
                                                                            </div>


                                                                            <div class="col-md-6">
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

                                                                            </div>
                                                                        </div>
                                                                    </div>




                                                                    <div class="card shadow-sm border-5 rounded-3 mt-2" style="border: 1px solid gray">
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="col-md-9">
                                                                                    <h5 class="text-secondary">Условие Заявки</h5>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <span>Условия поставки:</span>
                                                                                <p class="text-secondary">
                                                                                    @if($collect->first()->delivery_type == 'selfCall')
                                                                                        Самовывоз -
                                                                                        {{$collect->first()->cityName}}
                                                                                    @elseif($collect->first()->delivery_type == 'delivery')

                                                                                        Доставка -
                                                                                        {{$collect->first()->address}}
                                                                                        <br>
                                                                                        <span>
                                                                                            {{$collect->first()->regionName}},
                                                                                            {{$collect->first()->subRegionName}}, {{$collect->first()->localityName}}
                                                                                        </span>
                                                                                    @else

                                                                                    @endif
                                                                                </p>
                                                                                <br>
                                                                                <span>Условие оплаты:</span>
                                                                                <p class="text-secondary">
                                                                                    @if($collect->first()->payment_type == 'payfull')
                                                                                        100% предоплата
                                                                                    @elseif($collect->first()->payment_type == 'pre_pay')
                                                                                        {{$collect->first()->pre_pay}}% предоплата
                                                                                    @else

                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <hr>

                                                                    <table class="table table-bordered" style="border-radius: 10px">
                                                                        <thead class="">
                                                                        <tr>
                                                                            <th scope="col">Препорат:</th>
                                                                            <th scope="col">Требуемое количество:</th>
                                                                            <th scope="col">Предлагаемое количество:</th>
                                                                            <th scope="col">Предлагаемое цена с НДС:</th>
                                                                            <th scope="col">Сумма с НДС</th>


                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @foreach($collect as $el)

                                                                            <tr>
                                                                                <td scope="row">
                                                                                    {{$el->aidName}}
                                                                                    <input style="display: none" name="user_culture_util_norm" value="{{$el->user_culture_util_norm}}">
                                                                                    <input style="display: none" name="culture_name" value="{{$el->aidName}}">
                                                                                    <input style="display: none" name="user_culture_square" value="{{$el->user_culture_square}}">

                                                                                    <div class="d-flex flex-row">
                                                                                        <span class="text-muted">Категория: </span>
                                                                                        <span class="ml-1"> {{$el->categoryName}}</span>
                                                                                    </div>

                                                                                    <div class="mt-1 mb-0 text-muted small">
                                                                                        <span>{{$el->ProducerName}}</span>
                                                                                        <span>{{$el->producerCountry}}</span>
                                                                                    </div>

                                                                                    <div class="mb-2 text-muted small">
                                                                                        <span>{{$el->BrandName}}</span>
                                                                                        {{--                                    component--}}
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <input class="form-control" disabled value="{{$quantity = $el->user_culture_util_norm*$el->user_culture_square}}">
                                                                                    <input style="display: none" class="form-control" name="requiredQuantity" value="{{$quantity = $el->user_culture_util_norm*$el->user_culture_square}}">
                                                                                </td>
                                                                                <td>
                                                                                    <input class="form-control" type="number" name="offerQuantity[{{$el->app_id}}]" id="offerQuantity-{{$el->application_id}}-{{$el->app_id}}-{{$el->aids_id}}" required>
                                                                                </td>
                                                                                <td>
                                                                                    <input class="form-control" type="number" name="offerSumNDS[{{$el->app_id}}]" id="offerPriceNDS-{{$el->application_id}}-{{$el->app_id}}-{{$el->aids_id}}" required>
                                                                                </td>
                                                                                <td class="d-flex" style="justify-content: center" >
                                                                                    <span><input style="width: 150%" name="sumNDS[{{$el->app_id}}]" id='summands-{{$el->application_id}}-{{$el->app_id}}-{{$el->aids_id}}' type="text" class="form-control formBlock"/></span>

                                                                                    <span style="justify-content: center" class="d-flex p-3" id="summands-{{$el->application_id}}-{{$el->app_id}}-{{$el->aids_id}}"></span>
                                                                                    <script>
                                                                                        type="text/javascript"
                                                                                        src="https://code.jquery.com/jquery-1.9.1.js"
                                                                                        $('input').keyup(function(){ // run anytime the value changes
                                                                                            var firstValue  = Number($('#offerQuantity-{{$el->application_id}}-{{$el->app_id}}-{{$el->aids_id}}').val());
                                                                                            var secondValue = Number($('#offerPriceNDS-{{$el->application_id}}-{{$el->app_id}}-{{$el->aids_id}}').val());
                                                                                            $('#total_expenses1').html(firstValue * secondValue); // add them and output it
                                                                                            document.getElementById('summands-{{$el->application_id}}-{{$el->app_id}}-{{$el->aids_id}}').value = firstValue * secondValue;
                                                                                        });
                                                                                    </script>
                                                                                </td>

                                                                                <td>
                                                                                    <button class="form-control bg-danger">
                                                                                        <i class="bi bi-file-earmark-minus text-white"></i>
                                                                                    </button>
                                                                                </td>
                                                                            </tr>

                                                                        @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="modal-footer">

                                                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Назад</button>
                                                                    <button type="submit" class="btn btn-outline-success">Отправить</button>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

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
                                                                <span>Условия поставки:</span>
                                                                <p class="text-secondary">
                                                                    @if($collect->first()->delivery_type == 'selfCall')
                                                                        Самовывоз -
                                                                        {{$collect->first()->cityName}}
                                                                    @elseif($collect->first()->delivery_type == 'delivery')

                                                                        Доставка -
                                                                        {{$collect->first()->address}}
                                                                        <br>
                                                                        <span>
                                                                                            {{$collect->first()->regionName}},
                                                                                            {{$collect->first()->subRegionName}}, {{$collect->first()->localityName}}
                                                                                        </span>
                                                                    @else

                                                                    @endif
                                                                </p>
                                                                <br>
                                                                <span>Условие оплаты:</span>
                                                                <p class="text-secondary">
                                                                    @if($collect->first()->payment_type == 'payfull')
                                                                        100% предоплата
                                                                    @elseif($collect->first()->payment_type == 'pre_pay')
                                                                        {{$collect->first()->pre_pay}}% предоплата
                                                                    @else

                                                                    @endif
                                                                </p>
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
                                                                    Норма рассхода {{$el->unitOfMeasureName}}
                                                                    <small class="text-muted">Рекомендованное:
                                                                        <br>
                                                                        Мин.{{$el->minUtilizationRate}} -
                                                                        Макс.{{$el->maxUtilizationRate}}
                                                                    </small>
                                                                    <input disabled class="form-control mt-2" value="{{$el->user_culture_util_norm}}" name="user_culture_util_norm">
                                                                </div>

                                                                <div class="col-md-3">
                                                                    Площадь, га
                                                                    <br>
                                                                    <small class="text-muted">Культура:
                                                                        <br>
                                                                        "{{$el->culture_name}}"
                                                                    </small>
                                                                    <input disabled class="form-control mt-2" value="{{$el->user_culture_square}}" name="user_culture_square">

                                                                </div>

                                                                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                                                    <div class="d-flex flex-column mt-4">
                                                                        <a style="background-color: #00C759" class="text-black btn btn-sm" href="{{ route('show_aids', $el->aids_id) }}">
                                                                            Перейти
                                                                        </a>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    {{--For published--}}


                    {{-- For consideration--}}
                    <div class="tab-pane fade show" id="consideration" role="tabpanel" aria-labelledby="consideration-tab">
                        @foreach($offersCollect as $collect)
                            @if($collect->first()->offer_status == 'consideration')
                                <div class="card shadow-sm border-5 rounded-3 mt-2" style="border: 1px solid gray">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-4">

                                                {{--                                                        @foreach($offers as $offer)--}}
                                                {{--                                                            @if($collect->first()->application_id == $offer->offer_id)--}}
                                                {{--                                                                <span class="bg-danger">*</span>--}}
                                                {{--                                                            @endif--}}
                                                {{--                                                        @endforeach--}}

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
                                            </div>

                                            <div class="col-md-4 d-flex" style="justify-content: center; align-items: center;">
                                                <button class="p-2" style="border-radius: 10px; border:1px solid ">
                                                    Статус -
                                                    На расмотрении

                                                </button>
                                            </div>

                                            <div class="col-md-2 d-flex" style="justify-content: center; align-items: center;">
                                                <button class="px-5" id="app-open" type="button" onclick="openApp(document.getElementById('consideration-{{$collect->first()->offer_id}}'))">
                                                    <i class="bi bi-chevron-compact-down"></i>
                                                </button>
                                            </div>

                                            <div class="col-md-2 d-flex" style="justify-content: center; align-items: center;">
                                                <button data-toggle="modal" data-target="" class="p-3 btn-outline-warning rounded">
                                                    <i class="bi bi-send-check" style="font-size: 130%"></i>
                                                    <i class="bi bi-arrow-90deg-left text-danger"></i>                                                        </button>
                                            </div>

                                            <div id="consideration-{{$collect->first()->offer_id}}" style="display: none">
                                                <div>
                                                    <div class="card shadow-sm border-5 rounded mt-2" style="border: 1px solid gray">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    <h5 class="text-secondary">Условие Заявки</h5>
                                                                </div>

                                                                <div class="col-md-3 border-sm-start-none border-start d-flex" style="justify-content: center">
                                                                    <button id="app-open" type="button" class="bg-warning" onclick="openApp(document.getElementById('consideration-delivery-{{$collect->first()->offer_id}}'))">
                                                                        <i class="bi bi-sort-down-alt"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="display: none" id="consideration-delivery-{{$collect->first()->offer_id}}">
                                                                <span>Условия поставки:</span>
                                                                <p class="text-secondary">
                                                                    @if($collect->first()->delivery_type == 'selfCall')
                                                                        Самовывоз -
                                                                        {{$collect->first()->cityName}}
                                                                    @elseif($collect->first()->delivery_type == 'delivery')

                                                                        Доставка -
                                                                        {{$collect->first()->address}}
                                                                        <br>
                                                                        <span>
                                                                                            {{$collect->first()->regionName}},
                                                                                            {{$collect->first()->subRegionName}}, {{$collect->first()->localityName}}
                                                                                        </span>
                                                                    @else

                                                                    @endif
                                                                </p>
                                                                <br>
                                                                <span>Условие оплаты:</span>
                                                                <p class="text-secondary">
                                                                    @if($collect->first()->payment_type == 'payfull')
                                                                        100% предоплата
                                                                    @elseif($collect->first()->payment_type == 'pre_pay')
                                                                        {{$collect->first()->pre_pay}}% предоплата
                                                                    @else

                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Предложений--}}
                                                <div class="card shadow-sm border-5 rounded mt-2" style="border: 1px solid gray">
                                                    <div class="card-body">
                                                        <div class="row">

                                                            <div class="col-md-9">
                                                                <h5 class="text-secondary">Предложении</h5>
                                                            </div>

                                                            <div class="col-md-3 border-sm-start-none border-start d-flex" style="justify-content: center">
                                                                <button id="app-open" type="button" class="bg-warning" onclick="openAppApplications(document.getElementById('applications-apps-{{$collect->first()->application_id}}'))">
                                                                    <i class="bi bi-sort-down-alt"></i>
                                                                </button>
                                                            </div>

                                                            <div class="row p-4" style="display: none" id="applications-apps-{{$collect->first()->application_id}}">

                                                                <table class="table table-hover">
                                                                    <thead>
                                                                    <tr>
                                                                        <th scope="col">Предлоджение</th>
                                                                        <th scope="col">Покрытие по количеству</th>
                                                                        <th scope="col">Сумма</th>
                                                                        <th scope="col">Количество препаратов <br>с лучшей ценой</th>
                                                                        <th scope="col">Статус</th>
                                                                    </tr>
                                                                    </thead>
                                                                    @foreach($offersCollect as $offerCollect)
                                                                        @if($offerCollect->first()->publication_id == $collect->first()->application_id)
                                                                            <tbody>
                                                                            <tr>
                                                                                <th scope="row">000{{$offerCollect->first()->offer_id}}</th>
                                                                                <td>
                                                                                    {{$requiredQ = \App\Models\OfferData::query()->where('offer_collect', '=', $offerCollect->first()->offer_id)->get()->sum('requiredQuantity') / \App\Models\OfferData::query()->where('offer_collect', '=', $offerCollect->first()->offer_id)->get()->sum('sumNDS')}}

                                                                                </td>
                                                                                <td>
                                                                                    {{\App\Models\offerData::query()->where('offer_collect', '=', $offerCollect->first()->offer_id)->get()->sum('sumNDS')}}
                                                                                </td>
                                                                                <td>
                                                                                    {{\App\Models\offerData::query()->where('offer_collect', '=', $offerCollect->first()->offer_id)->get()->count()}}/{{ \App\Models\offerData::query()->where('offer_collect', '=', $offerCollect->first()->offer_id)->get()->sum('minOfferPrice')}}
                                                                                </td>
                                                                                <td></td>
                                                                                <td>
                                                                                    <button type="button" class="btn-sm btn-success" data-toggle="modal" data-target="#applicationData-{{$offerCollect->first()->offer_id}}">
                                                                                        Посмотреть
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>

                                                                        @endif
                                                                    @endforeach
                                                                </table>
                                                            </div>


                                                            <!-- Modal -->
                                                            @foreach($offersCollect as $offerCollect)
                                                                @if($offerCollect->first()->publication_id == $collect->first()->application_id)
                                                                    <form method="POST" action="{{route('receiveOffer', $offerCollect->first()->offer_id)}}">

                                                                        @csrf
                                                                        <div class="modal fade" id="applicationData-{{$offerCollect->first()->offer_id}}" tabindex="-1" role="dialog" aria-labelledby="applicationData-{{$offerCollect->first()->offer_id}}" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLongTitle">Заявка {{$offerCollect->first()->offer_id}}</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <table class="table table-bordered p-1 ml-1" style="border-radius: 10px; width: 90%">
                                                                                            @foreach($offerCollect as $offer)
                                                                                                @if($offer->offer_collect == $offerCollect->first()->offer_id)
                                                                                                    <thead>
                                                                                                    <tr>
                                                                                                        <th scope="col">Заявка</th>
                                                                                                        <th scope="col">Препорат</th>
                                                                                                        <th scope="col">Требуемое количество</th>
                                                                                                        <th scope="col">Предлагает</th>
                                                                                                        <th scope="col">Предлагаемая сумма с НДС </th>
                                                                                                        <th scope="col"> Сумма с НДС </th>
                                                                                                    </tr>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                    <tr>
                                                                                                        <th scope="row">{{$offerCollect->first()->offer_collect}}</th>
                                                                                                        <td>{{$offer->aidName}}</td>
                                                                                                        <td>{{$offer->requiredQuantity}}</td>
                                                                                                        <td>{{$offer->offerQuantity}}</td>
                                                                                                        <td>
                                                                                                            {{$offer->sumNDS}}
                                                                                                            <br>
                                                                                                            @if($offer->minOfferPrice == 1)
                                                                                                                <small class="bg-success text-white rounded">Лучшая цена</small>
                                                                                                            @endif
                                                                                                        </td>
                                                                                                        <th scope="row">
                                                                                                            {{$offer->offerSumNDS}}

                                                                                                        </th>
                                                                                                    </tr>
                                                                                                    </tbody>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </table>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                            @endif
                                                        @endforeach
                                                        <!-- Modal -->

                                                        </div>
                                                    </div>
                                                </div>


                                                {{-- Предложений--}}

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
                                                                    Норма рассхода {{$el->unitOfMeasureName}}
                                                                    <small class="text-muted">Рекомендованное:
                                                                        <br>
                                                                        Мин.{{$el->minUtilizationRate}} -
                                                                        Макс.{{$el->maxUtilizationRate}}
                                                                    </small>
                                                                    <input disabled class="form-control mt-2" value="{{$el->user_culture_util_norm}}" name="user_culture_util_norm">
                                                                </div>

                                                                <div class="col-md-3">
                                                                    Площадь, га
                                                                    <br>
                                                                    <small class="text-muted">Культура:
                                                                        <br>
                                                                        "{{$el->cultureNameOffer}}"
                                                                    </small>
                                                                    <input disabled class="form-control mt-2" value="{{$el->user_culture_square}}" name="user_culture_square">

                                                                </div>

                                                                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                                                    <div class="d-flex flex-column mt-4">
                                                                        <a style="background-color: #00C759" class="text-black btn btn-sm" href="{{ route('show_aids', $el->aids_id) }}">
                                                                            Перейти
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endforeach
                                                <div class="d-flex justify-content-center">

                                                    <form class="w-100" method="POST" action="{{route('publishToNew', $collect->first()->application_id)}}">                                                            @csrf
                                                        <button class="btn btn-danger btn-sm mt-2 w-100 ml-1" type="submit">
                                                            Отозвать
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
                    {{--For consideration--}}

                    {{-- For draft--}}
                    <div class="tab-pane fade show" id="draft" role="tabpanel" aria-labelledby="draft-tab">
                        @foreach($offersCollect as $collect)
                            @if($collect->first()->offer_status == 'draft' or  $collect->first()->offer_status == 'accept')
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
                                            </div>

                                            <div class="col-md-4 d-flex" style="justify-content: center; align-items: center;">
                                                <button class="p-2" style="border-radius: 10px; border:1px solid ">
                                                    Статус -
                                                    Предложение
                                                </button>
                                            </div>

                                            <div class="col-md-2 d-flex" style="justify-content: center; align-items: center;">
                                                <button class="px-5" id="app-open" type="button" onclick="openApp(document.getElementById('consideration-{{$collect->first()->offer_id}}'))">
                                                    <i class="bi bi-chevron-compact-down"></i>
                                                </button>
                                            </div>

                                            {{-- Modal accept acceptOffer --}}
                                            <form class="col-md-2 d-flex" method="POST" action="{{route('acceptOffer', $collect->first()->application_id)}}" style="justify-content: center; align-items: center;">
                                                @csrf
                                                <div>
                                                    <button type="button" data-toggle="modal" data-target="#acceptApplication-{{$collect->first()->offer_id}}" class="p-2 btn-warning rounded text-black">
                                                        Принять
                                                    </button>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="acceptApplication-{{$collect->first()->offer_id}}" tabindex="-1" role="dialog" aria-labelledby="acceptApplication-{{$collect->first()->offer_id}}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Принять предложение</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {{$collect->first()->application_id}}
                                                                Вы принимаете предложение, и вы будете уже свзяываться с фермером!
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Назад</button>
                                                                <button type="submit" class="btn btn-warning">Принять</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            {{-- Modal accept acceptOffer --}}


                                            <div id="consideration-{{$collect->first()->offer_id}}" style="display: none">
                                                <div>
                                                    <div class="card shadow-sm border-5 rounded mt-2" style="border: 1px solid gray">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    <h5 class="text-secondary">Условие Заявки</h5>
                                                                </div>

                                                                <div class="col-md-3 border-sm-start-none border-start d-flex" style="justify-content: center">
                                                                    <button id="app-open" type="button" class="bg-warning" onclick="openApp(document.getElementById('consideration-delivery-{{$collect->first()->offer_id}}'))">
                                                                        <i class="bi bi-sort-down-alt"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="display: none" id="consideration-delivery-{{$collect->first()->offer_id}}">
                                                                <span>Условия поставки:</span>
                                                                <p class="text-secondary">
                                                                    @if($collect->first()->delivery_type == 'selfCall')
                                                                        Самовывоз -
                                                                        {{$collect->first()->cityName}}
                                                                    @elseif($collect->first()->delivery_type == 'delivery')

                                                                        Доставка -
                                                                        {{$collect->first()->address}}
                                                                        <br>
                                                                        <span>
                                                                                            {{$collect->first()->regionName}},
                                                                                            {{$collect->first()->subRegionName}}, {{$collect->first()->localityName}}
                                                                                        </span>
                                                                    @else

                                                                    @endif
                                                                </p>
                                                                <br>
                                                                <span>Условие оплаты:</span>
                                                                <p class="text-secondary">
                                                                    @if($collect->first()->payment_type == 'payfull')
                                                                        100% предоплата
                                                                    @elseif($collect->first()->payment_type == 'pre_pay')
                                                                        {{$collect->first()->pre_pay}}% предоплата
                                                                    @else

                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                {{-- Предложений--}}
                                                <div class="card shadow-sm border-5 rounded mt-2" style="border: 1px solid gray">
                                                    <div class="card-body">
                                                        <div class="row">

                                                            <div class="col-md-9">
                                                                <h5 class="text-secondary">Предложении</h5>
                                                            </div>

                                                            <div class="col-md-3 border-sm-start-none border-start d-flex" style="justify-content: center">
                                                                <button id="app-open" type="button" class="bg-warning" onclick="openAppApplications(document.getElementById('applications-apps-{{$collect->first()->application_id}}'))">
                                                                    <i class="bi bi-sort-down-alt"></i>
                                                                </button>
                                                            </div>

                                                            <div class="row p-4" style="display: none" id="applications-apps-{{$collect->first()->application_id}}">

                                                                <table class="table table-hover">
                                                                    <thead>
                                                                    <tr>
                                                                        <th scope="col">Предлоджение</th>
                                                                        <th scope="col">Покрытие по количеству</th>
                                                                        <th scope="col">Сумма</th>
                                                                        <th scope="col">Количество препаратов <br>с лучшей ценой</th>
                                                                        <th scope="col">Статус</th>
                                                                    </tr>
                                                                    </thead>
                                                                    @foreach($offersCollect as $offerCollect)
                                                                        @if($offerCollect->first()->publication_id == $collect->first()->application_id)
                                                                            <tbody>
                                                                            <tr>
                                                                                <th scope="row">000{{$offerCollect->first()->offer_id}}</th>
                                                                                <td>
                                                                                    {{$requiredQ = \App\Models\OfferData::query()->where('offer_collect', '=', $offerCollect->first()->offer_id)->get()->sum('requiredQuantity') / \App\Models\OfferData::query()->where('offer_collect', '=', $offerCollect->first()->offer_id)->get()->sum('sumNDS')}}

                                                                                </td>
                                                                                <td>
                                                                                    {{\App\Models\offerData::query()->where('offer_collect', '=', $offerCollect->first()->offer_id)->get()->sum('sumNDS')}}
                                                                                </td>
                                                                                <td>
                                                                                    {{\App\Models\offerData::query()->where('offer_collect', '=', $offerCollect->first()->offer_id)->get()->count()}}/{{ \App\Models\offerData::query()->where('offer_collect', '=', $offerCollect->first()->offer_id)->get()->sum('minOfferPrice')}}
                                                                                </td>
                                                                                <td></td>
                                                                                <td>
                                                                                    <button type="button" class="btn-sm btn-success" data-toggle="modal" data-target="#applicationData-{{$offerCollect->first()->offer_id}}">
                                                                                        Посмотреть
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>

                                                                        @endif
                                                                    @endforeach
                                                                </table>
                                                            </div>


                                                            <!-- Modal -->
                                                            @foreach($offersCollect as $offerCollect)
                                                                @if($offerCollect->first()->publication_id == $collect->first()->application_id)
                                                                    <form method="POST" action="{{route('receiveOffer', $offerCollect->first()->offer_id)}}">

                                                                        @csrf
                                                                        <div class="modal fade" id="applicationData-{{$offerCollect->first()->offer_id}}" tabindex="-1" role="dialog" aria-labelledby="applicationData-{{$offerCollect->first()->offer_id}}" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLongTitle">Заявка {{$offerCollect->first()->offer_id}}</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <table class="table table-bordered p-1 ml-1" style="border-radius: 10px; width: 90%">
                                                                                            @foreach($offerCollect as $offer)
                                                                                                @if($offer->offer_collect == $offerCollect->first()->offer_id)
                                                                                                    <thead>
                                                                                                    <tr>
                                                                                                        <th scope="col">Заявка</th>
                                                                                                        <th scope="col">Препорат</th>
                                                                                                        <th scope="col">Требуемое количество</th>
                                                                                                        <th scope="col">Предлагает</th>
                                                                                                        <th scope="col">Предлагаемая сумма с НДС </th>
                                                                                                        <th scope="col"> Сумма с НДС </th>
                                                                                                    </tr>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                    <tr>
                                                                                                        <th scope="row">{{$offerCollect->first()->offer_collect}}</th>
                                                                                                        <td>{{$offer->aidName}}</td>
                                                                                                        <td>{{$offer->requiredQuantity}}</td>
                                                                                                        <td>{{$offer->offerQuantity}}</td>
                                                                                                        <td>
                                                                                                            {{$offer->sumNDS}}
                                                                                                            <br>
                                                                                                            @if($offer->minOfferPrice == 1)
                                                                                                                <small class="bg-success text-white rounded">Лучшая цена</small>
                                                                                                            @endif
                                                                                                        </td>
                                                                                                        <th scope="row">
                                                                                                            {{$offer->offerSumNDS}}

                                                                                                        </th>
                                                                                                    </tr>
                                                                                                    </tbody>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </table>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                            @endif
                                                        @endforeach
                                                        <!-- Modal -->

                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Предложений--}}


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
                                                                    Норма рассхода {{$el->unitOfMeasureName}}
                                                                    <small class="text-muted">Рекомендованное:
                                                                        <br>
                                                                        Мин.{{$el->minUtilizationRate}} -
                                                                        Макс.{{$el->maxUtilizationRate}}
                                                                    </small>
                                                                    <input disabled class="form-control mt-2" value="{{$el->user_culture_util_norm}}" name="user_culture_util_norm">
                                                                </div>

                                                                <div class="col-md-3">
                                                                    Площадь, га
                                                                    <br>
                                                                    <small class="text-muted">Культура:
                                                                        <br>
                                                                        "{{$el->cultureNameOffer}}"
                                                                    </small>
                                                                    <input disabled class="form-control mt-2" value="{{$el->user_culture_square}}" name="user_culture_square">

                                                                </div>

                                                                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                                                    <div class="d-flex flex-column mt-4">
                                                                        <a style="background-color: #00C759" class="text-black btn btn-sm" href="{{ route('show_aids', $el->aids_id) }}">
                                                                            Перейти
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endforeach
                                                <div class="d-flex justify-content-center">

                                                    <form class="w-100" method="POST" action="{{route('publishToNew', $collect->first()->application_id)}}">                                                            @csrf
                                                        <button class="btn btn-danger btn-sm mt-2 w-100 ml-1" type="submit">
                                                            Отозвать
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
                    {{--For draft--}}

                </div>
            </div>
        </div>
    </div>
@endif
{{--       for farmer--}}
