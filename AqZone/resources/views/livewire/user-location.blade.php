<div>

    <h6 class="mb-0 mt-3">Область</h6>
    <div class="btn-group mt-2">
        <select wire:model="selectedRegion" name="region_id" class="form-select" aria-label="Default select example">
            <option value="1" selected>Выберите Регион</option>
            @foreach($regions as $region)
                <option value="{{$region->id}}">{{$region->regionName}}</option>
            @endforeach
        </select>
    </div>
    @error('region_id')
    <p class="text-red-500">{{ $message }}</p>
    @enderror

    @if(!is_null($subregions))
        <h6 class="mb-0 mt-3">Район</h6>
        <div class="btn-group mt-2">
            <select wire:model="selectedSubRegion" name="subregion_id" class="form-select" aria-label="Default select example">
                <option selected="true" value="1">Выберите район</option>
                @foreach($subregions as $subregion)
                    <option value="{{$subregion->id}}">{{$subregion->subRegionName}}</option>
                @endforeach
            </select>
        </div>
    @endif
    @error('subregion_id')
    <p class="text-red-500">{{ $message }}</p>
    @enderror



    @if(!is_null($localities))
        <h6 class="mb-0 mt-3">Населенный пункт</h6>
        <div class="btn-group mt-2">
            <select wire:model="selectedLocalities" name="locality_id" class="form-select" aria-label="Default select example">
                <option disabled selected>Выберите под регион</option>
                @foreach($localities as $locality)
                    <option value="{{$locality->id}}">{{$locality->localityName}}</option>
                @endforeach
            </select>
        </div>
    @endif
    @error('locality_id')
    <p class="text-red-500">{{ $message }}</p>
    @enderror





</div>
