<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use App\Services\MemberService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class MemberController extends Controller
{
    public function __construct(private readonly MemberService $service) {}

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
        return Inertia::render('members/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request): JsonResponse
    {
        $member = $this->service->store($request->validated());

        return (new MemberResource($member))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member): MemberResource
    {
        Gate::authorize('view', $member);

        return new MemberResource($member);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member): Response
    {
        Gate::authorize('view', $member);

        return Inertia::render('members/edit', [
            'member' => new MemberResource($member),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, Member $member): MemberResource
    {
        return new MemberResource($this->service->update($member, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member): HttpResponse
    {
        Gate::authorize('delete', $member);

        $this->service->destroy($member);

        return response()->noContent();
    }
}
