<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSponsorRequest;
use App\Http\Requests\UpdateSponsorRequest;
use App\Http\Resources\SponsorResource;
use App\Models\Sponsor;
use App\Services\SponsorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class SponsorController extends Controller
{
    public function __construct(private readonly SponsorService $service) {}

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
        return Inertia::render('sponsors/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSponsorRequest $request): JsonResponse
    {
        $sponsor = $this->service->store($request->validated());

        return (new SponsorResource($sponsor))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sponsor $sponsor): SponsorResource
    {
        Gate::authorize('view', $sponsor);

        return new SponsorResource($sponsor);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sponsor $sponsor): Response
    {
        Gate::authorize('view', $sponsor);

        return Inertia::render('sponsors/edit', [
            'sponsor' => new SponsorResource($sponsor),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSponsorRequest $request, Sponsor $sponsor): SponsorResource
    {
        return new SponsorResource($this->service->update($sponsor, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsor $sponsor): HttpResponse
    {
        Gate::authorize('delete', $sponsor);

        $this->service->destroy($sponsor);

        return response()->noContent();
    }
}
