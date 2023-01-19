<html>

<head>


    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    {{--    For mask number of telephone--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>
<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                <h2>Welcome to MarketPlace 👋</h2>
                                <h4 class="text-3xl font-medium text-muted"> Введите код который с смс!  </h4>

                                <form action="{{ route("sms_process_check") }}" class="space-y-5 mt-3" method="POST">

                                    @csrf

                                    <div class="col mt-2">
                                        <label>Код подтверждения: </label>
                                        <input name="message" id="" class="form-control mt-2" placeholder="Введите код подтверждения ">
                                    </div>


                                    <button type="submit" class="form-control mt-3 bg-light" >Отправить</button>
                                </form>

                                <div>
                                    <a href="{{ route("login") }}" class="font-medium text-blue-900 hover:bg-blue-300 rounded-md p-2">Есть аккаунт?</a>
                                    <a href="{{ route("register") }}" class="font-medium text-blue-900 hover:bg-blue-300 rounded-md p-2">Регестрация</a> <br>
                                    <a href="{{ route("send_sms") }}" class="font-medium text-blue-900 hover:bg-blue-300 rounded-md p-2">Подтверждение номера</a>


                                </div>


                                </form>
                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                <img src="https://miro.medium.com/max/1400/1*Z6RVx22xKXRI24azboF3gg.jpeg" class="img-fluid rounded-circle" alt="Sample image">

                            </div>

                        </div>
                    </div>
                </div>
            </div>

</body>
</html>
