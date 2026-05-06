<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Event;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('events:viewAny');
    }

    public function view(AuthUser $authUser, Event $event): bool
    {
        return $authUser->can('events:view');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('events:create');
    }

    public function update(AuthUser $authUser, Event $event): bool
    {
        return $authUser->can('events:update');
    }

    public function delete(AuthUser $authUser, Event $event): bool
    {
        return $authUser->can('events:delete');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('events:deleteAny');
    }

    public function restore(AuthUser $authUser, Event $event): bool
    {
        return $authUser->can('events:restore');
    }

    public function forceDelete(AuthUser $authUser, Event $event): bool
    {
        return $authUser->can('events:forceDelete');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('events:forceDeleteAny');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('events:restoreAny');
    }

    public function replicate(AuthUser $authUser, Event $event): bool
    {
        return $authUser->can('events:replicate');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('events:reorder');
    }
}
