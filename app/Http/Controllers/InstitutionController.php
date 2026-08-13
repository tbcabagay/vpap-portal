<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstitutionRequest;
use App\Http\Requests\UpdateInstitutionRequest;
use App\Http\Resources\InstitutionResource;
use App\Models\Institution;
use App\Services\InstitutionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class InstitutionController extends Controller
{
    public function __construct(private readonly InstitutionService $service) {}

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
        return Inertia::render('institutions/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstitutionRequest $request): JsonResponse
    {
        $institution = $this->service->store($request->validated());

        return (new InstitutionResource($institution))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Institution $institution): InstitutionResource
    {
        Gate::authorize('view', $institution);

        return new InstitutionResource($institution);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Institution $institution): Response
    {
        Gate::authorize('view', $institution);

        return Inertia::render('institutions/edit', [
            'institution' => new InstitutionResource($institution),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstitutionRequest $request, Institution $institution): InstitutionResource
    {
        return new InstitutionResource($this->service->update($institution, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Institution $institution): HttpResponse
    {
        Gate::authorize('delete', $institution);

        $this->service->destroy($institution);

        return response()->noContent();
    }
}
