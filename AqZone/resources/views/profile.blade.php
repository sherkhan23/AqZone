@extends('layouts.app')
@section('title') AgroShop @endsection
@include('inc.navbar')
<head>
    <!-- Пакет JavaScript с Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>
    <!-- Только CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<section style="background-color: #eee; border-radius: 50px">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Пользватель</a></li>
                        <li class="breadcrumb-item active text-success" aria-current="page">{{ $user->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        @if(Auth::user()->farmer == true)
                            <img src="media/farmer.webp" alt="avatar"
                                 class="rounded-circle img-fluid center py-3" style="width: 150px;">
                        @elseif(Auth::user()->farmer == false)
                            <img src="media/seller.png" alt="avatar"
                                 class="rounded-circle img-fluid center" style="width: 150px;">
                        @endif

                        <h5 class="my-3">{{ $user->name }}</h5>
                        @if(Auth::user()->farmer == true)
                            <p class="text-muted mb-1">Фермер</p>
                        @elseif(Auth::user()->farmer == false)
                            <p class="text-muted mb-1">Продавец</p>
                        @endif

                        <p class="text-muted mb-4">
                            Казахстан
                        </p>
                        <div class="d-flex justify-content-center mb-2">
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush rounded-3">
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                        <i class="fas fa-globe fa-lg text-warning">Язык </i>
                                        <select name="brandFilter" class="form-select ml-5" aria-label="Default select example">
                                            <option>Казахский</option>
                                            <option>Руский</option>
                                        </select>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fas fa-globe fa-lg text-warning">Дата регестрации: </i>
                                <p class="mb-0">{{$user->created_at}}</p>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-lg-8">
                <form action="{{route('editProfile')}}" method="POST">
                    @csrf
                    @if(session('message'))
                        <p class="p-3 bg-success text-white rounded">{{session('message')}}</p>
                    @endif
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Имя</p>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input name="name" class="form-control w-50" value="{{ $user->name }}">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <input name="email" id="email" class="form-control w-50" value="{{ $user->email }}">

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Номер телефона</p>
                                </div>
                                <div class="col-sm-9">
                                    <input name="phoneNumber" disabled id="phoneNumber" class="form-control w-50" value="{{ $user->phoneNumber }}">

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Тип аккаунта</p>
                                </div>
                                <div class="col-sm-9">
                                    @if(Auth::user()->farmer == true)
                                        <p class="text-muted mb-1">Фермер</p>
                                    @elseif(Auth::user()->farmer == false)
                                        <p class="text-muted mb-1">Продавец</p>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Адресс</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        Казахстан
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-warning">Сохранить</button>
                </form>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4 mb-md-0">
                            <div class="card-body shadow-3">
                                <h6>Адреса</h6>
                            </div>
                            <div class="card-body">
                                <script>
                                    function disp(form) {
                                        if (form.style.display == "none") {
                                            form.style.display = "block";
                                        } else {
                                            form.style.display = "none";
                                        }
                                    }
                                </script>
                                <button style="background-color: #FFC528;" class="btn btn-outline btn-sm w-100" type="button"
                                        value="Добавить адресс" onclick="disp(document.getElementById('form1'))">
                                    Добавить адрес
                                </button>
                                @if(session('successLocation'))
                                    <p class="p-2 bg-success text-white rounded mt-3">{{session('successLocation')}}</p>
                                @endif
                                <form method="POST" action="{{route('editLocation')}}" id="form1" style="display: none;">
                                    @csrf
                                    <h6 class="mb-0 mt-3">Страна</h6>
                                    <div class="btn-group mt-2">
                                        <select name="country_id" class="form-select" aria-label="Default select example">
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->countryName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('country_id')
                                    <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                    <livewire:user-location></livewire:user-location>

                                    <h6 class="mb-0 mt-3">Адрес</h6>
                                    <input name="address" class="form-control mt-2">
                                    @error('address')
                                    <p class="text-red-500">{{ $message }}</p>
                                    @enderror

                                    <h5 class="mb-0 mt-3">Коментарий</h5>
                                    <input name="comment" class="form-control mt-2">

                                    <button class="btn btn-outline-primary mt-3" type="submit">Сохранить</button>

                                </form>
                                <div class="p-1">

                                    @foreach($location as $loc)
                                        @if($loc->user_id == auth()->id() and $loc->status == 1)
                                            <div class="card mb-4 mt-2">
                                                <div class="card-body">
                                                    <div class="d-flex flex-row-reverse w-100" >
                                                        <form action="{{route('locDel', $loc->loc_id)}}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button value="status" name="status" class="btn btn-outline-primary d-flex justify-content-center" type="button"
                                                                    data-toggle="modal" data-target="#exampleModalCenter"><i class="bi bi-x-lg"></i></button>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">Вы действительно хотите удалить адрес?</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
                                                                            <button type="submit" class="btn btn-primary">Да, Удалить</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="mb-0">Область</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <p class="text-muted mb-0">
                                                                {{$loc->regionName}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="mb-0">Район</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <p class="text-muted mb-0">
                                                                {{$loc->subRegionName}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="mb-0">Населенный пункт</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <p class="text-muted mb-0">
                                                                {{$loc->localityName}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="mb-0">Адресс</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <p class="text-muted mb-0">
                                                                {{$loc->address}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-4 mb-md-0">
                            <div class="card-body shadow-3">
                                <h6>Культуры</h6>
                            </div>
                            <div class="card-body">
                                <button style="background-color: #FFC528; width: 380px" class="btn btn-outline btn-sm w-100" type="button"
                                        value="Добавить адресс" onclick="kult(document.getElementById('culture'))">
                                    Добавить Культуру
                                </button>
                                @if(session('successCulture'))
                                    <p class="p-2 bg-success text-white rounded mt-3">{{session('successCulture')}}</p>
                                @endif
                                <form action="{{route('editCulture')}}" method="POST" id="culture" style="display: none;">
                                    @csrf
                                    <h6 class="mb-0 mt-3">Культура</h6>
                                    <select name="culture_id" class="form-select mt-2" aria-label="Default select example">
                                        <option disabled selected>Выберите культуру</option>
                                        @foreach($cultures as $cult)
                                            <option value="{{$cult->id}}">{{$cult->cultureName}}</option>
                                        @endforeach
                                    </select>
                                    @error('culture_id')
                                    <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                    <h5 class="mb-0 mt-3">Площадь</h5>

                                    <input class="form-control mt-2" name="square" id="squareCulture" placeholder="Га">

                                    @error('square')
                                    <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                    <h5 class="mb-0 mt-3">Год посева</h5>
                                    <input name="yearSowing" class="form-control mt-2" type="number" min="2022" max="2099" step="1" value="2022" />
                                    @error('yearSowing')
                                    <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                    <button class="btn btn-outline-primary mt-3" type="submit">Сохранить</button>

                                </form>
                                @foreach($userCulture as $userCult)
                                    @if($userCult->user_id == \Illuminate\Support\Facades\Auth::user()->user_id and $userCult->status == 1)
                                        <div class="card mb-4 mt-2">
                                            <div class="card-body">
                                                <div class="d-flex flex-row-reverse w-100" >

                                                    <form action="{{route('cultDel', $userCult->userCult_id)}}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button value="status" name="status" class="btn btn-outline-primary d-flex justify-content-center" type="button"
                                                                data-toggle="modal" data-target="#exampleModalCenter"><i class="bi bi-x-lg"></i></button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">Вы действительно хотите удалить культуру?</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
                                                                        <button type="submit" class="btn btn-danger">Да, удалить</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Культура</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">
                                                            {{$userCult->cultureName}}
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Площадь</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">
                                                            {{$userCult->square}}
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Год посева</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">
                                                            {{$userCult->yearSowing}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function kult(form) {
        if (form.style.display == "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }
</script>
