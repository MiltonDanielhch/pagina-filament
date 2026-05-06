<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('posts:viewAny');
    }

    public function view(AuthUser $authUser, Post $post): bool
    {
        return $authUser->can('posts:view');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('posts:create');
    }

    public function update(AuthUser $authUser, Post $post): bool
    {
        return $authUser->can('posts:update');
    }

    public function delete(AuthUser $authUser, Post $post): bool
    {
        return $authUser->can('posts:delete');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('posts:deleteAny');
    }

    public function restore(AuthUser $authUser, Post $post): bool
    {
        return $authUser->can('posts:restore');
    }

    public function forceDelete(AuthUser $authUser, Post $post): bool
    {
        return $authUser->can('posts:forceDelete');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('posts:forceDeleteAny');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('posts:restoreAny');
    }

    public function replicate(AuthUser $authUser, Post $post): bool
    {
        return $authUser->can('posts:replicate');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('posts:reorder');
    }
}
