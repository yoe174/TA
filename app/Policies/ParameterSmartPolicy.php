<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ParameterSmart;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParameterSmartPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ParameterSmart');
    }

    public function view(AuthUser $authUser, ParameterSmart $parameterSmart): bool
    {
        return $authUser->can('View:ParameterSmart');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ParameterSmart');
    }

    public function update(AuthUser $authUser, ParameterSmart $parameterSmart): bool
    {
        return $authUser->can('Update:ParameterSmart');
    }

    public function delete(AuthUser $authUser, ParameterSmart $parameterSmart): bool
    {
        return $authUser->can('Delete:ParameterSmart');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:ParameterSmart');
    }

    public function restore(AuthUser $authUser, ParameterSmart $parameterSmart): bool
    {
        return $authUser->can('Restore:ParameterSmart');
    }

    public function forceDelete(AuthUser $authUser, ParameterSmart $parameterSmart): bool
    {
        return $authUser->can('ForceDelete:ParameterSmart');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ParameterSmart');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ParameterSmart');
    }

    public function replicate(AuthUser $authUser, ParameterSmart $parameterSmart): bool
    {
        return $authUser->can('Replicate:ParameterSmart');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ParameterSmart');
    }

}