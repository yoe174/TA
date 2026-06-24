<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\CriteriaSmart;
use Illuminate\Auth\Access\HandlesAuthorization;

class CriteriaSmartPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CriteriaSmart');
    }

    public function view(AuthUser $authUser, CriteriaSmart $criteriaSmart): bool
    {
        return $authUser->can('View:CriteriaSmart');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CriteriaSmart');
    }

    public function update(AuthUser $authUser, CriteriaSmart $criteriaSmart): bool
    {
        return $authUser->can('Update:CriteriaSmart');
    }

    public function delete(AuthUser $authUser, CriteriaSmart $criteriaSmart): bool
    {
        return $authUser->can('Delete:CriteriaSmart');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:CriteriaSmart');
    }

    public function restore(AuthUser $authUser, CriteriaSmart $criteriaSmart): bool
    {
        return $authUser->can('Restore:CriteriaSmart');
    }

    public function forceDelete(AuthUser $authUser, CriteriaSmart $criteriaSmart): bool
    {
        return $authUser->can('ForceDelete:CriteriaSmart');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:CriteriaSmart');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:CriteriaSmart');
    }

    public function replicate(AuthUser $authUser, CriteriaSmart $criteriaSmart): bool
    {
        return $authUser->can('Replicate:CriteriaSmart');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:CriteriaSmart');
    }

}