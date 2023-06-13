<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTravelsRequest;
use App\Http\Resources\TravelResource;
use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TravelController extends Controller
{
    public function __construct() {
        $this->middleware('auth:sanctum')->except('index');
    }

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
     * Store a newly created resource in storage.
     */
    public function store(StoreTravelsRequest $request): JsonResource
    {
        $travel = Travel::create($request->validated());

        return new TravelResource($travel);
    }

    /**
     * Display the specified resource.
     */
    public function show(Travel $travel): JsonResource
    {
        return new TravelResource($travel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
