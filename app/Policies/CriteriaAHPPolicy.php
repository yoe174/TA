<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\CriteriaAHP;
use Illuminate\Auth\Access\HandlesAuthorization;

class CriteriaAHPPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CriteriaAHP');
    }

    public function view(AuthUser $authUser, CriteriaAHP $criteriaAHP): bool
    {
        return $authUser->can('View:CriteriaAHP');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CriteriaAHP');
    }

    public function update(AuthUser $authUser, CriteriaAHP $criteriaAHP): bool
    {
        return $authUser->can('Update:CriteriaAHP');
    }

    public function delete(AuthUser $authUser, CriteriaAHP $criteriaAHP): bool
    {
        return $authUser->can('Delete:CriteriaAHP');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:CriteriaAHP');
    }

    public function restore(AuthUser $authUser, CriteriaAHP $criteriaAHP): bool
    {
        return $authUser->can('Restore:CriteriaAHP');
    }

    public function forceDelete(AuthUser $authUser, CriteriaAHP $criteriaAHP): bool
    {
        return $authUser->can('ForceDelete:CriteriaAHP');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:CriteriaAHP');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:CriteriaAHP');
    }

    public function replicate(AuthUser $authUser, CriteriaAHP $criteriaAHP): bool
    {
        return $authUser->can('Replicate:CriteriaAHP');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:CriteriaAHP');
    }

}