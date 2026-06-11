<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\OpenDataset;
use Illuminate\Auth\Access\HandlesAuthorization;

class OpenDatasetPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:OpenDataset');
    }

    public function view(AuthUser $authUser, OpenDataset $openDataset): bool
    {
        return $authUser->can('View:OpenDataset');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:OpenDataset');
    }

    public function update(AuthUser $authUser, OpenDataset $openDataset): bool
    {
        return $authUser->can('Update:OpenDataset');
    }

    public function delete(AuthUser $authUser, OpenDataset $openDataset): bool
    {
        return $authUser->can('Delete:OpenDataset');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:OpenDataset');
    }

    public function restore(AuthUser $authUser, OpenDataset $openDataset): bool
    {
        return $authUser->can('Restore:OpenDataset');
    }

    public function forceDelete(AuthUser $authUser, OpenDataset $openDataset): bool
    {
        return $authUser->can('ForceDelete:OpenDataset');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:OpenDataset');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:OpenDataset');
    }

    public function replicate(AuthUser $authUser, OpenDataset $openDataset): bool
    {
        return $authUser->can('Replicate:OpenDataset');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:OpenDataset');
    }

}