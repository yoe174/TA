<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\AlternatifSmart;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlternatifSmartPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:AlternatifSmart');
    }

    public function view(AuthUser $authUser, AlternatifSmart $alternatifSmart): bool
    {
        return $authUser->can('View:AlternatifSmart');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:AlternatifSmart');
    }

    public function update(AuthUser $authUser, AlternatifSmart $alternatifSmart): bool
    {
        return $authUser->can('Update:AlternatifSmart');
    }

    public function delete(AuthUser $authUser, AlternatifSmart $alternatifSmart): bool
    {
        return $authUser->can('Delete:AlternatifSmart');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:AlternatifSmart');
    }

    public function restore(AuthUser $authUser, AlternatifSmart $alternatifSmart): bool
    {
        return $authUser->can('Restore:AlternatifSmart');
    }

    public function forceDelete(AuthUser $authUser, AlternatifSmart $alternatifSmart): bool
    {
        return $authUser->can('ForceDelete:AlternatifSmart');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:AlternatifSmart');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:AlternatifSmart');
    }

    public function replicate(AuthUser $authUser, AlternatifSmart $alternatifSmart): bool
    {
        return $authUser->can('Replicate:AlternatifSmart');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:AlternatifSmart');
    }

}