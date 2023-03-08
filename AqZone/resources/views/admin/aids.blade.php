@extends('layouts.app')
<style>


</style>
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

                            <li class="breadcrumb-item"><a href="{{ route("admin") }}">Главная</a></li>
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
                <div class="col-md-6">
                    <div class="ps-lg-10 mt-6 mt-md-0">
                        <!-- content -->
                        <a href="#!" class="mb-4 d-block"></a>
                        <!-- heading -->
                        <h1 class="mb-1">{{ $aidItem->aidName}} </h1>

                    </div>


                    </div>

                    <!-- hr -->
                    <hr class="my-6">

                    <div class="col-lg-12">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-property-tab" data-bs-toggle="pill" data-bs-target="#pills-property" type="button" role="tab" aria-controls="pills-property" aria-selected="true">
                                    Своиства
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-use-tab" data-bs-toggle="pill" data-bs-target="#pills-use" type="button" role="tab" aria-controls="pills-use" aria-selected="false">
                                    Применение
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                                    Аналоги
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                                    Описание
                                </button>
                            </li>
                        </ul>
                        @if(session('updateMess'))
                            <p class="p-2 bg-success text-white rounded mt-3">{{session('updateMess')}}</p>
                        @endif
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-property" role="tabpanel" aria-labelledby="pills-property-tab">
{{--                                Свойства --}}
                                    <div class="card" id="properties">
                                        <div class="card-body bg-light">
                                            <form method="POST" action="{{route('editAids', $aidItem->aids_id)}}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <span class="text-muted"> Называние </span>
                                                        <input class="form-control" name="aidName" value="{{$aidItem->aidName}}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <span class="text-muted"> Категория </span>
                                                        <select name="category_id" class="form-select" aria-label="Default select example">
                                                            <option selected value="{{$aidItem->category_id}}">{{$aidItem->categoryName}}</option>
                                                            @foreach($categories as $cat)
                                                                <option value="{{$cat->id}}">{{$cat->categoryName}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <span class="text-muted" style="display: block"> Препаративаня форма </span>
                                                        <select name="preparative_forms_id" class="form-select" aria-label="Default select example">
                                                            <option selected value="{{$aidItem->preparative_forms_id}}">{{$aidItem->prepFormName}}</option>

                                                            @foreach($preparativeForms as $prepForms)
                                                                <option value="{{$prepForms->id}}">{{$prepForms->prepFormName}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <span class="text-muted" style="display: block"> Компоненты</span>
                                                        <select name="aid_components_id" class="form-select" aria-label="Default select example">
                                                            <option selected value="{{$aidItem->aid_components_id}}">{{$aidItem->componentName}}</option>

                                                            @foreach($components as $component)
                                                                <option value="{{$component->id}}">{{$component->componentName}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-md-3">
                                                        <span class="text-muted" style="display: block"> Утил нормы</span>
                                                        <select name="aids_utilization_norm_id" class="form-select" aria-label="Default select example">
                                                            <option selected value="{{$aidItem->aids_utilization_norm_id}}">{{$aidItem->utilizationRate}}</option>
                                                            @foreach($utilNorms as $utilNorm)
                                                                <option value="{{$utilNorm->util_norm_id}}">{{$utilNorm->utilizationRate}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <span class="text-muted" style="display: block"> Пакс </span>
                                                        <input class="form-control" name="packs" value="{{$aidItem->packs}}">
                                                    </div>

                                                    <div class="col-md-3">
                                                        <span class="text-muted" style="display: block"> Изготовитель </span>
                                                        <select name="producer_id" class="form-select" aria-label="Default select example">
                                                            <option selected value="{{$aidItem->producer_id}}">{{$aidItem->ProducerName}}</option>
                                                            @foreach($producers as $producer)
                                                                <option value="{{$producer->id}}">{{$producer->ProducerName}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <span class="text-muted" style="display: block"> Бренд </span>
                                                        <select name="brand_id" class="form-select" aria-label="Default select example">
                                                            <option selected value="{{$aidItem->brand_id}}">{{$aidItem->BrandName}}</option>
                                                            @foreach($brands as $brand)
                                                                <option value="{{$brand->id}}">{{$brand->BrandName}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <span class="text-muted mt-2" style="display: block"> Дата просрочки </span>
                                                        <input type="date" class="form-control" name="registrationEndDate" value="{{$aidItem->registrationEndDate}}">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-outline-success mt-3">Сохранить</button>
                                            </form>
                                        </div>
                                </div>
                                {{-- Свойства--}}

                                <div class="card bg-light mt-3">
                                    <div>
                                        <button class="btn btn-outline-primary m-3" type="button" data-toggle="collapse" data-target="#createActiveSubstance" aria-expanded="false" aria-controls="createActiveSubstance">
                                            + Действующее вещество
                                        </button>
                                        <div class="collapse m-3" id="createActiveSubstance">
                                            <div class="card card-body">
                                                <form method="POST" action="{{route('createDosage', $aidItem->aids_id)}}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <span class="text-muted" style="display: block">Действующее вещество</span>
                                                            <select name="aid_components_id" class="form-select" aria-label="Default select example">
                                                                <option selected value="{{$aidItem->aid_components_id}}">{{$aidItem->componentName}}</option>
                                                                @foreach($components as $component)
                                                                    <option value="{{$component->aid_component_id}}">{{$component->componentName}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <span class="text-muted" style="display: block"> Дозировка </span>
                                                            <input name="dosage" class="form-control" required type="number">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <span class="text-muted" style="display: block">Единица измерения* </span>
                                                            <select name="unit_of_measure_id" class="form-select" aria-label="Default select example">
                                                                @foreach($unitOfMeasures as $unitOfMeasure)
                                                                    <option value="{{$unitOfMeasure->unit_of_measure_id}}">{{$unitOfMeasure->unitOfMeasureName}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <button type="submit" class="btn btn-success mt-4">Сохранить</button>
                                                        </div>

                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card m-3">
                                        <span class="p-3">

                                            @foreach($dosages as $dosage)
                                                @if($dosage->aids_id == $aidItem->aids_id)
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <span class="text-muted" style="display: block">Действующее вещество</span>
                                                            <input class="form-control" readonly value="{{$dosage->componentName}}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <span class="text-muted" style="display: block"> Дозировка </span>
                                                            <input class="form-control" readonly value="{{$dosage->dosage}}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <span class="text-muted" style="display: block">Единица измерения* </span>
                                                            <input class="form-control" readonly value="{{$dosage->unitOfMeasureName}}">
                                                        </div>
                                                       <div class="col-md-3">
                                                           <span class="text-white" style="display: block">-</span>
                                                           <form action="{{route('delDosage', $dosage->dosage_id)}}" method="POST">
                                                               @csrf
                                                               <button class="btn btn-danger" type="submit">Удалить</button>
                                                           </form>
                                                       </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-use" role="tabpanel" aria-labelledby="pills-use-tab">
                                {{-- Применение --}}
                                    <div class="card bg-light">
                                        <form action="{{route('createUtilNorm', $aidItem->aids_id)}}" method="POST">
                                            @csrf
                                            <div class="row m-3">
                                                <button class="btn btn-outline-secondary m-3 w-25" type="button" data-toggle="collapse" data-target="#createCulture" aria-expanded="false" aria-controls="createCulture">
                                                    + Добавить культуру
                                                </button>
                                                <div class="collapse" id="createCulture">
                                                        <div class="card card-body">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <span class="text-muted" style="display: block"> Культура </span>
                                                                    <select name="culture_id" class="form-select" aria-label="Default select example">
                                                                        @foreach($cultures as $culture)
                                                                            <option value="{{$culture->culture_id}}">{{$culture->cultureName}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <span class="text-muted" style="display: block"> Срок регистрации*   </span>
                                                                    <input name="register_date" type="date" class="form-control">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <span class="text-muted" style="display: block">Норма расхода* </span>
                                                                    <div class="d-flex d-inline-block">
                                                                        <span>От </span><input name="util_norm_min" type="number" class="form-control w-75 ml-1">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <span class="text-muted" style="display: block">*</span>
                                                                    <div class="d-flex d-inline-block">
                                                                        <span>До</span><input name="util_norm_max" type="number" class="form-control w-75 ml-1">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-md-3">
                                                                    <span class="text-muted" style="display: block">Срок последней обработки*</span>
                                                                    <input name="last_term" type="text" class="form-control">
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <span class="text-muted" style="display: block">Максимальная кратность обработок</span>
                                                                    <div class="d-flex d-inline-block">
                                                                        <span>От </span><input name="min_multiplicity" type="number" class="form-control w-50 mx-2">
                                                                        <span>До</span><input name="max_multiplicity" type="number" class="form-control w-50 mx-2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-md-3">
                                                                    <span class="text-muted" style="display: block"> Вредители, болезни, обьект*  </span>
                                                                    <select name="hazard_id" class="form-select" aria-label="Default select example">
                                                                        @foreach($hazards as $hazard)
                                                                            <option value="{{$hazard->hazard_id}}">{{$hazard->hazardName}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <button class="btn btn-success mt-4" type="submit">Сохранить</button>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                </div>
                                {{-- Применение --}}
                                {{-- Культуры --}}
                                        @foreach($unitOfMeasuresAids as $aidsUnitOfMeasures)
                                            @if($aidsUnitOfMeasures->aids_id == $aidItem->aids_id)
                                        <div class="card bg-light mt-3">
                                            <div class="card card-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <span class="text-muted" style="display: block"> Культура </span>
                                                        <input class="form-control" value="{{$aidsUnitOfMeasures->cultureName}}" readonly>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <span class="text-muted" style="display: block"> Срок регистрации*   </span>
                                                        <input value="{{$aidsUnitOfMeasures->register_date}}" type="date" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <span class="text-muted" style="display: block">Норма расхода* </span>
                                                        <div class="d-flex d-inline-block">
                                                            <span>От </span><input value="{{$aidsUnitOfMeasures->minUtilizationRate}}" readonly type="number" class="form-control w-75 ml-1">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <span class="text-muted" style="display: block">*</span>
                                                        <div class="d-flex d-inline-block">
                                                            <span>До</span><input value="{{$aidsUnitOfMeasures->maxUtilizationRate}}" readonly type="number" class="form-control w-75 ml-1">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-3">
                                                        <span class="text-muted" style="display: block">Срок последней обработки*</span>
                                                        <input value="{{$aidsUnitOfMeasures->finalApplicationTerms}}" type="text" class="form-control" readonly>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <span class="text-muted" style="display: block">Максимальная кратность обработок</span>
                                                        <div class="d-flex d-inline-block">
                                                            <span>От </span><input value="{{$aidsUnitOfMeasures->min_multiplicity}}" readonly type="number" class="form-control w-50 mx-2">
                                                            <span>До</span><input value="{{$aidsUnitOfMeasures->max_multiplicity}}" readonly type="number" class="form-control w-50 mx-2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-3">
                                                        <span class="text-muted" style="display: block"> Вредители, болезни, обьект*  </span>
                                                        <input readonly class="form-control" value="{{$aidsUnitOfMeasures->hazardName}}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button class="btn btn-danger mt-4" type="submit">Удалить</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            @endif
                                        @endforeach
                                {{-- Культуры --}}
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </section>


</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
