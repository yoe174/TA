<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\HasilAkhirSmart;
use Illuminate\Auth\Access\HandlesAuthorization;

class HasilAkhirSmartPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:HasilAkhirSmart');
    }

    public function view(AuthUser $authUser, HasilAkhirSmart $hasilAkhirSmart): bool
    {
        return $authUser->can('View:HasilAkhirSmart');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:HasilAkhirSmart');
    }

    public function update(AuthUser $authUser, HasilAkhirSmart $hasilAkhirSmart): bool
    {
        return $authUser->can('Update:HasilAkhirSmart');
    }

    public function delete(AuthUser $authUser, HasilAkhirSmart $hasilAkhirSmart): bool
    {
        return $authUser->can('Delete:HasilAkhirSmart');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:HasilAkhirSmart');
    }

    public function restore(AuthUser $authUser, HasilAkhirSmart $hasilAkhirSmart): bool
    {
        return $authUser->can('Restore:HasilAkhirSmart');
    }

    public function forceDelete(AuthUser $authUser, HasilAkhirSmart $hasilAkhirSmart): bool
    {
        return $authUser->can('ForceDelete:HasilAkhirSmart');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:HasilAkhirSmart');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:HasilAkhirSmart');
    }

    public function replicate(AuthUser $authUser, HasilAkhirSmart $hasilAkhirSmart): bool
    {
        return $authUser->can('Replicate:HasilAkhirSmart');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:HasilAkhirSmart');
    }

}