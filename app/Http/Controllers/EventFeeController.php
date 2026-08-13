<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventFeeRequest;
use App\Http\Requests\UpdateEventFeeRequest;
use App\Http\Resources\EventFeeResource;
use App\Models\EventFee;
use App\Services\EventFeeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class EventFeeController extends Controller
{
    public function __construct(private readonly EventFeeService $service) {}

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
        return Inertia::render('event-fees/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventFeeRequest $request): JsonResponse
    {
        $eventFee = $this->service->store($request->validated());

        return (new EventFeeResource($eventFee))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(EventFee $eventFee): EventFeeResource
    {
        Gate::authorize('view', $eventFee);

        return new EventFeeResource($eventFee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventFee $eventFee): Response
    {
        Gate::authorize('view', $eventFee);

        return Inertia::render('event-fees/edit', [
            'eventFee' => new EventFeeResource($eventFee),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventFeeRequest $request, EventFee $eventFee): EventFeeResource
    {
        return new EventFeeResource($this->service->update($eventFee, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventFee $eventFee): HttpResponse
    {
        Gate::authorize('delete', $eventFee);

        $this->service->destroy($eventFee);

        return response()->noContent();
    }
}
