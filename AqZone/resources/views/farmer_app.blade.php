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
                <button class="nav-link" id="consideration-tab btn-warning" data-bs-toggle="tab" data-bs-target="#consideration" type="button" role="tab" aria-controls="consideration" aria-selected="false">
                    На расмотрении
                    ({{$offerCountSeller}})
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="draft-tab btn-warning" data-bs-toggle="tab" data-bs-target="#draft" type="button" role="tab" aria-controls="draft" aria-selected="false">
                    Предложение
                    (+{{$draftCountSeller}})
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
                                                                                    <input class="form-control" min="1" type="number" name="offerQuantity[{{$el->app_id}}]" id="offerQuantity-{{$el->application_id}}-{{$el->app_id}}-{{$el->aids_id}}" required>
                                                                                </td>
                                                                                <td>
                                                                                    <input class="form-control" min="1" type="number" name="offerSumNDS[{{$el->app_id}}]" id="offerPriceNDS-{{$el->application_id}}-{{$el->app_id}}-{{$el->aids_id}}" required>
                                                                                </td>
                                                                                <td class="d-flex" style="justify-content: center" >
                                                                                    <span><input style="width: 150%" readonly name="sumNDS[{{$el->app_id}}]" id='summands-{{$el->application_id}}-{{$el->app_id}}-{{$el->aids_id}}' type="text" class="form-control formBlock"/></span>

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

                 {{--For consideration--}}
                        @include('farmerApplicationStatus.considerationOffer')
                 {{--For consideration--}}

                {{--draft -  предложении--}}
                @include('farmerApplicationStatus.draftOffer')
                {{--draft end - предложении --}}
                </div>
            </div>
        </div>
    </div>
@endif
{{--       for farmer--}}
