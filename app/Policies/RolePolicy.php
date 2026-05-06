<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('roles:viewAny');
    }

    public function view(AuthUser $authUser, Role $role): bool
    {
        return $authUser->can('roles:view');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('roles:create');
    }

    public function update(AuthUser $authUser, Role $role): bool
    {
        return $authUser->can('roles:update');
    }

    public function delete(AuthUser $authUser, Role $role): bool
    {
        return $authUser->can('roles:delete');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('roles:deleteAny');
    }

    public function restore(AuthUser $authUser, Role $role): bool
    {
        return $authUser->can('roles:restore');
    }

    public function forceDelete(AuthUser $authUser, Role $role): bool
    {
        return $authUser->can('roles:forceDelete');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('roles:forceDeleteAny');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('roles:restoreAny');
    }

    public function replicate(AuthUser $authUser, Role $role): bool
    {
        return $authUser->can('roles:replicate');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('roles:reorder');
    }

}