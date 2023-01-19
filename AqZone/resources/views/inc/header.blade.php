<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</head>

<style>

    .card-column{
        float: left;
        width: 45%;
        display: grid;
        justify-content: center;
        align-items: center;
        padding: 10px;
        height: 215px;
        margin: 5px;
        background-color: #FFC528;
        border-radius: 15px;
        color: white;
        font-size: large;
        flex-wrap: wrap;
    }
    .card-column:hover{
        background: #00C759;
        color: white;
    }

    .card-column > button{
        justify-content: center;
        align-items: center;
        color: white;
        font-size: large;
        text-decoration: none;
    }

    @media(max-width:500px) {
        .card-column{
            height: 150px;
        }
        #aid_pic{
            width: 50px;
            height: 50px;
        }
    }
    /* Clear floats after the columns */
    .card-row:after {
        content: "";
        display: table;
        clear: both;
    }

    .main-buttons:hover{
        text-decoration: none;
        border: 0;
        color: white;
        text-underline: none;
    }
</style>

<div class="container-fluid px-5">
    <div class="row" id="header-row">
        <div class="col-md-4">
            <div class="row">
                <a class="card-column text-center" href="{{route("catalog")}}">
                    <button class="p-4 btn main-buttons">
                        Каталог
                    </button>
                </a>

                <a class="card-column text-center" href="{{route("cart")}}">
                    <button class="p-4 btn main-buttons">
                        Корзина
                    </button>
                </a>
            </div>

            <div class="row">
                <a class="card-column text-center" href="{{route("applications")}}">
                    <button class="p-4 btn main-buttons">
                        Заявки
                    </button>
                </a>

                <a class="card-column text-center" href="{{route("catalog")}}">
                    <button class="p-4 btn main-buttons">
                        Заказы
                    </button>
                </a>
            </div>

        </div>
        <div class="col-md-8">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" style="border-radius: 10px">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="https://attuale.ru/wp-content/uploads/2018/06/tdleto_blog-56-02_1.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="https://protambov.ru/wp-content/uploads/2019/06/gerbicidy.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="https://modamix.net/wp-content/uploads/2019/09/i67AM9WIT.jpg" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12 col-md-6 mb-3 mb-lg-0">
            <div>
                <div class="py-10 px-8 rounded-3" style="background: url('https://envato-shoebox-0.imgix.net/ba8f/4e41-d826-4ec8-aab0-b430d1925467/Plum+Agriculture_424.jpg?auto=compress%2Cformat&fit=max&mark=https%3A%2F%2Felements-assets.envato.com%2Fstatic%2Fwatermark2.png&markalign=center%2Cmiddle&markalpha=18&w=1600&s=6255d928093c7de326ca8bf6f33a5106'); background-size: cover; background-position: center;">
                    <div>
                        <h3 class="fw-bold mb-1">Fruits &amp; Vegetables
                        </h3>
                        <p class="mb-4">Get Upto <span class="fw-bold">30%</span> Off</p>
                        <a href="#!" class="btn btn-dark">Посмотреть</a>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-12 col-md-6 ">

            <div>
                <div class="py-10 px-8 rounded-3" style="background: url('https://rshn32.ru/files/2021/10/shutterstock_608381930.jpg'); background-size: cover; background-position: center;">
                    <div>
                        <h3 class="fw-bold mb-1">Freshly Baked
                            Buns
                        </h3>
                        <p class="mb-4">Get Upto <span class="fw-bold">25%</span> Off</p>
                        <a href="#!" class="btn btn-dark">Посмотреть</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@include('inc.cardSlider')




