<?php

namespace App\Services;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AnnouncementService extends BaseService
{
    protected function model(): string
    {
        return Announcement::class;
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function store(array $data): Announcement
    {
        $data['created_by'] = Auth::id();
        $data['updated_by'] = Auth::id();

        return parent::store($data);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(Model $announcement, array $data): Model
    {
        $data['updated_by'] = Auth::id();

        return parent::update($announcement, $data);
    }
}
