<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProvinceRequest;
use App\Http\Requests\UpdateProvinceRequest;
use App\Http\Resources\ProvinceResource;
use App\Models\Province;
use App\Services\ProvinceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class ProvinceController extends Controller
{
    public function __construct(private readonly ProvinceService $service) {}

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
        return Inertia::render('provinces/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProvinceRequest $request): JsonResponse
    {
        $province = $this->service->store($request->validated());

        return (new ProvinceResource($province))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Province $province): ProvinceResource
    {
        Gate::authorize('view', $province);

        return new ProvinceResource($province);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Province $province): Response
    {
        Gate::authorize('view', $province);

        return Inertia::render('provinces/edit', [
            'province' => new ProvinceResource($province),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProvinceRequest $request, Province $province): ProvinceResource
    {
        return new ProvinceResource($this->service->update($province, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Province $province): HttpResponse
    {
        Gate::authorize('delete', $province);

        $this->service->destroy($province);

        return response()->noContent();
    }
}
