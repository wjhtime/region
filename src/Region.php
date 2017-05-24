<?php
namespace Wjh\Region;

use Illuminate\Support\Collection;

class Region
{

    protected $region;

    public function make()
    {
        $regions = config('region');
        $this->region = Collection::make(json_decode($regions, true));

        $provinces = $this->region->where('region_type', 1)->map(function($province) {
            return collect($province);
        });
        return view('vendor.region.index', ['provinces' => $provinces]);
    }
    
    
}