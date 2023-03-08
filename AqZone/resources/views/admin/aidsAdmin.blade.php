@include('admin.adminSideBar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">

            <div class="table-responsive">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="aids">
                        {{-- admin users --}}

                        <div class="container-fluid ">
                            <div class="content-header">
                                <div class="container-fluid">
                                    <div class="row mb-2">
                                        <div class="col-sm-3">
                                            <h1 class="m-0">Пестициды </h1>
                                        </div><!-- /.col -->
                                        <div class="col-sm-7 d-flex mt-4" style="justify-content: end">
                                            <ol class="breadcrumb float-sm-right">
                                                <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                                                <li class="breadcrumb-item active">Пестициды</li>
                                            </ol>
                                        </div><!-- /.col -->
                                        <div class="col-sm-2 d-flex mt-3" style="justify-content: end">
                                            <a href="{{route('exportAids')}}" class="btn btn-sm btn-outline-success m-3">
                                                <i class="bi bi-file-earmark-spreadsheet"></i> Excel экспорт
                                            </a>
                                        </div><!-- /.col -->
                                    </div><!-- /.row -->
                                </div><!-- /.container-fluid -->
                            </div>
                            <div class="row mt-5">
                                @if(session('updateMess'))
                                    <p class="p-2 bg-success text-white rounded mt-3">{{session('updateMess')}}</p>
                                @endif

                                <table class="table align-middle mb-0 bg-white">
                                    <thead class="bg-light">

                                    <tr>
                                        <th>Aids ID</th>
                                        <th>Называние</th>
                                        <th>Категория</th>
                                        <th>Препартивные формы</th>
                                        <th>Компоненты </th>
                                        <th>Утилиз нормы</th>
                                        <th>Пакс</th>
                                        <th>Изготовитель</th>
                                        <th>Бренд</th>
                                        <th>Конец срока</th>
                                        <th>Редактировать</th>
                                        <th>Удалить</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($aids as $aid)
                                            <tr>
                                                <td>
                                                    <a href="{{route('aids', $aid->aids_id)}}">
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-3">
                                                            <p class="fw-bold mb-1">{{$aid->aids_id}}</p>
                                                        </div>
                                                    </div>
                                                    </a>
                                                </td>
                                                <td>
                                                    <p class="fw-normal mb-1">{{$aid->aidName}}</p>
                                                </td>
                                                <td>
                                                    <span class="">
                                                        {{$aid->categoryName}}
                                                    </span>
                                                </td>
                                                <td>
                                                    {{$aid->prepFormName}}

                                                </td>
                                                <td>
                                                    {{$aid->componentName}}
                                                </td>
                                                <td>
                                                    {{$aid->utilizationRate}}
                                                </td>
                                                <td>
                                                    {{$aid->packs}}
                                                </td>
                                                <td>
                                                    {{$aid->ProducerName}}
                                                </td>
                                                <td>
                                                    {{$aid->BrandName}}
                                                </td>
                                                <td>
                                                    {{$aid->registrationEndDate}}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#aids-{{$aid->aids_id}}">
                                                        Изменить
                                                    </button>
                                                </td>

                                                <td>
                                                    <form method="POST" action="{{route('delAid', $aid->aids_id)}}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                                            Удалить
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                        {{--  modal to edi aids--}}
                                        <div class="modal fade" id="aids-{{$aid->aids_id}}" tabindex="-1" role="dialog" aria-labelledby="aids-{{$aid->aids_id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Пестициды</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{route('editAids', $aid->aids_id)}}">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <span class="text-muted"> Называние </span>
                                                            <input class="form-control" name="aidName" value="{{$aid->aidName}}">

                                                            <span class="text-muted mt-2" style="display: block"> Категория </span>
                                                            <select name="category_id" class="form-select" aria-label="Default select example">
                                                                <option selected value="{{$aid->category_id}}">{{$aid->categoryName}}</option>

                                                                @foreach($categories as $cat)
                                                                    <option value="{{$cat->id}}">{{$cat->categoryName}}</option>
                                                                @endforeach
                                                            </select>

                                                            <span class="text-muted mt-2" style="display: block"> Препаративаня форма </span>
                                                            <select name="preparative_forms_id" class="form-select" aria-label="Default select example">
                                                                <option selected value="{{$aid->preparative_forms_id}}">{{$aid->prepFormName}}</option>

                                                                @foreach($preparativeForms as $prepForms)
                                                                    <option value="{{$prepForms->id}}">{{$prepForms->prepFormName}}</option>
                                                                @endforeach
                                                            </select>

                                                            <span class="text-muted mt-2" style="display: block"> Компоненты</span>
                                                            <select name="aid_components_id" class="form-select" aria-label="Default select example">
                                                                <option selected value="{{$aid->aid_components_id}}">{{$aid->componentName}}</option>

                                                                @foreach($components as $component)
                                                                    <option value="{{$component->id}}">{{$component->componentName}}</option>
                                                                @endforeach
                                                            </select>


                                                            <span class="text-muted mt-2" style="display: block"> Утил нормы</span>
                                                            <select name="aids_utilization_norm_id" class="form-select" aria-label="Default select example">
                                                                <option selected value="{{$aid->aids_utilization_norm_id}}">{{$aid->utilizationRate}}</option>
                                                                @foreach($utilNorms as $utilNorm)
                                                                    <option value="{{$utilNorm->util_norm_id}}">{{$utilNorm->utilizationRate}}</option>
                                                                @endforeach
                                                            </select>

                                                            <span class="text-muted mt-2" style="display: block"> Пакс </span>
                                                            <input class="form-control" name="packs" value="{{$aid->packs}}">


                                                            <span class="text-muted mt-2" style="display: block"> Изготовитель </span>
                                                            <select name="producer_id" class="form-select" aria-label="Default select example">
                                                                <option selected value="{{$aid->producer_id}}">{{$aid->ProducerName}}</option>
                                                                @foreach($producers as $producer)
                                                                    <option value="{{$producer->id}}">{{$producer->ProducerName}}</option>
                                                                @endforeach
                                                            </select>


                                                            <span class="text-muted mt-2" style="display: block"> Бренд </span>
                                                            <select name="brand_id" class="form-select" aria-label="Default select example">
                                                                <option selected value="{{$aid->brand_id}}">{{$aid->BrandName}}</option>
                                                                @foreach($brands as $brand)
                                                                    <option value="{{$brand->id}}">{{$brand->BrandName}}</option>
                                                                @endforeach
                                                            </select>

                                                            <span class="text-muted mt-2" style="display: block"> Дата просрочки </span>
                                                            <input type="date" class="form-control" name="registrationEndDate" value="{{$aid->registrationEndDate}}">


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                                            <button type="submit" class="btn btn-success">Сохранить</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        {{--  modal to edi aids--}}
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center align-content-center mt-3">
                                <a href="{{ $aids->previousPageUrl() }}"><button class="btn btn-outline-primary btn-md" type="button">Назад</button></a>
                                <span class="mx-3">
                                    {{ $aids->withQueryString()->links() }}
                                </span>
                                <a href={{ $aids->nextPageUrl()  }}>   <button class="btn btn-outline-primary btn-md ml-3" type="button">Следущий</button></a>
                            </div>
                        </div>

                        {{-- admin users --}}
                    </div>
                    <div class="tab-pane fade" id="messages">
                        <h2>Создание пестицидов</h2>


                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

