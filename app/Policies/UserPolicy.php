<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('users:viewAny');
    }

    public function view(AuthUser $authUser, User $user): bool
    {
        return $authUser->can('users:view');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('users:create');
    }

    public function update(AuthUser $authUser, User $user): bool
    {
        return $authUser->can('users:update');
    }

    public function delete(AuthUser $authUser, User $user): bool
    {
        return $authUser->can('users:delete');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('users:deleteAny');
    }

    public function restore(AuthUser $authUser, User $user): bool
    {
        return $authUser->can('users:restore');
    }

    public function forceDelete(AuthUser $authUser, User $user): bool
    {
        return $authUser->can('users:forceDelete');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('users:forceDeleteAny');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('users:restoreAny');
    }

    public function replicate(AuthUser $authUser, User $user): bool
    {
        return $authUser->can('users:replicate');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('users:reorder');
    }
}
