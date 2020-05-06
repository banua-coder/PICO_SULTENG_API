<?php

namespace App\Http\Controllers;

use App\District;
use App\Hospital;
use App\Province;
use App\Stats;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use JsonFormat;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('throttle:20,2');
    }
    public function index()
    {
        $province = Province::where('kode_provinsi', 72)->first();
        $provinces = Province::all();
        $hospitals = Hospital::all();
        $stats = Stats::all();
        $path = '/images/pico_app.png';
        $districts = District::all();
        setlocale(LC_TIME, 'id_ID.UTF-8');
        Carbon::setLocale('id_ID.UTF-8');
        $last_update = $province->updated_at->formatLocalized('%A, %d %B %Y');
        $geojson = Http::get("https://raw.githubusercontent.com/RyanAidilPratama/PICO_SULTENG_Android/master/app/src/main/assets/map.json");
        $geojson = json_encode($geojson->json());

        $count_data = [
            'sum_odp' => $districts->sum('ODP'),
            'sum_pdp' => $districts->sum('PDP'),
            'active_odp' => $districts->sum('dalam_pemantauan'),
            'finished_odp' => $districts->sum('selesai_pemantauan'),
            'active_odp_percentage' => JsonFormat::percentageValue($districts->sum("ODP"), $districts->sum("dalam_pemantauan")),
            'finished_odp_percentage' => JsonFormat::percentageValue($districts->sum("ODP"), $districts->sum("selesai_pemantauan")),
            'active_pdp' => $districts->sum('dalam_pengawasan'),
            'finished_pdp' => $districts->sum('selesai_pengawasan'),
            'active_pdp_percentage' => JsonFormat::percentageValue($districts->sum("PDP"), $districts->sum("dalam_pengawasan")),
            'finished_pdp_percentage' => JsonFormat::percentageValue($districts->sum("PDP"), $districts->sum("selesai_pengawasan")),
            'ina_positive' => number_format($province->sum('positif')),
            'ina_recovered' => number_format($province->sum('sembuh')),
            'ina_death' => number_format($province->sum('meninggal')),
            'last_update' => $last_update
        ];
        return view('home', compact('path', 'province', 'stats', 'districts', 'hospitals', 'count_data', 'provinces', 'geojson'));
    }
}
