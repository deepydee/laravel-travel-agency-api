<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TravelResource;
use App\Models\Travel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->per_page ?? Travel::PER_PAGE;

        $travels = Travel::where('is_public', true)
            ->paginate($perPage);

        return response()
            ->json([
                'data' => TravelResource::collection($travels),
                'meta' => [
                    'current_page' => $travels->currentPage(),
                    'from' => $travels->firstItem(),
                    'to' => $travels->lastItem(),
                    'last_page' => $travels->lastPage(),
                    'per_page' => $perPage,
                ]
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Travel $travel)
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
