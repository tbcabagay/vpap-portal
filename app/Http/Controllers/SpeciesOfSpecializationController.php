<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpeciesOfSpecializationRequest;
use App\Http\Requests\UpdateSpeciesOfSpecializationRequest;
use App\Http\Resources\SpeciesOfSpecializationResource;
use App\Models\SpeciesOfSpecialization;
use App\Services\SpeciesOfSpecializationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class SpeciesOfSpecializationController extends Controller
{
    public function __construct(private readonly SpeciesOfSpecializationService $service) {}

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
        return Inertia::render('species-of-specializations/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpeciesOfSpecializationRequest $request): JsonResponse
    {
        $species = $this->service->store($request->validated());

        return (new SpeciesOfSpecializationResource($species))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SpeciesOfSpecialization $speciesOfSpecialization): SpeciesOfSpecializationResource
    {
        Gate::authorize('view', $speciesOfSpecialization);

        return new SpeciesOfSpecializationResource($speciesOfSpecialization);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SpeciesOfSpecialization $speciesOfSpecialization): Response
    {
        Gate::authorize('view', $speciesOfSpecialization);

        return Inertia::render('species-of-specializations/edit', [
            'speciesOfSpecialization' => new SpeciesOfSpecializationResource($speciesOfSpecialization),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpeciesOfSpecializationRequest $request, SpeciesOfSpecialization $speciesOfSpecialization): SpeciesOfSpecializationResource
    {
        return new SpeciesOfSpecializationResource($this->service->update($speciesOfSpecialization, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SpeciesOfSpecialization $speciesOfSpecialization): HttpResponse
    {
        Gate::authorize('delete', $speciesOfSpecialization);

        $this->service->destroy($speciesOfSpecialization);

        return response()->noContent();
    }
}
