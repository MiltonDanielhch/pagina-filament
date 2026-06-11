<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\MarcoNormativo;
use Illuminate\Auth\Access\HandlesAuthorization;

class MarcoNormativoPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:MarcoNormativo');
    }

    public function view(AuthUser $authUser, MarcoNormativo $marcoNormativo): bool
    {
        return $authUser->can('View:MarcoNormativo');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:MarcoNormativo');
    }

    public function update(AuthUser $authUser, MarcoNormativo $marcoNormativo): bool
    {
        return $authUser->can('Update:MarcoNormativo');
    }

    public function delete(AuthUser $authUser, MarcoNormativo $marcoNormativo): bool
    {
        return $authUser->can('Delete:MarcoNormativo');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:MarcoNormativo');
    }

    public function restore(AuthUser $authUser, MarcoNormativo $marcoNormativo): bool
    {
        return $authUser->can('Restore:MarcoNormativo');
    }

    public function forceDelete(AuthUser $authUser, MarcoNormativo $marcoNormativo): bool
    {
        return $authUser->can('ForceDelete:MarcoNormativo');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:MarcoNormativo');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:MarcoNormativo');
    }

    public function replicate(AuthUser $authUser, MarcoNormativo $marcoNormativo): bool
    {
        return $authUser->can('Replicate:MarcoNormativo');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:MarcoNormativo');
    }

}