@include('admin.adminSideBar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5 card p-5" style="background-color: rgba(214,214,214,0.39)">
            <div class="row m-3">
                <div class="col-md-6">
                    <h3>Утил нормы</h3>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createUtils">
                        Создать утил нормы
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="createUtils" tabindex="-1" role="dialog" aria-labelledby="createUtils" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Создать категорию</h5>
                                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{route('createUtils')}}">
                                        @csrf

                                        <span class="text-muted mt-2" style="display: block"> Культуры </span>
                                        <select name="culture_id" class="form-select" aria-label="Default select example">
                                            @foreach($cultures as $culture)
                                                <option value="{{$culture->id}}">{{$culture->cultureName}}</option>
                                            @endforeach
                                        </select>

                                        <span class="text-muted mt-2" style="display: block"> Вредители </span>
                                        <select name="hazard_id" class="form-select" aria-label="Default select example">
                                            @foreach($hazards as $hazard)
                                                <option value="{{$hazard->id}}">{{$hazard->hazardName}}</option>
                                            @endforeach
                                        </select>

                                        <span class="text-muted mt-2" style="display: block"> Утил норма (utilizationRate) </span>
                                        <input class="form-control" name="utilizationRate">

                                        <span class="text-muted mt-2" style="display: block"> Max Утил норма </span>
                                        <input class="form-control" name="maxUtilizationRate" placeholder="">

                                        <span class="text-muted mt-2" style="display: block"> Min Утил норма </span>
                                        <input class="form-control" name="minUtilizationRate">

                                        <span class="text-muted mt-2" style="display: block"> Коммент для утил нормы </span>
                                        <input class="form-control" name="utilizationRateComment">

                                        <span class="text-muted mt-2" style="display: block"> Max предлоджение норм (maxApplicationNorm) </span>
                                        <input class="form-control" name="maxApplicationNorm">

                                        <span class="text-muted mt-2" style="display: block"> Правила применения </span>
                                        <textarea class="form-control" name="applicationRules"></textarea>

                                        <span class="text-muted mt-2" style="display: block"> Окончательные условия подачи заявки </span>
                                        <textarea class="form-control" name="finalApplicationTerms"></textarea>

                                        <span class="text-muted mt-2" style="display: block"> Перенос механических работ</span>
                                        <input class="form-control" name="mechanicalWorksPostponing">

                                        <span class="text-muted mt-2" style="display: block"> Перенос ручных работ</span>
                                        <input class="form-control" name="manualWorksPostponing">

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
                            <th>Утил ID</th>
                            <th>Компонент называние</th>
                            <th>Культура</th>
                            <th>Вредные обьекты</th>
                            <th>Утил оценка</th>
                            <th>Мин утил оценка</th>
                            <th>Мах утил оценка</th>
                            <th>Коменты</th>
                            <th>Мах предложение норм</th>
                            <th>Предложение правил</th>
                            <th>Финал предложение терм</th>
                            <th>mechanicalWorksPostponing</th>
                            <th>manualWorksPostponing</th>
                            <th>Удалить</th>
                            <th>Удалить</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($utils as $util)
                            <tr>
                                <td>
                                    <p class="fw-normal mb-1">{{$util->util_norm_id}}</p>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1">{{$util->componentName}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{$util->cultureName}}</p>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{$util->hazardName}}</p>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{$util->utilizationRate}}</p>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{$util->unitOfMeasureName}}</p>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{$util->maxUtilizationRate}}</p>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{$util->minUtilizationRate}}</p>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{$util->utilizationRateComment}}</p>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{$util->maxApplicationNorm}}</p>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{$util->applicationRules}}</p>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{$util->finalApplicationTerms}}</p>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{$util->mechanicalWorksPostponing}}</p>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{$util->manualWorksPostponing}}</p>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#cat">
                                        Изменить
                                    </button>
                                </td>

                                <td>
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            Удалить
                                        </button>
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



{{--<script>--}}
{{--document.cookie="pageurl=" + encodeURIComponent(window.location['search']);--}}
{{--</script>--}}


<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>


</body>

</html>
