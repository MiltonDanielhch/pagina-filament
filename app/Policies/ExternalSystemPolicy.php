<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ExternalSystem;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExternalSystemPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ExternalSystem');
    }

    public function view(AuthUser $authUser, ExternalSystem $externalSystem): bool
    {
        return $authUser->can('View:ExternalSystem');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ExternalSystem');
    }

    public function update(AuthUser $authUser, ExternalSystem $externalSystem): bool
    {
        return $authUser->can('Update:ExternalSystem');
    }

    public function delete(AuthUser $authUser, ExternalSystem $externalSystem): bool
    {
        return $authUser->can('Delete:ExternalSystem');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:ExternalSystem');
    }

    public function restore(AuthUser $authUser, ExternalSystem $externalSystem): bool
    {
        return $authUser->can('Restore:ExternalSystem');
    }

    public function forceDelete(AuthUser $authUser, ExternalSystem $externalSystem): bool
    {
        return $authUser->can('ForceDelete:ExternalSystem');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ExternalSystem');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ExternalSystem');
    }

    public function replicate(AuthUser $authUser, ExternalSystem $externalSystem): bool
    {
        return $authUser->can('Replicate:ExternalSystem');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ExternalSystem');
    }

}