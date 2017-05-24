<?php
namespace Wjh\Region;

use App\Http\Controllers\Controller;
use App\Model\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

/**
 * Class RegionController
 * @package App\Http\Controllers
 */
class RegionController extends Controller
{

    /**
     * @var static
     */
    protected $region;

    /**
     * RegionController constructor.
     */
    public function __construct()
    {
        $regions = config('region');
        $this->region = Collection::make(json_decode($regions, true));
    }

    /**
     * @return mixed
     */
    public function index()
    {
//        $provinces = $this->region->where('region_type', 1)->map(function($province) {
//            return collect($province);
//        });
//        return view('region.index', ['provinces' => $provinces]);
    }

    /**
     * @param Request $request
     * @return static
     */
    public function getCity(Request $request)
    {
        $province = $request->get('province');
        return $this->region->where('parent_id', $province);
    }

    /**
     * @param Request $request
     * @return static
     */
    public function getCounty(Request $request)
    {
        $province = $request->get('city');
        return $this->region->where('parent_id', $province);
    }


    /**
     *
     */
    public function regionList()
    {
        $regions = Region::select('region_id', 'parent_id', 'region_name', 'region_type')->get();
        foreach ($regions as $region)
        {
            File::put(config_path('region.php'), $regions->toJson());
        }
        
    }
    
    
}