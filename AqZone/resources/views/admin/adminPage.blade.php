@include('admin.adminSideBar')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
            <div class="table-responsive">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="users">
                        {{-- admin users --}}

                        <div class="container-fluid">

                            @if(session('updateMess'))
                                <p class="p-2 bg-success text-white rounded mt-3">{{session('updateMess')}}</p>
                            @endif
                            <div class="content-header">
                                <div class="container-fluid">
                                    <div class="row mb-2">
                                        <div class="col-sm-6">
                                            <h1 class="m-0">Пользователи </h1>
                                        </div><!-- /.col -->
                                        <div class="col-sm-6 mt-2">
                                            <ol class="breadcrumb float-sm-right">
                                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                                <li class="breadcrumb-item active">Пользователи</li>
                                                <li class="breadcrumb-item">
                                                    <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#createUser">
                                                        Создать пользователья
                                                    </button>
                                                </li>
                                                <!-- Modal create user -->
                                                <div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="createUser" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Пользователь</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="POST" action="{{route('createUser')}}">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <input name="name" class="form-control" type="text" placeholder="Имя">
                                                                    <input name="phoneNumber" id="phoneNumber" class="form-control mt-2" type="text" placeholder="Номер телефона">

                                                                    <select name="role" class="form-select form-control dropdown mt-2">
                                                                        <option value="farmer">Фермер</option>
                                                                        <option value="seller">Поставщик</option>
                                                                    </select>

                                                                    <input name="password" type="text" class="form-control mt-2" placeholder="Пароль" />

                                                                    @error('password')
                                                                    <p class="text-red-500">{{ $message }}</p>
                                                                    @enderror

                                                                    <input name="password_confirmation" type="text" class="form-control mt-2" placeholder="Подтверждение пароля" />

                                                                    @error('password_confirmation')
                                                                    <p class="text-red-500">{{ $message }}</p>
                                                                    @enderror

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                                                    <button type="submit" class="btn btn-success">Сохранить</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </ol>
                                        </div><!-- /.col -->
                                    </div><!-- /.row -->
                                </div><!-- /.container-fluid -->
                            </div>
                            <div class="row mt-3">

                                <table class="table align-middle mb-0 bg-white">
                                    <thead class="bg-light">
                                    <tr>
                                        <th>User ID</th>
                                        <th>Имя</th>
                                        <th>Номер телефона</th>
                                        <th>Email</th>
                                        <th>Тип аккаунта</th>
                                        <th>Админ</th>
                                        <th>Изменить</th>
                                        <th>Удалить</th>
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
                        <span class="text-success">
                            {{$user->phoneNumber}}
                        </span>
                                            </td>
                                            <td>
                        <span class="text-success">
                            {{$user->email}}
                        </span>
                                            </td>
                                            <td>
                                                @if($user->role == 'farmer')
                                                    Фермер
                                                @else
                                                    Поставщик
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->isAdmin == 1) Админ @else Пользователь @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#users-{{$user->user_id}}">
                                                    Изменить
                                                </button>
                                            </td>

                                            <td>
                                                <form method="POST" action="{{route('delUser', $user->user_id)}}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        Удалить
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>


                                        <!-- Modal -->
                                        <div class="modal fade" id="users-{{$user->user_id}}" tabindex="-1" role="dialog" aria-labelledby="users-{{$user->user_id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Пользователь</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{route('editUser', $user->user_id)}}">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input name="name" class="form-control" type="text" value="{{$user->name}}">
                                                            <input name="phoneNumber" id="phoneNumber" class="form-control mt-2" type="text" value="{{$user->phoneNumber}}">
                                                            <input name="email" class="form-control mt-2" type="text" value="{{$user->email}}">

                                                            <select name="role" class="form-select form-control dropdown mt-2">
                                                                @if($user->role == 'farmer')
                                                                    <option selected value="farmer">Фермер</option>
                                                                    <option value="seller">Поставщик</option>
                                                                @else
                                                                    <option value="farmer">Фермер</option>
                                                                    <option selected value="seller">Поставщик</option>
                                                                @endif
                                                            </select>

                                                            <select name="isAdmin" class="form-select form-control dropdown mt-2">
                                                                @if($user->isAdmin == 1)
                                                                    <option selected value="1">Админ</option>
                                                                    <option value="0">Пользователь</option>
                                                                @else
                                                                    <option value="1">Админ</option>
                                                                    <option selected value="0">Пользователь</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                                            <button type="submit" class="btn btn-success">Сохранить</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach

                                    </tbody>
                                </table>

                            </div>
                            <div class="d-flex justify-content-center align-content-center mt-3">
                                <a href="{{ $users->previousPageUrl() }}"><button class="btn btn-outline-primary btn-md" type="button">Назад</button></a>
                                <span class="px-3">
                                    {{ $users->withQueryString()->links() }}
                                </span>
                                <a href={{ $users->nextPageUrl()  }}>   <button class="btn btn-outline-primary btn-md" type="button">Следущий</button></a>
                            </div>
                        </div>


                        {{-- admin users --}}
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>




