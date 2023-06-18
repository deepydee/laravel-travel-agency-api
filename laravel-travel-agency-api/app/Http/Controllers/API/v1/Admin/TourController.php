<?php

namespace App\Http\Controllers\API\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourRequest;
use App\Http\Resources\TourResource;
use App\Models\Travel;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @group Admin endpoints
 */
class TourController extends Controller
{
    /**
     * POST Tour
     *
     * Creates new Tour record.
     *
     * @authenticated
     *
     * @response {"data":{"id":"9970f432-99a4-4e60-b684-ba613b4b18d2","name":"Impressive1234!!","starting_date":"2023-07-01","ending_date":"2023-08-01","price":"3,000.00"}}
     * @response 422 {"message":"The name has already been taken. (and 2 more errors)","errors":{"name":["The name has already been taken."],"description":["The description field is required."],"number_of_days":["The number of days field is required."]}}
     */
    public function store(Travel $travel, TourRequest $request): JsonResource
    {
        $tour = $travel->tours()->create($request->validated());

        return new TourResource($tour);
    }
}
