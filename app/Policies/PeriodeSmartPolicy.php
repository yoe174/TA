<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PeriodeSmart;
use Illuminate\Auth\Access\HandlesAuthorization;

class PeriodeSmartPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:PeriodeSmart');
    }

    public function view(AuthUser $authUser, PeriodeSmart $periodeSmart): bool
    {
        return $authUser->can('View:PeriodeSmart');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:PeriodeSmart');
    }

    public function update(AuthUser $authUser, PeriodeSmart $periodeSmart): bool
    {
        return $authUser->can('Update:PeriodeSmart');
    }

    public function delete(AuthUser $authUser, PeriodeSmart $periodeSmart): bool
    {
        return $authUser->can('Delete:PeriodeSmart');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:PeriodeSmart');
    }

    public function restore(AuthUser $authUser, PeriodeSmart $periodeSmart): bool
    {
        return $authUser->can('Restore:PeriodeSmart');
    }

    public function forceDelete(AuthUser $authUser, PeriodeSmart $periodeSmart): bool
    {
        return $authUser->can('ForceDelete:PeriodeSmart');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:PeriodeSmart');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:PeriodeSmart');
    }

    public function replicate(AuthUser $authUser, PeriodeSmart $periodeSmart): bool
    {
        return $authUser->can('Replicate:PeriodeSmart');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:PeriodeSmart');
    }

}