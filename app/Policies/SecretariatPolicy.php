<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Secretariat;
use Illuminate\Auth\Access\HandlesAuthorization;

class SecretariatPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Secretariat');
    }

    public function view(AuthUser $authUser, Secretariat $secretariat): bool
    {
        return $authUser->can('View:Secretariat');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Secretariat');
    }

    public function update(AuthUser $authUser, Secretariat $secretariat): bool
    {
        return $authUser->can('Update:Secretariat');
    }

    public function delete(AuthUser $authUser, Secretariat $secretariat): bool
    {
        return $authUser->can('Delete:Secretariat');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Secretariat');
    }

    public function restore(AuthUser $authUser, Secretariat $secretariat): bool
    {
        return $authUser->can('Restore:Secretariat');
    }

    public function forceDelete(AuthUser $authUser, Secretariat $secretariat): bool
    {
        return $authUser->can('ForceDelete:Secretariat');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Secretariat');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Secretariat');
    }

    public function replicate(AuthUser $authUser, Secretariat $secretariat): bool
    {
        return $authUser->can('Replicate:Secretariat');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Secretariat');
    }

}