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
        return $authUser->can('external_systems:viewAny');
    }

    public function view(AuthUser $authUser, ExternalSystem $externalSystem): bool
    {
        return $authUser->can('external_systems:view');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('external_systems:create');
    }

    public function update(AuthUser $authUser, ExternalSystem $externalSystem): bool
    {
        return $authUser->can('external_systems:update');
    }

    public function delete(AuthUser $authUser, ExternalSystem $externalSystem): bool
    {
        return $authUser->can('external_systems:delete');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('external_systems:deleteAny');
    }

    public function restore(AuthUser $authUser, ExternalSystem $externalSystem): bool
    {
        return $authUser->can('external_systems:restore');
    }

    public function forceDelete(AuthUser $authUser, ExternalSystem $externalSystem): bool
    {
        return $authUser->can('external_systems:forceDelete');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('external_systems:forceDeleteAny');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('external_systems:restoreAny');
    }

    public function replicate(AuthUser $authUser, ExternalSystem $externalSystem): bool
    {
        return $authUser->can('external_systems:replicate');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('external_systems:reorder');
    }
}
