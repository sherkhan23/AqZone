<?php

namespace App\Http\Livewire;

use App\Models\Countries;
use App\Models\Localities;
use App\Models\Locality;
use App\Models\Locations;
use App\Models\Regions;
use App\Models\Subregions;
use Livewire\Component;

class UserLocation extends Component
{

    public $selectedRegion = null;
    public $selectedSubRegion = null;
    public $selectedLocalities = null;
    public $subregions = null;
    public $localities = null;

    public function render(){

        return view('livewire.user-location', [
            'countries' => Countries::all(),
            'regions' => Regions::all(),
            'subregions' => Subregions::all(),
            'localities' => Localities::all(),
        ]);
    }

    public function updatedSelectedRegion($region_id)
    {
        $this->subregions = Subregions::where('region_id',$region_id)->get();
    }

    public function updatedSelectedSubRegion($subregion_id)
    {
        $this->localities = Localities::where('subregion_id',$subregion_id)->get();
    }

}
