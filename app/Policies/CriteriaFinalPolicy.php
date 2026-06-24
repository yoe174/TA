<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\CriteriaFinal;
use Illuminate\Auth\Access\HandlesAuthorization;

class CriteriaFinalPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CriteriaFinal');
    }

    public function view(AuthUser $authUser, CriteriaFinal $criteriaFinal): bool
    {
        return $authUser->can('View:CriteriaFinal');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CriteriaFinal');
    }

    public function update(AuthUser $authUser, CriteriaFinal $criteriaFinal): bool
    {
        return $authUser->can('Update:CriteriaFinal');
    }

    public function delete(AuthUser $authUser, CriteriaFinal $criteriaFinal): bool
    {
        return $authUser->can('Delete:CriteriaFinal');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:CriteriaFinal');
    }

    public function restore(AuthUser $authUser, CriteriaFinal $criteriaFinal): bool
    {
        return $authUser->can('Restore:CriteriaFinal');
    }

    public function forceDelete(AuthUser $authUser, CriteriaFinal $criteriaFinal): bool
    {
        return $authUser->can('ForceDelete:CriteriaFinal');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:CriteriaFinal');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:CriteriaFinal');
    }

    public function replicate(AuthUser $authUser, CriteriaFinal $criteriaFinal): bool
    {
        return $authUser->can('Replicate:CriteriaFinal');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:CriteriaFinal');
    }

}