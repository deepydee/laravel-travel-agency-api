<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TravelResource;
use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): ResourceCollection
    {
        $perPage = $request->per_page ?? Travel::PER_PAGE;

        $travels = Travel::where('is_public', true)
            ->paginate($perPage);

        return TravelResource::collection($travels);
    }

    /**
     * Display the specified resource.
     */
    public function show(Travel $travel): JsonResource
    {
        return new TravelResource($travel);
    }
}
