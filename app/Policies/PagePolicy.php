<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Page;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('pages:viewAny');
    }

    public function view(AuthUser $authUser, Page $page): bool
    {
        return $authUser->can('pages:view');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('pages:create');
    }

    public function update(AuthUser $authUser, Page $page): bool
    {
        return $authUser->can('pages:update');
    }

    public function delete(AuthUser $authUser, Page $page): bool
    {
        return $authUser->can('pages:delete');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('pages:deleteAny');
    }

    public function restore(AuthUser $authUser, Page $page): bool
    {
        return $authUser->can('pages:restore');
    }

    public function forceDelete(AuthUser $authUser, Page $page): bool
    {
        return $authUser->can('pages:forceDelete');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('pages:forceDeleteAny');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('pages:restoreAny');
    }

    public function replicate(AuthUser $authUser, Page $page): bool
    {
        return $authUser->can('pages:replicate');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('pages:reorder');
    }
}
