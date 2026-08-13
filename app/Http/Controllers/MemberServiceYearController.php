<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberServiceYearRequest;
use App\Http\Requests\UpdateMemberServiceYearRequest;
use App\Http\Resources\MemberServiceYearResource;
use App\Models\MemberServiceYear;
use App\Services\MemberServiceYearService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class MemberServiceYearController extends Controller
{
    public function __construct(private readonly MemberServiceYearService $service) {}

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
        return Inertia::render('member-service-years/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberServiceYearRequest $request): JsonResponse
    {
        $serviceYear = $this->service->store($request->validated());

        return (new MemberServiceYearResource($serviceYear))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(MemberServiceYear $memberServiceYear): MemberServiceYearResource
    {
        Gate::authorize('view', $memberServiceYear);

        return new MemberServiceYearResource($memberServiceYear);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MemberServiceYear $memberServiceYear): Response
    {
        Gate::authorize('view', $memberServiceYear);

        return Inertia::render('member-service-years/edit', [
            'memberServiceYear' => new MemberServiceYearResource($memberServiceYear),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberServiceYearRequest $request, MemberServiceYear $memberServiceYear): MemberServiceYearResource
    {
        return new MemberServiceYearResource($this->service->update($memberServiceYear, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MemberServiceYear $memberServiceYear): HttpResponse
    {
        Gate::authorize('delete', $memberServiceYear);

        $this->service->destroy($memberServiceYear);

        return response()->noContent();
    }
}
