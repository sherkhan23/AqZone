<div>
        <form id="form1" method="GET" action="{{ route("catalog") }}" role="search">
            {{ csrf_field() }}
            <ul class="list-unstyled ps-0" id="filter">
                <li class="m-1">
                    <b>Категория</b>
                    <select name="categoryFilter" class="form-select" aria-label="Default select example">
                        <option selected="true" disabled="disabled">Выберите категорию </option>
                        @foreach($categories as $cat)
                            <option value="{{$cat->id}}">{{$cat->categoryName}}</option>
                        @endforeach
                    </select>
                </li>
                <li class="mb-1 pt-2">
                    <b> Производитель (бренд)</b>
                    <select wire:model="selectedBrand" name="brandFilter" class="form-select" aria-label="Default select example">
                        <option disabled="disabled" selected>Выберите бренд</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->BrandName}}</option>
                        @endforeach
                    </select>
                </li>

                @if(!is_null($producers))
                    <li class="mb-1 pt-2">
                        <b> Страна производства</b>
                        <select wire:model="selectedProducer" name="producerFilter" class="form-select" aria-label="Default select example">
                            @foreach($producers as $producer)
                                <option value="{{$producer->producer_id}}">{{$producer->ProducerName}}</option>
                            @endforeach
                        </select>
                    </li>
                @endif
                <li class="mb-1 pt-2">
                    <b>Препаративная форма</b>
                    <select name="preparativeFormsFilter" class="form-select" aria-label="Default select example">
                        <option selected="true" disabled="disabled">Выберите перпаративную форму </option>
                        @foreach($preparativeForms as $preparativeForm)
                            <option value="{{$preparativeForm->id}}">{{$preparativeForm->prepFormName  }}</option>
                        @endforeach
                    </select>
                </li>
                <li class="mb-1 pt-2">
                    <b>Культуры</b>
                    <select name="cultureFilter" class="form-select" aria-label="Default select example">
                        <option selected="true" disabled="disabled">Выберите растение</option>
                        @foreach($cultures as $culture)
                            <option value="{{$culture->culture_id}}">{{$culture->cultureName}}</option>
                        @endforeach
                    </select>
                </li>

                <li class="mb-1 pt-2">
                    <b>Вредные объекты</b>
                    <select name="hazardFilter" class="form-select" aria-label="Default select example">
                        <option selected="true" disabled="disabled">Выберите вредные объекты</option>
                        @foreach($hazards as $hazard)
                            <option value="{{$hazard->hazard_id}}">{{$hazard->hazardName}}</option>
                        @endforeach
                    </select>
                </li>
            </ul>

            <button class="button form-control mt-3 text-dark" style="background-color: #00C759"  type="submit">Применить</button>
        </form>
</div>
