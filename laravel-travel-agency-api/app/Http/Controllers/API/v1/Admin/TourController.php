<?php

namespace App\Http\Controllers\API\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourRequest;
use App\Http\Resources\TourResource;
use App\Models\Travel;
use Illuminate\Http\Resources\Json\JsonResource;

class TourController extends Controller
{
    public function store(Travel $travel, TourRequest $request): JsonResource
    {
        $tour = $travel->tours()->create($request->validated());

        return new TourResource($tour);
    }
}
