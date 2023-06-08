<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TourResource;
use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TourController extends Controller
{
    public function index(Travel $travel, Request $request): AnonymousResourceCollection
    {
        $perPage = $request->per_page ?? Tour::PER_PAGE;
        $sortDirection = $request->sortDirection ?? 'asc';

        $tours = Tour::query()->where('travel_id', $travel->id);

        if ($request->has('sortByPrice')) {
            $tours->orderBy('price', $sortDirection);
        }

        if ($request->has('priceFrom')) {
            $tours = $tours
                ->where('price', '>=', $request->priceFrom * 100)
                ->oldest('starting_date');
        }

        if ($request->has('priceTo')) {
            $tours = $tours
                ->where('price', '<=', $request->priceTo * 100)
                ->oldest('starting_date');
        }

        if ($request->has('dateFrom')) {
            $tours = $tours
                ->whereDate('starting_date', '>=', $request->dateFrom)
                ->oldest('starting_date');
        }

        if ($request->has('dateTo')) {
            $tours = $tours
                ->whereDate('starting_date', '<=', $request->dateTo)
                ->oldest('starting_date');
        }

        $tours->oldest('starting_date');

        return(TourResource::collection($tours->paginate($perPage)));
    }
}
