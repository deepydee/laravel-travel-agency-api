<?php

namespace App\Http\Controllers\API\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TravelRequest;
use App\Http\Resources\TravelResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Travel;


class TravelController extends Controller
{
    public function store(TravelRequest $request): JsonResource
    {
        $travel = Travel::create($request->validated());

        return new TravelResource($travel);
    }
}
