<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\NormalizationMatrixAhp;
use Illuminate\Auth\Access\HandlesAuthorization;

class NormalizationMatrixAhpPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:NormalizationMatrixAhp');
    }

    public function view(AuthUser $authUser, NormalizationMatrixAhp $normalizationMatrixAhp): bool
    {
        return $authUser->can('View:NormalizationMatrixAhp');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:NormalizationMatrixAhp');
    }

    public function update(AuthUser $authUser, NormalizationMatrixAhp $normalizationMatrixAhp): bool
    {
        return $authUser->can('Update:NormalizationMatrixAhp');
    }

    public function delete(AuthUser $authUser, NormalizationMatrixAhp $normalizationMatrixAhp): bool
    {
        return $authUser->can('Delete:NormalizationMatrixAhp');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:NormalizationMatrixAhp');
    }

    public function restore(AuthUser $authUser, NormalizationMatrixAhp $normalizationMatrixAhp): bool
    {
        return $authUser->can('Restore:NormalizationMatrixAhp');
    }

    public function forceDelete(AuthUser $authUser, NormalizationMatrixAhp $normalizationMatrixAhp): bool
    {
        return $authUser->can('ForceDelete:NormalizationMatrixAhp');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:NormalizationMatrixAhp');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:NormalizationMatrixAhp');
    }

    public function replicate(AuthUser $authUser, NormalizationMatrixAhp $normalizationMatrixAhp): bool
    {
        return $authUser->can('Replicate:NormalizationMatrixAhp');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:NormalizationMatrixAhp');
    }

}