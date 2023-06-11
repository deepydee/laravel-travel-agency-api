<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetToursRequest;
use App\Http\Resources\TourResource;
use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TourController extends Controller
{
    public function index(Travel $travel, GetToursRequest $request): AnonymousResourceCollection
    {
        $perPage = $request->per_page ?? Tour::PER_PAGE;
        $sortDirection = $request->sortDirection ?? 'asc';

        $tours = $travel->tours()
            ->when($request->has('sortByPrice'), function ($query) use ($sortDirection) {
                return $query->orderBy('price', $sortDirection);
            })
            ->when($request->has('priceFrom'), function ($query) use ($request) {
                return $query->where('price', '>=', $request->priceFrom * 100);
            })
            ->when($request->has('priceTo'), function ($query) use ($request) {
                return $query->where('price', '<=', $request->priceTo * 100);
            })
            ->when($request->has('dateFrom'), function ($query) use ($request) {
                return $query->whereDate('starting_date', '>=', $request->dateFrom);
            })
            ->when($request->has('dateTo'), function ($query) use ($request) {
                return $query->whereDate('starting_date', '<=', $request->dateTo);
            })
            ->oldest('starting_date');

        return(TourResource::collection($tours->paginate($perPage)));
    }
}
