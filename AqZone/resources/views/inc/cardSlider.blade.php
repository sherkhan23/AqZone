@extends('layouts.app')
<style>
    @media (max-width: 768px) {
        .carousel-inner .carousel-item > div {
            display: none;
        }
        .carousel-inner .carousel-item > div:first-child {
            display: block;
        }
    }

    .carousel-inner .carousel-item.active,
    .carousel-inner .carousel-item-next,
    .carousel-inner .carousel-item-prev {
        display: flex;
    }

    /* display 3 */
    @media (min-width: 768px) {

        .carousel-inner .carousel-item-right.active,
        .carousel-inner .carousel-item-next {
            transform: translateX(33.333%);
        }

        .carousel-inner .carousel-item-left.active,
        .carousel-inner .carousel-item-prev {
            transform: translateX(-33.333%);
        }
    }

    .carousel-inner .carousel-item-right,
    .carousel-inner .carousel-item-left{
        transform: translateX(0);
    }


</style>

<div class="container text-center my-3 py-3">
    <h2 class="font-weight-light py-5 text-start">Популярные с котолога</h2>
    <div class="row mx-auto my-auto">

        <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
            <div class="carousel-inner w-100" role="listbox">

                <div class="carousel-item active">
                </div>
                @foreach($aids as $el)
                    <div class="carousel-item">
                            <div class="col-md-4">
                                <div class="card card-body h-100">
                                    <div class="row">
                                        <div class="col-md-6 text-start">

                                            <h5>{{$el->aidName}}</h5>
                                            <div class="d-flex flex-row">
                                                <span class="text-muted">Категория: </span>
                                                <span class="ml-1"> {{$el->categoryName}}</span>
                                            </div>

                                            <div class="mt-1 mb-0 text-muted small">
                                                <span>{{$el->ProducerName}}</span>
                                                <span>{{$el->producerCountry}}</span>
                                            </div>

                                            <div class="mb-2 text-muted small">
                                                <span>{{$el->BrandName}}</span>
                                                {{--                                    component--}}
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-flex" style="align-items: center; justify-content: center">
                                            <a style="background-color: #00C759" class="text-white btn btn-md" href="{{ route('show_aids', $el->aids_id) }}">
                                                Перейти
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                @endforeach



            </div>
            <a class="carousel-control-prev w-auto" href="#recipeCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next w-auto" href="#recipeCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>


<script>
    $('#recipeCarousel').carousel({
        interval: 10000
    })

    $('#recipeCarousel .carousel-item').each(function(){
        var minPerSlide = 3;
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        for (var i=0;i<minPerSlide;i++) {
            next=next.next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }

            next.children(':first-child').clone().appendTo($(this));
        }
    });

</script>
