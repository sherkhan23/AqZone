@extends('layouts.app')

@include("inc.navbar")
@section('title') AgroShop @endsection
<main>
    <div class="mt-4">
        <div class="container">
            <!-- row -->
            <div class="row ">
                <!-- col -->
                <div class="col-12">
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item" aria-current="page">
                                <button>
                                    <a href="{{ route("catalog")}}">
                                        <i class="bi bi-arrow-90deg-left"></i>
                                        Назад
                                    </a>
                                </button>
                            </li>

                            <li class="breadcrumb-item"><a href="{{ route("home") }}">Главная</a></li>
                            <li class="breadcrumb-item" aria-current="page">Каталог</li>
                            <li class="breadcrumb-item" aria-current="page"> {{$aidItem->categoryName}}</li>
                            <li class="breadcrumb-item" aria-current="page"> {{$aidItem->aidName}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="mt-8">
        <div class="container">
            <div class="row">
                <div class="col-md-6" style=" display: flex; align-items: center;">
                    <!-- img slide -->
                     <img style="border-radius: 20px; width: 500px; display: flex; align-items: center"
                             src="media/aidsPicture.png">

                </div>
                <div class="col-md-6">
                    <div class="ps-lg-10 mt-6 mt-md-0">
                        <!-- content -->
                        <a href="#!" class="mb-4 d-block"></a>
                        <!-- heading -->
                        <h1 class="mb-1">{{ $aidItem->aidName}} </h1>
                    {{--                        <div class="mb-4">--}}
                    {{--                            <!-- rating -->--}}
                    {{--                            <!-- rating --> <small class="text-warning"> <i class="bi bi-star-fill"></i>--}}
                    {{--                                <i class="bi bi-star-fill"></i>--}}
                    {{--                                <i class="bi bi-star-fill"></i>--}}
                    {{--                                <i class="bi bi-star-fill"></i>--}}
                    {{--                                <i class="bi bi-star-half"></i></small><a href="#" class="ms-2">(30 reviews)</a></div>--}}
                    {{--                        <div class="fs-4">--}}

                    </div>
                    <!-- hr -->
                    <div class="mt-3 row justify-content-start g-2 align-items-center">

                        <div class="col-xxl-4 col-lg-4 col-md-5 col-5 d-grid">
                            <button style="background-color: #00C759" class="btn btn-outline mt-2" type="button">
                                Добавить в корзину
                            </button>
                        </div>

                    </div>


                    <!-- hr -->
                    <hr class="my-6">

                    <div class="col-lg-12">

                        <div class="dec-review-topbar nav mb-45"  style="background-color: #FFC528; border-radius: 10px">
                            <a class="active" data-toggle="tab" href="#des-details1">Свойства</a>
                            <a data-toggle="tab" href="#des-details2">Применение</a>
                            <a data-toggle="tab" href="#des-details3">Аналоги</a>
                            <a data-toggle="tab" href="#des-details4">Описание</a>
                        </div>
                        <div class="tab-content dec-review-bottom">
                            <div id="des-details1" class="tab-pane active mt-3">
                                <div>
                                    <!-- table -->
                                    <table class="table table-borderless">

                                        <tbody>
                                        <tr>
                                            <th>Производитель <small>(бренд)</small></th>
                                            <td>{{($aidItem->BrandName)}}</td>

                                        </tr>
                                        <tr>
                                            <th>Страна производства</th>
                                            <td>{{$aidItem->ProducerName}}</td>

                                        </tr>
                                        <tr>
                                            <th>Регистрант</th>
                                            <td></td>

                                        </tr>
                                        <tr>
                                            <th>Препаративная форма</th>
                                            <td>{{$aidItem->prepFormName}}</td>
                                        </tr>
                                        <tr>
                                            <th>Класс опасности для вчел</th>
                                            <td>П-2</td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <table class="table table-borderless">
                                        <tbody>
                                        @foreach($dosages as $dosage)
                                            @if($dosage->aids_id == $aidItem->aids_id)
                                                <tr>
                                                    <th>Компонент</th>
                                                    <td>{{($dosage->componentName)}}</td>

                                                </tr>
                                                <tr>
                                                    <th>Единица измерения</th>
                                                    <td>{{$dosage->unitOfMeasureName}}</td>

                                                </tr>
                                                <tr>
                                                    <th>Дозировка</th>
                                                    <td>{{$dosage->dosage}}</td>

                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div id="des-details2" class="tab-pane mt-3">
                                <table class="table table-borderless">

                                    <tbody>
                                    @foreach($aids_util_norms as $aids_util_norm)
                                        @if($aids_util_norm->aids_id == $aidItem->aids_id)
                                            <tr>
                                                <th>
                                                    Культуры
                                                    {{$cultureCount+=1}}:
                                                </th>
                                                <td>
                                                    {{$aids_util_norm->cultureName}}
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Вредные обьекты {{$cultureHazardCount+=1}}:</th>
                                                <td>
                                                    {{$aids_util_norm->hazardName}}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

    </section>


</main>
