
<div class="container-fluid">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Пестициды </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Пестициды</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="row">



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
            </tr>
            </thead>
            <tbody>
            @foreach($aids as $aid)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">

                            <div class="ms-3">
                                <p class="fw-bold mb-1">{{$aid->aids_id}}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="fw-normal mb-1">{{$aid->aidName}}</p>
                    </td>
                    <td>
                        <span class="badge badge-success rounded-pill d-inline">
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

                </tr>

            @endforeach

            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center align-content-center mt-3">
        <a href="{{ $aids->previousPageUrl() }}"><button style="background-color: #00C759" class="btn btn-md" type="button">Назад</button></a>
        <span class="ml-3">
                       {{ $aids->links() }}
                   </span>
        <a href={{ $aids->nextPageUrl()  }}>   <button style="background-color: #00C759" class="btn btn-md ml-3" type="button">Следущий</button></a>
    </div>
</div>
