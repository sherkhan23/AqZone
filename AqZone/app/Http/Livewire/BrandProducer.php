<?php

namespace App\Http\Livewire;

use App\Models\Aids;
use App\Models\AidsUtilizationNorms;
use App\Models\Brands;
use App\Models\Categories;
use App\Models\Cultures;
use App\Models\HazardObjects;
use App\Models\PreparativeForms;
use App\Models\Producers;
use Livewire\Component;

class BrandProducer extends Component
{
    public $selectedProducer = null;
    public $selectedBrand = null;
    public $producers = null;


    public function render()
    {
        return view('livewire.brand-producer', [
            'brands' => Brands::all(),
            'categories' => Categories::all(),
            'preparativeForms' => PreparativeForms::all(),
            'cultures' => Cultures::all(),
            'hazards' => HazardObjects::all()
        ]);
    }

    public function updatedSelectedBrand($brand_id)
    {
        $this->producers = Producers::where('brand_id',$brand_id)->get();
    }

}
