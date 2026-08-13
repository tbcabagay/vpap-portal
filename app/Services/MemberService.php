<?php

namespace App\Services;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MemberService extends BaseService
{
    protected function model(): string
    {
        return Member::class;
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function store(array $data): Member
    {
        return DB::transaction(function () use ($data) {
            $pivots = $this->extractPivotIds($data);
            $member = Member::create($data);
            $this->syncPivots($member, $pivots);

            return $member;
        });
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(Model $member, array $data): Model
    {
        return DB::transaction(function () use ($member, $data) {
            /** @var Member $member */
            $pivots = $this->extractPivotIds($data);
            $member->update($data);
            $this->syncPivots($member, $pivots);

            return $member;
        });
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array{species: list<int>, practices: list<int>}
     */
    private function extractPivotIds(array &$data): array
    {
        $species = $data['species_of_specializations'] ?? [];
        $practices = $data['type_of_practices'] ?? [];

        unset($data['species_of_specializations'], $data['type_of_practices']);

        return ['species' => $species, 'practices' => $practices];
    }

    /**
     * @param  array{species: list<int>, practices: list<int>}  $pivots
     */
    private function syncPivots(Member $member, array $pivots): void
    {
        $member->speciesOfSpecializations()->sync($pivots['species']);
        $member->typeOfPractices()->sync($pivots['practices']);
    }
}
