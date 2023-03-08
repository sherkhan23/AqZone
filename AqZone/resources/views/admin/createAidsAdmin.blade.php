@include('admin.adminSideBar')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" >
            @if(session('updateMess'))
                <p class="p-2 bg-success text-white rounded mt-3">{{session('updateMess')}}</p>
            @endif
            <div class="table-responsive">
                <div class="tab-content">
{{--                    create aids tab--}}
                    <div class="tab-pane fade show active" id="createAids">
                        <div class="row mt-3" style="justify-content: center">
                            <div class="card p-5 shadow col-md-8">
                                <h2>Создание пестицидов</h2>
                                {{-- Form for creating aid--}}
                                <form method="POST" action="{{route('createAid')}}">
                                    @csrf
                                    <span class="text-muted"> Называние </span>
                                    <input class="form-control" name="aidName">
                                    @error('aidName')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                    <span class="text-muted mt-2" style="display: block"> Категория </span>
                                    <select name="category_id" class="form-select" aria-label="Default select example">
                                        @foreach($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->categoryName}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                    <span class="text-muted mt-2" style="display: block"> Препаративаня форма </span>
                                    <select name="preparative_forms_id" class="form-select" aria-label="Default select example">
                                        @foreach($preparativeForms as $prepForms)
                                            <option value="{{$prepForms->id}}">{{$prepForms->prepFormName}}</option>
                                        @endforeach
                                    </select>

                                    @error('preparative_forms_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                    <span class="text-muted mt-2" style="display: block"> Компоненты</span>
                                    <select name="aid_components_id" class="form-select" aria-label="Default select example">
                                        @foreach($components as $component)
                                            <option value="{{$component->aid_component_id}}">{{$component->componentName}}</option>
                                        @endforeach
                                    </select>
                                    @error('aid_components_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                    <span class="text-muted mt-2" style="display: block"> Утил нормы</span>
                                    <select name="aids_utilization_norm_id" class="form-select" aria-label="Default select example">
                                        @foreach($utilNorms as $utilNorm)
                                            <option value="{{$utilNorm->util_norm_id}}">{{$utilNorm->utilizationRate}}</option>
                                        @endforeach
                                    </select>
                                    @error('aids_utilization_norm_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                    <span class="text-muted mt-2" style="display: block"> Пакс </span>
                                    <input class="form-control" name="packs">
                                    @error('packs')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror


                                    <span class="text-muted mt-2" style="display: block"> Изготовитель </span>
                                    <select name="producer_id" class="form-select" aria-label="Default select example">
                                        @foreach($producers as $producer)
                                            <option value="{{$producer->producer_id}}">{{$producer->ProducerName}}</option>
                                        @endforeach
                                    </select>
                                    @error('producer_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror


                                    <span class="text-muted mt-2" style="display: block"> Бренд </span>
                                    <select name="brand_id" class="form-select" aria-label="Default select example">
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->BrandName}}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                    <span class="text-muted mt-2" style="display: block"> Дата просрочки </span>
                                    <input type="date" class="form-control" name="registrationEndDate">
                                    @error('registrationEndDate')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                    <button class="btn btn-outline-success mt-3" type="submit">Создать </button>
                                </form>
                                {{-- Form for creating aid--}}
                            </div>
                        </div>
                    </div>

{{--                    create aids param--}}

                </div>
            </div>
        </main>
    </div>
</div>

