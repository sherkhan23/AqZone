@include('admin.adminSideBar')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5 card p-5" style="background-color: rgba(214,214,214,0.39)">
            <div class="row m-3">
                <div class="col-md-6">
                    <h3>Производитель</h3>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createProducer">
                        Создать производителя
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="createProducer" tabindex="-1" role="dialog" aria-labelledby="createProducer" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Создать производителя</h5>
                                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{route('createProducer')}}">
                                        @csrf
                                        Называние изготовителя
                                        <input name="ProducerName" class="form-control mb-3">

                                        Странаизготовителя
                                        <select name="producerCountry" class="form-select" aria-label="Default select example">
                                            @foreach($countries as $country)
                                                <option value="{{$country->countryName}}">{{$country->countryName}}</option>
                                            @endforeach
                                        </select>

                                        <span class="text-muted mt-2" style="display: block"> Бренд </span>
                                        <select name="brand_id" class="form-select" aria-label="Default select example">
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->BrandName}}</option>
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
                            <th>Страна</th>
                            <th>Бренд</th>
                            <th>Изменить</th>
                            <th>Удалить</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($producers as $producer)
                            <tr>
                                <td>
                                    <p class="fw-normal mb-1">{{$producer->producer_id}}</p>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1">{{$producer->ProducerName}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{$producer->producerCountry}}</p>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{$producer->BrandName}}</p>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#cat-{{$producer->producer_id}}">
                                        Изменить
                                    </button>
                                    {{--  modal to edi aids--}}
                                    <div class="modal fade" id="cat-{{$producer->producer_id}}" tabindex="-1" role="dialog" aria-labelledby="cat-{{$producer->producer_id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Пестициды</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{route('editProducers', $producer->producer_id)}}">
                                                    @csrf
                                                    <div class="modal-body">

                                                        Называние изготовителя
                                                        <input name="ProducerName" value="{{$producer->ProducerName}}" class="form-control mb-3">

                                                        Странаизготовителя
                                                        <select name="producerCountry" class="form-select" aria-label="Default select example">
                                                            @foreach($countries as $country)
                                                                <option value="{{$country->countryName}}">{{$country->countryName}}</option>
                                                            @endforeach
                                                        </select>

                                                        <span class="text-muted mt-2" style="display: block"> Бренды </span>
                                                        <select name="brand_id" class="form-select" aria-label="Default select example">
                                                            @foreach($brands as $brand)
                                                                <option value="{{$brand->id}}">{{$brand->BrandName}}</option>
                                                            @endforeach
                                                        </select>

                                                        <button class="btn btn-success mt-3" type="submit">Сохронить </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                <td>
                                    <form method="POST" action="{{ route('delProducer', $producer->producer_id)}}">
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
                <a href="{{ $producers->previousPageUrl() }}"><button class="btn btn-outline-primary btn-md" type="button">Назад</button></a>
                <span class="mx-3">
                                            {{ $producers->withQueryString()->links() }}
                                        </span>
                <a href={{ $producers->nextPageUrl()  }}>   <button class="btn btn-outline-primary btn-md ml-3" type="button">Следущий</button></a>
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
