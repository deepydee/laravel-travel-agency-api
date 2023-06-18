<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TravelResource;
use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @group Public endpoints
 */
class TravelController extends Controller
{
    /**
     * GET Travels
     *
     * Returns paginated list of travels.
     *
     * @queryParam page integer Page number. Example: 1
     * @queryParam per_page integer Show entities per page. Example: 10
     *
     * @response {"data":[{"id":"9958e389-5edf-48eb-8ecd-e058985cf3ce","name":"First travel", ...}}
     */
    public function index(Request $request): ResourceCollection
    {
        $perPage = $request->per_page ?? Travel::PER_PAGE;

        $travels = Travel::where('is_public', true)
            ->paginate($perPage);

        return TravelResource::collection($travels);
    }

    /**
     * GET Travel
     *
     * Returns single travel.
     *
     * @urlParam travel_uuid string Travel uuid. Example: "9965e77d-c264-4988-b9f5-8a50b08cdd2a"
     *
     * @response {"data":{"id":"9965e77d-c264-4988-b9f5-8a50b08cdd2a","slug":"molestiae-alias-ab-et-quo-molestiae-reprehenderit-consequatur-consectetur","name":"Impressive1234","description":"Description","number_of_days":14,"number_of_nights":13}}
     */
    public function show(Travel $travel): JsonResource
    {
        return new TravelResource($travel);
    }
}
