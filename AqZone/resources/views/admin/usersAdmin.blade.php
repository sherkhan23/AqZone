
<div class="container-fluid">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Пользователи </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Пользователи</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="row">



        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
            <tr>
                <th>User ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Тип аккаунта</th>
                <th>Пароль</th>
                <th>Изменить</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">

                            <div class="ms-3">
                                <p class="fw-bold mb-1">{{$user->user_id}}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="fw-normal mb-1">{{$user->name}}</p>
                    </td>
                    <td>
                        <span class="badge badge-success rounded-pill d-inline">
                            {{$user->email}}
                        </span>
                    </td>
                    <td>
                        @if($user->farmer == 1)
                            Фермер
                        @else
                            Поставщик
                        @endif
                    </td>
                    <td>
                        {{$user->password}}
                    </td>
                    <td>
                        <button type="button" class="btn btn-link btn-sm btn-rounded">
                            Edit
                        </button>
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center align-content-center mt-3">
        <a href="{{ $users->previousPageUrl() }}"><button style="background-color: #00C759" class="btn btn-md" type="button">Назад</button></a>
        <span class="ml-3">
                       {{ $users->withQueryString()->links() }}
                   </span>
        <a href={{ $users->nextPageUrl()  }}>   <button style="background-color: #00C759" class="btn btn-md ml-3" type="button">Следущий</button></a>
    </div>
</div>
