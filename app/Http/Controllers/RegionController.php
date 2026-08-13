<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegionRequest;
use App\Http\Requests\UpdateRegionRequest;
use App\Http\Resources\RegionResource;
use App\Models\Region;
use App\Services\RegionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class RegionController extends Controller
{
    public function __construct(private readonly RegionService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('regions/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegionRequest $request): JsonResponse
    {
        $region = $this->service->store($request->validated());

        return (new RegionResource($region))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region): RegionResource
    {
        Gate::authorize('view', $region);

        return new RegionResource($region);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region): Response
    {
        Gate::authorize('view', $region);

        return Inertia::render('regions/edit', [
            'region' => new RegionResource($region),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegionRequest $request, Region $region): RegionResource
    {
        return new RegionResource($this->service->update($region, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region): HttpResponse
    {
        Gate::authorize('delete', $region);

        $this->service->destroy($region);

        return response()->noContent();
    }
}
