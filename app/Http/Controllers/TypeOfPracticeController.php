<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTypeOfPracticeRequest;
use App\Http\Requests\UpdateTypeOfPracticeRequest;
use App\Http\Resources\TypeOfPracticeResource;
use App\Models\TypeOfPractice;
use App\Services\TypeOfPracticeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class TypeOfPracticeController extends Controller
{
    public function __construct(private readonly TypeOfPracticeService $service) {}

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
        return Inertia::render('type-of-practices/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeOfPracticeRequest $request): JsonResponse
    {
        $type = $this->service->store($request->validated());

        return (new TypeOfPracticeResource($type))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeOfPractice $typeOfPractice): TypeOfPracticeResource
    {
        Gate::authorize('view', $typeOfPractice);

        return new TypeOfPracticeResource($typeOfPractice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeOfPractice $typeOfPractice): Response
    {
        Gate::authorize('view', $typeOfPractice);

        return Inertia::render('type-of-practices/edit', [
            'typeOfPractice' => new TypeOfPracticeResource($typeOfPractice),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeOfPracticeRequest $request, TypeOfPractice $typeOfPractice): TypeOfPracticeResource
    {
        return new TypeOfPracticeResource($this->service->update($typeOfPractice, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeOfPractice $typeOfPractice): HttpResponse
    {
        Gate::authorize('delete', $typeOfPractice);

        $this->service->destroy($typeOfPractice);

        return response()->noContent();
    }
}
