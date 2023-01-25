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
