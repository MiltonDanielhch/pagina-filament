<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\DepartmentalStatistics;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentalStatisticsPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:DepartmentalStatistics');
    }

    public function view(AuthUser $authUser, DepartmentalStatistics $departmentalStatistics): bool
    {
        return $authUser->can('View:DepartmentalStatistics');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:DepartmentalStatistics');
    }

    public function update(AuthUser $authUser, DepartmentalStatistics $departmentalStatistics): bool
    {
        return $authUser->can('Update:DepartmentalStatistics');
    }

    public function delete(AuthUser $authUser, DepartmentalStatistics $departmentalStatistics): bool
    {
        return $authUser->can('Delete:DepartmentalStatistics');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:DepartmentalStatistics');
    }

    public function restore(AuthUser $authUser, DepartmentalStatistics $departmentalStatistics): bool
    {
        return $authUser->can('Restore:DepartmentalStatistics');
    }

    public function forceDelete(AuthUser $authUser, DepartmentalStatistics $departmentalStatistics): bool
    {
        return $authUser->can('ForceDelete:DepartmentalStatistics');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:DepartmentalStatistics');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:DepartmentalStatistics');
    }

    public function replicate(AuthUser $authUser, DepartmentalStatistics $departmentalStatistics): bool
    {
        return $authUser->can('Replicate:DepartmentalStatistics');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:DepartmentalStatistics');
    }

}