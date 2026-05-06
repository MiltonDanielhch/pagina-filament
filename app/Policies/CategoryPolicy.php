<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('categories:viewAny');
    }

    public function view(AuthUser $authUser, Category $category): bool
    {
        return $authUser->can('categories:view');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('categories:create');
    }

    public function update(AuthUser $authUser, Category $category): bool
    {
        return $authUser->can('categories:update');
    }

    public function delete(AuthUser $authUser, Category $category): bool
    {
        return $authUser->can('categories:delete');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('categories:deleteAny');
    }

    public function restore(AuthUser $authUser, Category $category): bool
    {
        return $authUser->can('categories:restore');
    }

    public function forceDelete(AuthUser $authUser, Category $category): bool
    {
        return $authUser->can('categories:forceDelete');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('categories:forceDeleteAny');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('categories:restoreAny');
    }

    public function replicate(AuthUser $authUser, Category $category): bool
    {
        return $authUser->can('categories:replicate');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('categories:reorder');
    }
}
