<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMunicipalityRequest;
use App\Http\Requests\UpdateMunicipalityRequest;
use App\Http\Resources\MunicipalityResource;
use App\Models\Municipality;
use App\Services\MunicipalityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class MunicipalityController extends Controller
{
    public function __construct(private readonly MunicipalityService $service) {}

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
        return Inertia::render('municipalities/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMunicipalityRequest $request): JsonResponse
    {
        $municipality = $this->service->store($request->validated());

        return (new MunicipalityResource($municipality))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Municipality $municipality): MunicipalityResource
    {
        Gate::authorize('view', $municipality);

        return new MunicipalityResource($municipality);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Municipality $municipality): Response
    {
        Gate::authorize('view', $municipality);

        return Inertia::render('municipalities/edit', [
            'municipality' => new MunicipalityResource($municipality),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMunicipalityRequest $request, Municipality $municipality): MunicipalityResource
    {
        return new MunicipalityResource($this->service->update($municipality, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Municipality $municipality): HttpResponse
    {
        Gate::authorize('delete', $municipality);

        $this->service->destroy($municipality);

        return response()->noContent();
    }
}
