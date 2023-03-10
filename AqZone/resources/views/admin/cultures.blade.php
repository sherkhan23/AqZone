@include('admin.adminSideBar')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5 card p-5" style="background-color: rgba(214,214,214,0.39)">
    <div class="row m-1">
        <div class="col-md-6">
            <h3>Культуры</h3>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <button type="button" class="btn btn-success m-3" data-toggle="modal" data-target="#createCategory">
                Создать культуру
            </button>

            <!-- Modal -->
            <div class="modal fade" id="createCategory" tabindex="-1" role="dialog" aria-labelledby="createCategory" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Создать категорию</h5>
                            <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('createCulture')}}">
                                @csrf
                                Называние культуры
                                <input name="cultureName" class="form-control mb-3">

                                <button type="submit" class="form-control btn btn-outline-success mt-3">Создать</button>
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
                    <th>Culture ID</th>
                    <th>Называние</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    <th>Изменить</th>
                    <th>Удалить</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cultures as $culture)
                    <tr>
                        <td>
                            <p class="fw-normal mb-1">{{$culture->culture_id}}</p>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="ms-3">
                                    <p class="fw-bold mb-1">{{$culture->cultureName}}</p>
                                </div>
                            </div>
                        </td>

                        <td>
                            <p class="fw-normal mb-1">{{$culture->created_at}}</p>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{$culture->updated_at}}</p>
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#cat-{{$culture->culture_id}}">
                                Изменить
                            </button>
                            {{--  modal to edi aids--}}
                            <div class="modal fade" id="cat-{{$culture->culture_id}}" tabindex="-1" role="dialog" aria-labelledby="cat-{{$culture->culture_id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Пестициды</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{route('editCultureAdmin', $culture->culture_id)}}">
                                            @csrf
                                            <div class="modal-body">
                                                <input class="form-control" value="{{$culture->cultureName}}" name="cultureName" placeholder="Называние">
                                                <button class="btn btn-success mt-3" type="submit">Сохронить </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <form method="POST" action="{{route('delCulture', $culture->culture_id)}}">
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
        <a href="{{ $cultures->previousPageUrl() }}"><button class="btn btn-outline-primary btn-md" type="button">Назад</button></a>
        <span class="mx-3">
                                            {{ $cultures->withQueryString()->links() }}
                                        </span>
        <a href={{ $cultures->nextPageUrl()  }}>   <button class="btn btn-outline-primary btn-md ml-3" type="button">Следущий</button></a>
    </div>
</main>
</div>
</div>



{{--<script>--}}
{{--document.cookie="pageurl=" + encodeURIComponent(window.location['search']);--}}
{{--</script>--}}


<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>


</body>

</html>
