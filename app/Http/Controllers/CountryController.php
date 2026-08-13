<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use App\Services\CountryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class CountryController extends Controller
{
    public function __construct(private readonly CountryService $service) {}

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
        return Inertia::render('countries/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCountryRequest $request): JsonResponse
    {
        $country = $this->service->store($request->validated());

        return (new CountryResource($country))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country): CountryResource
    {
        Gate::authorize('view', $country);

        return new CountryResource($country);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country): Response
    {
        Gate::authorize('view', $country);

        return Inertia::render('countries/edit', [
            'country' => new CountryResource($country),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountryRequest $request, Country $country): CountryResource
    {
        return new CountryResource($this->service->update($country, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country): HttpResponse
    {
        Gate::authorize('delete', $country);

        $this->service->destroy($country);

        return response()->noContent();
    }
}
