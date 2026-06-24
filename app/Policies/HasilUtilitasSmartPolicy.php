<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\HasilUtilitasSmart;
use Illuminate\Auth\Access\HandlesAuthorization;

class HasilUtilitasSmartPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:HasilUtilitasSmart');
    }

    public function view(AuthUser $authUser, HasilUtilitasSmart $hasilUtilitasSmart): bool
    {
        return $authUser->can('View:HasilUtilitasSmart');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:HasilUtilitasSmart');
    }

    public function update(AuthUser $authUser, HasilUtilitasSmart $hasilUtilitasSmart): bool
    {
        return $authUser->can('Update:HasilUtilitasSmart');
    }

    public function delete(AuthUser $authUser, HasilUtilitasSmart $hasilUtilitasSmart): bool
    {
        return $authUser->can('Delete:HasilUtilitasSmart');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:HasilUtilitasSmart');
    }

    public function restore(AuthUser $authUser, HasilUtilitasSmart $hasilUtilitasSmart): bool
    {
        return $authUser->can('Restore:HasilUtilitasSmart');
    }

    public function forceDelete(AuthUser $authUser, HasilUtilitasSmart $hasilUtilitasSmart): bool
    {
        return $authUser->can('ForceDelete:HasilUtilitasSmart');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:HasilUtilitasSmart');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:HasilUtilitasSmart');
    }

    public function replicate(AuthUser $authUser, HasilUtilitasSmart $hasilUtilitasSmart): bool
    {
        return $authUser->can('Replicate:HasilUtilitasSmart');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:HasilUtilitasSmart');
    }

}