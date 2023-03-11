@include('admin.adminSideBar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5 card p-5" style="background-color: rgba(214,214,214,0.39)">
            <div class="row m-3">
                <div class="col-md-6">
                    <h3>Бренды</h3>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createBrand">
                        Создать бренда
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="createBrand" tabindex="-1" role="dialog" aria-labelledby="createBrand" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Создать бренда</h5>
                                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{route('createBrand')}}">
                                        @csrf
                                        Называние Бренд
                                        <input name="BrandName" class="form-control mb-3">

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
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Изменить</th>
                            <th>Удалить</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($brands as $brand)
                            <tr>
                                <td>
                                    <p class="fw-normal mb-1">{{$brand->id}}</p>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1">{{$brand->BrandName}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{$brand->created_at}}</p>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{$brand->updated_at}}</p>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#cat-{{$brand->id}}">
                                        Изменить
                                    </button>
                                    {{--  modal to edi aids--}}
                                    <div class="modal fade" id="cat-{{$brand->id}}" tabindex="-1" role="dialog" aria-labelledby="cat-{{$brand->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Пестициды</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{route('editBrand', $brand->id)}}">
                                                    @csrf
                                                    <div class="modal-body">

                                                        <input class="form-control" value="{{$brand->BrandName}}" name="BrandName" placeholder="Называние">


                                                        <button class="btn btn-success mt-3" type="submit">Сохронить </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                <td>
                                    <form method="POST" action="{{ route('delBrand', $brand->id)}}">
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
            <div class="d-flex justify-content-center align-content-center mt-3">
                <a href="{{ $brands->previousPageUrl() }}"><button class="btn btn-outline-primary btn-md" type="button">Назад</button></a>
                <span class="mx-3">
                                            {{ $brands->withQueryString()->links() }}
                                        </span>
                <a href={{ $brands->nextPageUrl()  }}>   <button class="btn btn-outline-primary btn-md ml-3" type="button">Следущий</button></a>
            </div>
        </main>
    </div>
</div>


