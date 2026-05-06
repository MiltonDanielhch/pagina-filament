<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Slide;
use Illuminate\Auth\Access\HandlesAuthorization;

class SlidePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('slides:viewAny');
    }

    public function view(AuthUser $authUser, Slide $slide): bool
    {
        return $authUser->can('slides:view');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('slides:create');
    }

    public function update(AuthUser $authUser, Slide $slide): bool
    {
        return $authUser->can('slides:update');
    }

    public function delete(AuthUser $authUser, Slide $slide): bool
    {
        return $authUser->can('slides:delete');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('slides:deleteAny');
    }

    public function restore(AuthUser $authUser, Slide $slide): bool
    {
        return $authUser->can('slides:restore');
    }

    public function forceDelete(AuthUser $authUser, Slide $slide): bool
    {
        return $authUser->can('slides:forceDelete');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('slides:forceDeleteAny');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('slides:restoreAny');
    }

    public function replicate(AuthUser $authUser, Slide $slide): bool
    {
        return $authUser->can('slides:replicate');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('slides:reorder');
    }
}
