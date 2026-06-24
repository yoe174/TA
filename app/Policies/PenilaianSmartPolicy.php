<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PenilaianSmart;
use Illuminate\Auth\Access\HandlesAuthorization;

class PenilaianSmartPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:PenilaianSmart');
    }

    public function view(AuthUser $authUser, PenilaianSmart $penilaianSmart): bool
    {
        return $authUser->can('View:PenilaianSmart');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:PenilaianSmart');
    }

    public function update(AuthUser $authUser, PenilaianSmart $penilaianSmart): bool
    {
        return $authUser->can('Update:PenilaianSmart');
    }

    public function delete(AuthUser $authUser, PenilaianSmart $penilaianSmart): bool
    {
        return $authUser->can('Delete:PenilaianSmart');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:PenilaianSmart');
    }

    public function restore(AuthUser $authUser, PenilaianSmart $penilaianSmart): bool
    {
        return $authUser->can('Restore:PenilaianSmart');
    }

    public function forceDelete(AuthUser $authUser, PenilaianSmart $penilaianSmart): bool
    {
        return $authUser->can('ForceDelete:PenilaianSmart');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:PenilaianSmart');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:PenilaianSmart');
    }

    public function replicate(AuthUser $authUser, PenilaianSmart $penilaianSmart): bool
    {
        return $authUser->can('Replicate:PenilaianSmart');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:PenilaianSmart');
    }

}