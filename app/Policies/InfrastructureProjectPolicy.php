<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\InfrastructureProject;
use Illuminate\Auth\Access\HandlesAuthorization;

class InfrastructureProjectPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:InfrastructureProject');
    }

    public function view(AuthUser $authUser, InfrastructureProject $infrastructureProject): bool
    {
        return $authUser->can('View:InfrastructureProject');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:InfrastructureProject');
    }

    public function update(AuthUser $authUser, InfrastructureProject $infrastructureProject): bool
    {
        return $authUser->can('Update:InfrastructureProject');
    }

    public function delete(AuthUser $authUser, InfrastructureProject $infrastructureProject): bool
    {
        return $authUser->can('Delete:InfrastructureProject');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:InfrastructureProject');
    }

    public function restore(AuthUser $authUser, InfrastructureProject $infrastructureProject): bool
    {
        return $authUser->can('Restore:InfrastructureProject');
    }

    public function forceDelete(AuthUser $authUser, InfrastructureProject $infrastructureProject): bool
    {
        return $authUser->can('ForceDelete:InfrastructureProject');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:InfrastructureProject');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:InfrastructureProject');
    }

    public function replicate(AuthUser $authUser, InfrastructureProject $infrastructureProject): bool
    {
        return $authUser->can('Replicate:InfrastructureProject');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:InfrastructureProject');
    }

}