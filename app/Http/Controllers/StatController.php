<?php

namespace App\Http\Controllers;

use App\Stats;
use App\Transformers\StatisticTransformer;
use JsonFormat;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class StatController extends Controller
{
    private $fractal;

    public function __construct()
    {
        $this->middleware('throttle:20,2');
        $this->fractal = new Manager();
        app('translator')->setLocale('en');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stats = Stats::all();
        $resource = new Collection($stats, new StatisticTransformer());
        $data = $this->fractal->createData($resource)->toArray();

        return response(array_replace(JsonFormat::setJson([], true, []), $data), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Stats $stats
     *
     * @return \Illuminate\Http\Response
     */
    public function show($day)
    {
        $stat = Stats::where('day', $day)->first();
        if ($stat === null) {
            return response(JsonFormat::setJson([], false, ['code' => 404, 'message' => 'Stats not found!']), 404);
        } else {
            $resource = new Item($stat, new StatisticTransformer());
            $data = $this->fractal->createData($resource)->toArray();

            return response(array_replace(JsonFormat::setJson([], true, []), $data), 200);
        }
    }
}
