<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Http\Resources\AttendanceResource;
use App\Models\Attendance;
use App\Services\AttendanceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class AttendanceController extends Controller
{
    public function __construct(private readonly AttendanceService $service) {}

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
        return Inertia::render('attendances/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendanceRequest $request): JsonResponse
    {
        $attendance = $this->service->store($request->validated());

        return (new AttendanceResource($attendance))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance): AttendanceResource
    {
        Gate::authorize('view', $attendance);

        return new AttendanceResource($attendance);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance): Response
    {
        Gate::authorize('view', $attendance);

        return Inertia::render('attendances/edit', [
            'attendance' => new AttendanceResource($attendance),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance): AttendanceResource
    {
        return new AttendanceResource($this->service->update($attendance, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance): HttpResponse
    {
        Gate::authorize('delete', $attendance);

        $this->service->destroy($attendance);

        return response()->noContent();
    }
}
