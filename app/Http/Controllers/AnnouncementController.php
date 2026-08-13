<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnnouncementRequest;
use App\Http\Requests\UpdateAnnouncementRequest;
use App\Http\Resources\AnnouncementResource;
use App\Models\Announcement;
use App\Services\AnnouncementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class AnnouncementController extends Controller
{
    public function __construct(private readonly AnnouncementService $service) {}

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
        return Inertia::render('announcements/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnnouncementRequest $request): JsonResponse
    {
        $announcement = $this->service->store($request->validated());

        return (new AnnouncementResource($announcement))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement): AnnouncementResource
    {
        Gate::authorize('view', $announcement);

        return new AnnouncementResource($announcement);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement): Response
    {
        Gate::authorize('view', $announcement);

        return Inertia::render('announcements/edit', [
            'announcement' => new AnnouncementResource($announcement),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnnouncementRequest $request, Announcement $announcement): AnnouncementResource
    {
        return new AnnouncementResource($this->service->update($announcement, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement): HttpResponse
    {
        Gate::authorize('delete', $announcement);

        $this->service->destroy($announcement);

        return response()->noContent();
    }
}
