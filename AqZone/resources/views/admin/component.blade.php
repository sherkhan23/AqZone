@include('admin.adminSideBar')


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5 card p-5" style="background-color: rgba(214,214,214,0.39)">
            <div class="row m-3">
                <div class="col-md-6">
                    <h3>Компоненты</h3>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createComponents">
                        Создать компонентов
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="createComponents" tabindex="-1" role="dialog" aria-labelledby="createComponents" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Создать категорию</h5>
                                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{route('createComponent')}}">
                                        @csrf
                                        Называние компонента
                                        <input name="componentName" class="form-control mb-3">

                                        <span class="text-muted mt-2" style="display: block"> Утил нормы</span>
                                        <select name="aids_utilization_norm_id" class="form-select" aria-label="Default select example">
                                            @foreach($utilNorms as $utilNorm)
                                                <option value="{{$utilNorm->util_norm_id}}">{{$utilNorm->utilizationRate}}</option>
                                            @endforeach
                                        </select>

                                        <span class="text-muted mt-2" style="display: block"> Препаративаня форма </span>
                                        <select name="preparative_forms_id" class="form-select" aria-label="Default select example">
                                            @foreach($preparativeForms as $prepForms)
                                                <option value="{{$prepForms->id}}">{{$prepForms->prepFormName}}</option>
                                            @endforeach
                                        </select>

                                        <button class="form-control btn btn-outline-success mt-3">Создать</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            @if(session('updateMess'))
                <p class="p-2 bg-success text-white rounded mt-3">{{session('updateMess')}}</p>
            @endif

            <div class="table-responsive">
                <div class="tab-content">
                    <table class="table align-middle mb-0 bg-white" style="border-radius: 20px">
                        <thead class="bg-light">
                        <tr>
                            <th>Категории ID</th>
                            <th>Называние</th>
                            <th>Утил нормы</th>
                            <th>Препаративная форма</th>
                            <th>Изменить</th>
                            <th>Удалить</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($components as $component)
                            <tr>
                                <td>
                                    <p class="fw-normal mb-1">{{$component->aid_component_id}}</p>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1">{{$component->componentName}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{$component->unitOfMeasureName}}</p>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{$component->prepFormName}}</p>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#cat-{{$component->aid_component_id}}">
                                        Изменить
                                    </button>
                                    {{--  modal to edi aids--}}
                                    <div class="modal fade" id="cat-{{$component->aid_component_id}}" tabindex="-1" role="dialog" aria-labelledby="cat-{{$component->aid_component_id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Пестициды</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{route('editComponent', $component->aid_component_id)}}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input class="form-control" value="{{$component->componentName}}" name="componentName" placeholder="Называние">

                                                        <span class="text-muted mt-2" style="display: block"> Утил нормы</span>
                                                        <select name="unit_of_measure_id" class="form-select" aria-label="Default select example">
                                                            @foreach($unitOfMeasures as $unitOfMeasure)
                                                                <option value="{{$unitOfMeasure->unit_of_measure_id}}">{{$unitOfMeasure->unitOfMeasureName}}</option>
                                                            @endforeach
                                                        </select>

                                                        <span class="text-muted mt-2" style="display: block"> Препаративаня форма </span>
                                                        <select name="preparative_forms_id" class="form-select" aria-label="Default select example">
                                                            @foreach($preparativeForms as $prepForms)
                                                                <option value="{{$prepForms->id}}">{{$prepForms->prepFormName}}</option>
                                                            @endforeach
                                                        </select>

                                                        <button class="btn btn-success mt-3" type="submit">Сохронить </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <form method="POST" action="{{route('delComponent', $component->aid_component_id)}}">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            Удалить
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

