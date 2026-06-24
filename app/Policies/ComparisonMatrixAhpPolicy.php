<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ComparisonMatrixAhp;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComparisonMatrixAhpPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ComparisonMatrixAhp');
    }

    public function view(AuthUser $authUser, ComparisonMatrixAhp $comparisonMatrixAhp): bool
    {
        return $authUser->can('View:ComparisonMatrixAhp');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ComparisonMatrixAhp');
    }

    public function update(AuthUser $authUser, ComparisonMatrixAhp $comparisonMatrixAhp): bool
    {
        return $authUser->can('Update:ComparisonMatrixAhp');
    }

    public function delete(AuthUser $authUser, ComparisonMatrixAhp $comparisonMatrixAhp): bool
    {
        return $authUser->can('Delete:ComparisonMatrixAhp');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:ComparisonMatrixAhp');
    }

    public function restore(AuthUser $authUser, ComparisonMatrixAhp $comparisonMatrixAhp): bool
    {
        return $authUser->can('Restore:ComparisonMatrixAhp');
    }

    public function forceDelete(AuthUser $authUser, ComparisonMatrixAhp $comparisonMatrixAhp): bool
    {
        return $authUser->can('ForceDelete:ComparisonMatrixAhp');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ComparisonMatrixAhp');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ComparisonMatrixAhp');
    }

    public function replicate(AuthUser $authUser, ComparisonMatrixAhp $comparisonMatrixAhp): bool
    {
        return $authUser->can('Replicate:ComparisonMatrixAhp');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ComparisonMatrixAhp');
    }

}